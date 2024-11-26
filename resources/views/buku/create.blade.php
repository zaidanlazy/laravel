@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Buku</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('buku.store') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="Judul" class="col-md-4 col-form-label text-md-end">{{ __('Judul Buku') }}</label>
                            <div class="col-md-6">
                                <input id="Judul" type="text" class="form-control @error('Judul') is-invalid @enderror" name="Judul" value="{{ old('Judul') }}" required autocomplete="Judul" autofocus>
                                @error('Judul')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="TahunTerbit" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Terbit') }}</label>
                            <div class="col-md-6">
                                <input id="TahunTerbit" type="text" class="form-control @error('TahunTerbit') is-invalid @enderror" name="TahunTerbit" value="{{ old('TahunTerbit') }}" required autocomplete="TahunTerbit">
                                @error('TahunTerbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Penerbit" class="col-md-4 col-form-label text-md-end">{{ __('Penerbit') }}</label>
                            <div class="col-md-6">
                                <input id="Penerbit" type="text" class="form-control @error('Penerbit') is-invalid @enderror" name="Penerbit" value="{{ old('Penerbit') }}" required autocomplete="Penerbit">
                                @error('Penerbit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Penulis" class="col-md-4 col-form-label text-md-end">{{ __('Penulis') }}</label>
                            <div class="col-md-6">
                                <input id="Penulis" type="text" class="form-control @error('Penulis') is-invalid @enderror" name="Penulis" value="{{ old('Penulis') }}" required autocomplete="Penulis">
                                @error('Penulis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="NamaKategori" class="col-md-4 col-form-label text-md-end">{{ __('Kategori Buku') }}</label>
                            <div class="col-md-6">
                                <select id="NamaKategori" class="form-select @error('NamaKategori') is-invalid @enderror" name="NamaKategori" required>
                                    <option value="">{{ __('Pilih Kategori') }}</option>
                                    @foreach($kategoris as $category)
                                        <option value="{{ $category->NamaKategori }}">{{ $category->NamaKategori }}</option>
                                    @endforeach
                                </select>
                                @error('NamaKategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Buku') }}
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