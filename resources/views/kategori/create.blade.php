@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Kategori Buku</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kategori.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="kategori_id" class="col-md-4 col-form-label text-md-end">{{ __('ID Kategori') }}</label>
                            <div class="col-md-6">
                                <input id="kategori_id" type="text" class="form-control @error('kategori_id') is-invalid @enderror" 
                                       name="kategori_id" value="{{ old('kategori_id') }}" required autocomplete="kategori_id" autofocus>
                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Input untuk Nama Kategori Buku -->
                        <div class="row mb-3">
                            <label for="nama_kategori" class="col-md-4 col-form-label text-md-end">{{ __('Nama Kategori') }}</label>
                            <div class="col-md-6">
                                <input id="nama_kategori" type="text" class="form-control @error('nama_kategori') is-invalid @enderror" 
                                       name="nama_kategori" value="{{ old('nama_kategori') }}" required autocomplete="nama_kategori" autofocus>
                                @error('nama_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Kategori') }}
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