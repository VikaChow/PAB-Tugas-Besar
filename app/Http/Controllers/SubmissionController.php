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
}