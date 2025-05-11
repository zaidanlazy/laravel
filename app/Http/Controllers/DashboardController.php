<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // Data user per bulan
        $userPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $userChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $userChartData[] = $userPerMonth[$i] ?? 0;
        }

        // Data peminjaman per bulan
        $loanPerMonth = Peminjaman::selectRaw('MONTH(TanggalPeminjaman) as month, COUNT(*) as total')
            ->whereYear('TanggalPeminjaman', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $loanChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $loanChartData[] = $loanPerMonth[$i] ?? 0;
        }

        return view('dashboard', [
            'totalUser' => User::count(),
            'totalBuku' => Buku::count(),
            'totalKategori' => Kategori::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'peminjamanTerbaru' => Peminjaman::with(['user', 'buku'])->latest()->take(5)->get(),
            'userChartData' => $userChartData,
            'loanChartData' => $loanChartData,
        ]);
    }
}
