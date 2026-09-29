<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Menampilkan daftar seluruh siswa.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Menampilkan form tambah siswa.
     */
    public function create()
    {
        $student = new Student();

        return view('admin.students.form', compact('student'));
    }

    /**
     * Menyimpan data siswa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => [
                'required',
                'string',
                'max:10',
                'unique:students,nisn',
            ],
            'nama_siswa' => [
                'required',
                'string',
                'max:40',
            ],
            'jenis_kelamin' => [
                'required',
                Rule::in(['Laki-Laki', 'Perempuan']),
            ],
            'tahun_masuk' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.max' => 'NISN maksimal 10 karakter.',
            'nisn.unique' => 'NISN sudah terdaftar.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 40 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.digits' => 'Tahun masuk harus terdiri dari 4 digit.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min' => 'Tahun masuk tidak valid.',
            'tahun_masuk.max' => 'Tahun masuk tidak boleh melebihi tahun sekarang.',
        ]);

        Student::create($validated);

        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail siswa.
     */
    public function show($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        return view('admin.students.show', compact('student'));
    }

    /**
     * Menampilkan form edit siswa.
     */
    public function edit($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        return view('admin.students.form', compact('student'));
    }

    /**
     * Memperbarui data siswa.
     */
    public function update(Request $request, $id)
    {
        $student = $this->findStudentByEncryptedId($id);

        $validated = $request->validate([
            'nisn' => [
                'required',
                'string',
                'max:10',
                Rule::unique('students', 'nisn')->ignore($student->id),
            ],
            'nama_siswa' => [
                'required',
                'string',
                'max:40',
            ],
            'jenis_kelamin' => [
                'required',
                Rule::in(['Laki-Laki', 'Perempuan']),
            ],
            'tahun_masuk' => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
        ], [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.max' => 'NISN maksimal 10 karakter.',
            'nisn.unique' => 'NISN sudah digunakan siswa lain.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 40 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.digits' => 'Tahun masuk harus terdiri dari 4 digit.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min' => 'Tahun masuk tidak valid.',
            'tahun_masuk.max' => 'Tahun masuk tidak boleh melebihi tahun sekarang.',
        ]);

        $student->update($validated);

        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Menghapus data siswa.
     */
    public function destroy($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        $student->delete();

        return redirect()
            ->route('admin.siswa')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Mencari siswa berdasarkan ID terenkripsi.
     */
    private function findStudentByEncryptedId($id)
    {
        try {
            $studentId = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            abort(404);
        }

        return Student::findOrFail($studentId);
    }
}