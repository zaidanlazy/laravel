@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Peminjaman</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('peminjaman.store') }}">
                        @csrf

                        <!-- UserID Select -->
                        <div class="row mb-3">
                            <label for="UserID" class="col-md-4 col-form-label text-md-end">{{ __('User ID') }}</label>
                            <div class="col-md-6">
                                <select name="UserID" class="form-control @error('UserID') is-invalid @enderror">
                                    <option value="">Pilih User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('UserID') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('UserID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- BukuID Select -->
                        <div class="row mb-3">
                            <label for="BukuID" class="col-md-4 col-form-label text-md-end">{{ __('Buku ID') }}</label>
                            <div class="col-md-6">
                                <select id="BukuID" name="BukuID" class="form-select @error('BukuID') is-invalid @enderror" required>
                                    <option value="">{{ __('Pilih Buku') }}</option>
                                    @forelse($buku as $buku) <!-- Pastikan ini adalah data buku -->
                                        <option value="{{ $buku->BukuID }}" {{ old('BukuID') == $buku->BukuID ? 'selected' : '' }}>
                                            {{ $buku->Judul }}
                                        </option>
                                    @empty
                                        <option value="" disabled>{{ __('Tidak ada buku tersedia') }}</option>
                                    @endforelse
                                </select>

                                @error('BukuID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Peminjaman -->
                        <div class="row mb-3">
                            <label for="TanggalPeminjaman" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Peminjaman') }}</label>
                            <div class="col-md-6">
                                <input id="TanggalPeminjaman" type="date" class="form-control @error('TanggalPeminjaman') is-invalid @enderror" name="TanggalPeminjaman" value="{{ old('TanggalPeminjaman') }}" required>

                                @error('TanggalPeminjaman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div class="row mb-3">
                            <label for="TanggalPengembalian" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Pengembalian') }}</label>
                            <div class="col-md-6">
                                <input id="TanggalPengembalian" type="date" class="form-control @error('TanggalPengembalian') is-invalid @enderror" name="TanggalPengembalian" value="{{ old('TanggalPengembalian') }}">

                                @error('TanggalPengembalian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Peminjaman -->
                        <div class="row mb-3">
                            <label for="StatusPeminjaman" class="col-md-4 col-form-label text-md-end">Status Peminjaman</label>
                            <div class="col-md-6">
                                <select id="StatusPeminjaman" name="StatusPeminjaman" class="form-select @error('StatusPeminjaman') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Dipinjam" {{ old('StatusPeminjaman') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Dikembalikan" {{ old('StatusPeminjaman') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                    <option value="Terlambat" {{ old('StatusPeminjaman') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                </select>
                                @error('StatusPeminjaman')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Peminjaman') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection