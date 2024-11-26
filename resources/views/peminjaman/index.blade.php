@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Peminjaman') }}</div>

                <div class="card-body">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-md m-4">
                        <i class="fa fa-plus"></i> Tambah Peminjaman
                    </a>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>PeminjamanID</th>
                                <th>UserID</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Peminjaman</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $pinjam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pinjam->PeminjamanID }}</td>
                                <td>{{ $pinjam->UserID }}</td>
                                <td>{{ $pinjam->buku->Judul ?? 'Judul Tidak Tersedia' }}</td>
                                <td>{{ $pinjam->TanggalPeminjaman }}</td>
                                <td>{{ $pinjam->TanggalPengembalian }}</td>
                                <td>{{ $pinjam->StatusPeminjaman }}</td>
                                <td>
                                    <a href="{{ route('peminjaman.edit', $pinjam->PeminjamanID) }}" class="btn btn-sm btn-secondary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('peminjaman.destroy', $pinjam->PeminjamanID) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                 
                    <div class="d-flex justify-content-center">
                        {{ $peminjamans->links() }}
                    </div>
                </div>
                <script type="text/javascript">
 $(".btn-delete").click(function(e){
     e.preventDefault();
     var form = $(this).parents("form");
     Swal.fire({
       title: "Konfirmasi Hapus Kategori",
       text: "Apakah Anda Yakin Akan Menghapus Peminjaman ini?",
       icon: "warning",
       showCancelButton: true,
       confirmButtonColor: "#3085d6",
       cancelButtonColor: "#d33",
       confirmButtonText: "Ya, Hapus!"
     }).then((result) => {
       if (result.isConfirmed) {
         form.submit();
       }
     });
 });
</script>
            </div>
        </div>
    </div>
</div>
@endsection