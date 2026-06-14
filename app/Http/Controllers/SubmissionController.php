<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class SubmissionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $submissions = Submission::where('user_id', $user->id)->latest()->get();
            $users = collect();
        } else {
            $submissions = Submission::where('department_id', $user->department_id)->latest()->get();
            
            $users = User::where('department_id', $user->department_id)->with('department')->get();
        }

        return view('dashboard', compact('submissions', 'users'));
    }

    public function create()
    {
        return view('submissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:aktif,pengantar_tugas,lulus',
            'description' => 'required|string|min:10',
        ]);

        Submission::create([
            'user_id' => auth()->id(),
            'department_id' => auth()->user()->department_id,
            'type' => $request->type,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan surat berhasil dikirim ke Ketua Program Studi.');
    }

    public function approve(Submission $submission)
    {
        $this->checkDepartmentSafety($submission);
        $submission->update(['status' => 'approved']);
        return back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject(Submission $submission)
    {
        $this->checkDepartmentSafety($submission);
        $submission->update(['status' => 'rejected']);
        return back()->with('error', 'Pengajuan surat ditolak.');
    }

    public function uploadFile(Request $request, Submission $submission)
    {
        $this->checkDepartmentSafety($submission);

        $request->validate([
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        if ($submission->status !== 'approved') {
            return back()->with('error', 'Surat harus disetujui oleh Kaprodi terlebih dahulu.');
        }

        if ($request->hasFile('document')) {
            if ($submission->file_path) {
                Storage::delete($submission->file_path);
            }

            $path = $request->file('document')->store('public/secure_surat');
            $submission->update(['file_path' => $path]);

            return back()->with('success', 'File dokumen surat berhasil di-upload ke sistem.');
        }
    }

    public function download(Submission $submission)
    {
        if (auth()->id() !== $submission->user_id && auth()->user()->department_id !== $submission->department_id) {
            abort(403);
        }

        if (!$submission->file_path || !Storage::exists($submission->file_path)) {
            return back()->with('error', 'File dokumen fisik belum di-upload oleh staf tata usaha.');
        }

        $studentName = str_replace(' ', '_', $submission->user->name);

        return Storage::download(
            $submission->file_path, 
            'Surat_' . ucfirst($submission->type) . '_' . $studentName . '.pdf'
        );
    }

    private function checkDepartmentSafety(Submission $submission)
    {
        if (auth()->user()->department_id !== $submission->department_id) {
            abort(403, 'Akses ilegal. Anda tidak ditempatkan di Program Studi ini.');
        }
    }

    public function viewStudents()
    {
        $user = auth()->user();
        
        $students = User::where('department_id', $user->department_id)
                        ->where('role', 'mahasiswa')
                        ->latest()
                        ->get();

        return view('users.students', compact('students'));
    }

    public function viewStaff()
    {
        $user = auth()->user();
        
        $staff = User::where('department_id', $user->department_id)
                    ->whereIn('role', ['kaprodi', 'tu', 'manager'])
                    ->latest()
                    ->get();

        return view('users.staff', compact('staff'));
    }

    public function createStudent()
    {
        return view('users.create_student');
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|max:50|unique:users,nrp',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'department_id' => auth()->user()->department_id,
        ]);

        return redirect()->route('users.students')->with('success', 'Data mahasiswa baru berhasil ditambahkan ke jurusan ini.');
    }

    public function editStudent(User $user)
    {
        if (auth()->user()->department_id !== $user->department_id || $user->role !== 'mahasiswa') {
            abort(403, 'Akses ditolak. Mahasiswa tidak berada di bawah yurisdiksi jurusan Anda.');
        }

        return view('users.edit_student', compact('user'));
    }

    public function updateStudent(Request $request, User $user)
    {
        if (auth()->user()->department_id !== $user->department_id) { abort(403); }

        $request->validate([
            'nrp' => 'required|string|max:50|unique:users,nrp,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.students')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroyStudent(User $user)
    {
        if (auth()->user()->department_id !== $user->department_id) { abort(403); }

        $user->delete();

        return redirect()->route('users.students')->with('success', 'Data mahasiswa berhasil dihapus dari database.');
    }

    public function createStaff()
    {
        return view('users.create_staff');
    }

    public function storeStaff(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|max:50|unique:users,nrp',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|string|in:kaprodi,tu',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'department_id' => auth()->user()->department_id,
        ]);

        return redirect()->route('users.staff')->with('success', 'Data staf fungsional baru berhasil didaftarkan.');
    }

    public function editStaff(User $user)
    {
        if (auth()->user()->department_id !== $user->department_id || $user->role === 'mahasiswa') {
            abort(403, 'Akses ditolak. Pengguna berada di luar yurisdiksi prodi Anda.');
        }

        return view('users.edit_staff', compact('user'));
    }

    public function updateStaff(Request $request, User $user)
    {
        if (auth()->user()->department_id !== $user->department_id || $user->role === 'mahasiswa') { abort(403); }

        $request->validate([
            'nrp' => 'required|string|max:50|unique:users,nrp,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:kaprodi,tu',
            'password' => 'nullable|string|min:8',
        ]);

        $data = [
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.staff')->with('success', 'Data informasi staf berhasil diperbarui.');
    }

    public function destroyStaff(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.staff')->with('error', 'Aksi ditolak. Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif.');
        }

        if (auth()->user()->department_id !== $user->department_id) { abort(403); }

        $user->delete();

        return redirect()->route('users.staff')->with('success', 'Data fungsional staf berhasil dihapus dari database.');
    }
}