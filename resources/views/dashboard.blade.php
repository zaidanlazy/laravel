@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total User</h6>
                    <h2 class="display-5">{{ $totalUser }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Buku</h6>
                    <h2 class="display-5">{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Kategori</h6>
                    <h2 class="display-5">{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h6 class="card-title text-muted">Total Peminjaman</h6>
                    <h2 class="display-5">{{ $totalPeminjaman }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Statistik User</div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Statistik Peminjaman</div>
                <div class="card-body">
                    <canvas id="peminjamanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-info text-white">
            Peminjaman Terbaru
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamanTerbaru as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->user ? $peminjaman->user->name : 'User tidak ditemukan' }}</td>
                        <td>{{ $peminjaman->buku ? $peminjaman->buku->judul : 'Buku tidak ditemukan' }}</td>
                        <td>{{ $peminjaman->TanggalPeminjaman ?? $peminjaman->tanggal_pinjam }}</td>
                        <td>
                            <span class="badge {{ $peminjaman->StatusPeminjaman === 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ $peminjaman->StatusPeminjaman ?? $peminjaman->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Contoh data statis, ganti dengan data dinamis jika perlu
    const userChart = new Chart(document.getElementById('userChart'), {
        type: 'doughnut',
        data: {
            labels: ['User'],
            datasets: [{
                label: 'Total User',
                data: [{{ $totalUser }}],
                backgroundColor: ['#0d6efd'],
            }]
        }
    });

    const peminjamanChart = new Chart(document.getElementById('peminjamanChart'), {
        type: 'doughnut',
        data: {
            labels: ['Peminjaman'],
            datasets: [{
                label: 'Total Peminjaman',
                data: [{{ $totalPeminjaman }}],
                backgroundColor: ['#198754'],
            }]
        }
    });
</script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
