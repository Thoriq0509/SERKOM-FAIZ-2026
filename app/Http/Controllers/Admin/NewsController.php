<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    /* =====================================================
     |  INDEX
     ===================================================== */
    public function index()
    {
        $news = News::with('user')
            ->orderByDesc('tanggal')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /* =====================================================
     |  CREATE
     ===================================================== */
    public function create()
    {
        return view('admin.news.form', [
            'news'   => new News(),
            'isEdit' => false,
        ]);
    }

    /* =====================================================
     |  STORE
     ===================================================== */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $validated['id_user'] = Auth::id();

        News::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /* =====================================================
     |  SHOW
     ===================================================== */
    public function show($id)
    {
        $news = $this->findNews($id);

        if (! $news) {
            return $this->backWithError('Data berita tidak ditemukan.');
        }

        return view('admin.news.show', compact('news'));
    }

    /* =====================================================
     |  EDIT
     ===================================================== */
    public function edit($id)
    {
        $news = $this->findNews($id);

        if (! $news) {
            return $this->backWithError('Data berita tidak ditemukan.');
        }

        return view('admin.news.form', [
            'news'   => $news,
            'isEdit' => true,
        ]);
    }

    /* =====================================================
     |  UPDATE
     ===================================================== */
    public function update(Request $request, $id)
    {
        $news = $this->findNews($id);

        if (! $news) {
            return $this->backWithError('Data berita tidak ditemukan.');
        }

        $validated = $request->validate($this->rules(), $this->messages());

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
                Storage::disk('public')->delete($news->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /* =====================================================
     |  DESTROY
     ===================================================== */
    public function destroy($id)
    {
        $news = $this->findNews($id);

        if (! $news) {
            return $this->backWithError('Data berita tidak ditemukan.');
        }

        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /* =====================================================
     |  HELPER
     ===================================================== */

    /**
     * Find news by encrypted ID.
     */
    private function findNews(string $encryptedId): ?News
    {
        try {
            return News::find(Crypt::decryptString($encryptedId));
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
            ->route('admin.news.index')
            ->with('error', $message);
    }

    /**
     * Validation rules.
     */
    private function rules(): array
    {
        return [
            'judul'   => ['required', 'string', 'max:50'],
            'isi'     => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'status'  => ['required', Rule::in(['Publish', 'Draft'])],
            'gambar'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Validation messages.
     */
    private function messages(): array
    {
        return [
            'judul.required'   => 'Judul berita wajib diisi.',
            'judul.max'        => 'Judul berita maksimal 50 karakter.',

            'isi.required'     => 'Isi berita wajib diisi.',

            'tanggal.required' => 'Tanggal publikasi wajib diisi.',
            'tanggal.date'     => 'Format tanggal tidak valid.',

            'status.required'  => 'Status wajib dipilih.',
            'status.in'        => 'Status hanya boleh Publish atau Draft.',

            'gambar.image'     => 'File harus berupa gambar.',
            'gambar.mimes'     => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'gambar.max'       => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}