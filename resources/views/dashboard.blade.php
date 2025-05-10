@extends('layouts.app')

@section('content')
@php use Carbon\Carbon; @endphp
<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Dashboard Overview</h1>
        <div class="date-selector">
            <span class="text-muted me-2"><i class="bi bi-calendar3"></i> {{ now()->format('F j, Y') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title text-white-50">Total Users</h6>
                            <h2 class="stat-value text-white">{{ $totalUser }}</h2>
                        </div>
                        <div class="stat-icon bg-white-10 rounded-circle p-3">
                            <i class="bi bi-people-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="stat-progress mt-3">
                        <div class="progress bg-white-20" style="height: 4px;">
                            <div class="progress-bar bg-white" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm bg-gradient-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title text-white-50">Total Books</h6>
                            <h2 class="stat-value text-white">{{ $totalBuku }}</h2>
                        </div>
                        <div class="stat-icon bg-white-10 rounded-circle p-3">
                            <i class="bi bi-book-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="stat-progress mt-3">
                        <div class="progress bg-white-20" style="height: 4px;">
                            <div class="progress-bar bg-white" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm bg-gradient-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title text-white-50">Total Categories</h6>
                            <h2 class="stat-value text-white">{{ $totalKategori }}</h2>
                        </div>
                        <div class="stat-icon bg-white-10 rounded-circle p-3">
                            <i class="bi bi-tags-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="stat-progress mt-3">
                        <div class="progress bg-white-20" style="height: 4px;">
                            <div class="progress-bar bg-white" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card border-0 shadow-sm bg-gradient-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-title text-white-50">Total Loans</h6>
                            <h2 class="stat-value text-white">{{ $totalPeminjaman }}</h2>
                        </div>
                        <div class="stat-icon bg-white-10 rounded-circle p-3">
                            <i class="bi bi-clipboard2-check-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="stat-progress mt-3">
                        <div class="progress bg-white-20" style="height: 4px;">
                            <div class="progress-bar bg-white" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">User Statistics</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="userChartMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            This Month
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userChartMenu">
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="userChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">Loan Statistics</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="loanChartMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            This Month
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="loanChartMenu">
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="peminjamanChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Loans Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Recent Loans</h5>
            <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Book</th>
                            <th>Loan Date</th>
                            <th>Due Date</th>
                            <th class="text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamanTerbaru as $peminjaman)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        <span class="avatar-title bg-light rounded-circle">
                                            {{ substr($peminjaman->user ? $peminjaman->user->name : 'U', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $peminjaman->user ? $peminjaman->user->name : 'User not found' }}</h6>
                                        <small class="text-muted">{{ $peminjaman->user ? $peminjaman->user->email : '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h6 class="mb-0">{{ $peminjaman->buku ? $peminjaman->buku->judul : 'Book not found' }}</h6>
                                <small class="text-muted">{{ $peminjaman->buku ? $peminjaman->buku->kategori->nama ?? 'No category' : '' }}</small>
                            </td>
                            <td>
                                {{ $peminjaman->TanggalPeminjaman ?? $peminjaman->tanggal_pinjam ? Carbon::parse($peminjaman->TanggalPeminjaman ?? $peminjaman->tanggal_pinjam)->format('M d, Y') : '-' }}
                            </td>
                            <td>
                                {{ $peminjaman->TanggalPengembalian ?? $peminjaman->tanggal_kembali ? Carbon::parse($peminjaman->TanggalPengembalian ?? $peminjaman->tanggal_kembali)->format('M d, Y') : '-' }}
                            </td>
                            <td class="text-end pe-4">
                                <span class="badge rounded-pill {{ $peminjaman->StatusPeminjaman === 'Dipinjam' ? 'bg-warning text-dark' : 'bg-success' }} py-2 px-3">
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
</div>

<!-- Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Users',
                data: @json($userChartData),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#4e73df',
                pointHoverBorderColor: '#fff',
                pointHitRadius: 10,
                pointBorderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#4e73df',
                    titleMarginBottom: 10,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Loan Chart
    const loanCtx = document.getElementById('peminjamanChart').getContext('2d');
    const loanChart = new Chart(loanCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Loans',
                data: [42, 38, 45, 52, 68, 62, 75],
                backgroundColor: '#1cc88a',
                hoverBackgroundColor: '#17a673',
                borderColor: '#1cc88a',
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1cc88a',
                    titleMarginBottom: 10,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    usePointStyle: true,
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<style>
    .stat-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-value {
        font-weight: 700;
        margin: 0.25rem 0;
    }
    
    .stat-icon {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
    }
    
    .bg-white-10 {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .bg-white-20 {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .avatar-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-title {
        font-weight: 600;
        color: #4e73df;
    }
    
    .table-responsive {
        min-height: 300px;
    }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
</style>
@endsection