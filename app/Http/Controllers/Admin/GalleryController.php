<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    /* =====================================================
     |  INDEX
     ===================================================== */
    public function index()
    {
        $galleries = Gallery::orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.gallery.index', compact('galleries'));
    }

    /* =====================================================
     |  CREATE
     ===================================================== */
    public function create()
    {
        return view('admin.gallery.form', [
            'gallery' => new Gallery(),
            'isEdit'  => false,
        ]);
    }

    /* =====================================================
     |  STORE
     ===================================================== */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        Gallery::create($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil ditambahkan.');
    }

    /* =====================================================
     |  SHOW
     ===================================================== */
    public function show($id)
    {
        $gallery = $this->findGallery($id);

        if (! $gallery) {
            return $this->backWithError('Data galeri tidak ditemukan.');
        }

        return view('admin.gallery.show', compact('gallery'));
    }

    /* =====================================================
     |  EDIT
     ===================================================== */
    public function edit($id)
    {
        $gallery = $this->findGallery($id);

        if (! $gallery) {
            return $this->backWithError('Data galeri tidak ditemukan.');
        }

        return view('admin.gallery.form', [
            'gallery' => $gallery,
            'isEdit'  => true,
        ]);
    }

    /* =====================================================
     |  UPDATE
     ===================================================== */
    public function update(Request $request, $id)
    {
        $gallery = $this->findGallery($id);

        if (! $gallery) {
            return $this->backWithError('Data galeri tidak ditemukan.');
        }

        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        $gallery->update($validated);

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil diperbarui.');
    }

    /* =====================================================
     |  DESTROY
     ===================================================== */
    public function destroy($id)
    {
        $gallery = $this->findGallery($id);

        if (! $gallery) {
            return $this->backWithError('Data galeri tidak ditemukan.');
        }

        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Media galeri berhasil dihapus.');
    }

    /* =====================================================
     |  HELPER
     ===================================================== */

    /**
     * Find gallery by encrypted ID.
     */
    private function findGallery(string $encryptedId): ?Gallery
    {
        try {
            return Gallery::find(Crypt::decryptString($encryptedId));
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Redirect to index with error message.
     */
    private function backWithError(string $message)
    {
        return redirect()
            ->route('admin.gallery.index')
            ->with('error', $message);
    }

    /**
     * Validation rules.
     */
    private function rules(): array
    {
        return [
            'judul'      => ['required', 'string', 'max:50'],
            'keterangan' => ['nullable', 'string'],
            'kategori'   => ['required', Rule::in(['Foto', 'Video'])],
            'tanggal'    => ['required', 'date'],
            'gambar'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Validation messages.
     */
    private function messages(): array
    {
        return [
            'judul.required'    => 'Judul wajib diisi.',
            'judul.max'         => 'Judul maksimal 50 karakter.',

            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in'       => 'Kategori hanya boleh Foto atau Video.',

            'tanggal.required'  => 'Tanggal wajib diisi.',
            'tanggal.date'      => 'Format tanggal tidak valid.',

            'gambar.image'      => 'File harus berupa gambar.',
            'gambar.mimes'      => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max'        => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}