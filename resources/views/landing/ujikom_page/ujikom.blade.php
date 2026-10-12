@extends('landing.layout.home')

@section('title', 'Form Uji Kompetensi')

@section('content')

<label for="nilai1">Nilai 1</label><br>
<input type="number" id="nilai1" placeholder="Masukkan nilai 1" min="0" max="100"><br><br>

<label for="nilai2">Nilai 2</label><br>
<input type="number" id="nilai2" placeholder="Masukkan nilai 2" min="0" max="100"><br><br>

<button type="button" onclick="hitung()">Hitung Rata-Rata</button>

<div id="hasil" style="display:none;">
    <p>Nilai Rata-Rata= <span id="rata"></span></p>
    <p>Keterangan= <span id="keterangan"></span></p>
</div>

@push('scripts')
<script>
    function hitung() {
        const n1 = parseFloat(document.getElementById('nilai1').value);
        const n2 = parseFloat(document.getElementById('nilai2').value);

        // validasi input
        if (isNaN(n1) || isNaN(n2)) {
            alert('Harap masukkan kedua nilai.');
            return;
        }

        if (n1 < 0 || n1 > 100 || n2 < 0 || n2 > 100) {
            alert('Nilai harus antara 0 dan 100.');
            return;
        }

        // Hitung rata-rata
        const rata = (n1 + n2) / 2;

        // Tentukan keterangan
        const keterangan = rata > 70 ? 'LULUS' : 'TIDAK LULUS';

        // Tampilkan hasil
        document.getElementById('rata').textContent = rata.toFixed(2);
        document.getElementById('keterangan').textContent = keterangan;
        document.getElementById('hasil').style.display = 'block';
    }
</script>
@endpush

@endsection