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
     * Daftar siswa
     */
    public function index()
    {
        $students = Student::latest()->get();

        return view('admin.students.index', compact('students'));
    }

    /**
     * Form tambah siswa
     */
    public function create()
    {
        $student = new Student();

        return view('admin.students.form', compact('student'));
    }

    /**
     * Simpan siswa baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->rules(),
            $this->messages()
        );

        Student::create($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Detail siswa
     */
    public function show($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        return view('admin.students.show', compact('student'));
    }

    /**
     * Form edit siswa
     */
    public function edit($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        return view('admin.students.form', compact('student'));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, $id)
    {
        $student = $this->findStudentByEncryptedId($id);

        $validated = $request->validate(
            $this->rules($student->id),
            $this->messages()
        );

        $student->update($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data siswa
     */
    public function destroy($id)
    {
        $student = $this->findStudentByEncryptedId($id);

        $student->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Cari siswa berdasarkan encrypted ID
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

    /**
     * Aturan validasi
     */
    private function rules($ignoreId = null): array
    {
        return [
            'nisn' => [
                'required',
                'string',
                'max:10',
                $ignoreId
                    ? Rule::unique('students', 'nisn')->ignore($ignoreId)
                    : 'unique:students,nisn',
            ],
            'nama_siswa'    => ['required', 'string', 'max:40'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'tahun_masuk'   => [
                'required',
                'digits:4',
                'integer',
                'min:1900',
                'max:' . date('Y'),
            ],
        ];
    }

    /**
     * Pesan validasi
     */
    private function messages(): array
    {
        return [
            'nisn.required' => 'NISN wajib diisi.',
            'nisn.max'      => 'NISN maksimal 10 karakter.',
            'nisn.unique'   => 'NISN sudah terdaftar.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max'      => 'Nama siswa maksimal 40 karakter.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',

            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.digits'   => 'Tahun masuk harus terdiri dari 4 digit.',
            'tahun_masuk.integer'  => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min'      => 'Tahun masuk tidak valid.',
            'tahun_masuk.max'      => 'Tahun masuk tidak boleh melebihi tahun sekarang.',
        ];
    }
}