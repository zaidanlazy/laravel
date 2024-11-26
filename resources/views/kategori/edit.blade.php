@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Kategori</div>
                <div class="card-body">
                    <form method="post" action="{{ route('kategori.update', $kategori->KategoriID) }}">
                        @csrf
                        @method('PUT')

                     

                        <div class="row mb-3">
                            <label for="NamaKategori" class="col-md-4 col-form-label text-md-end">{{ __('Nama Kategori') }}</label>
                            <div class="col-md-6">
                                <input id="NamaKategori" type="text" value="{{ $kategori->NamaKategori }}" 
                                class="form-control @error('NamaKategori') is-invalid @enderror" 
                                name="NamaKategori" required>
                                
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
                                    {{ __('Simpan') }}
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