@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-12">
           <div class="card">
               <div class="card-header">{{ __('Kategori') }}</div>

               <div class="card-body">
                  @if($message = Session::get('success'))
                     <div class="alert alert-success" role="alert">
                       <strong>{{$message}}</strong>
                     </div>
                  @endif

                   <a href="{{Route('kategori.create')}}" class="btn btn-success btn-md m-4">
                     <i class="fa fa-plus"></i> Tambah Kategori
                   </a>
                   
                   <table class="table table-striped table-bordered">
                     <thead>
                       <tr>
                        <th>No</th>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach ($kategoris as $kategori)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->KategoriID }}</td>
                        <td>{{ $kategori->NamaKategori }}</td>
                        <td>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <a href="{{route('kategori.edit',$kategori->KategoriID)}}" class="btn btn-sm btn-secondary mx-1 shadow" 
                                title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i></a>
                            </div>

                            <form method="POST" action="{{ route('kategori.destroy', $kategori->KategoriID) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm btn-delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i></button>
                           </form>
                          </div>
                        </td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>
<script type="text/javascript">
 $(".btn-delete").click(function(e){
     e.preventDefault();
     var form = $(this).parents("form");
     Swal.fire({
       title: "Konfirmasi Hapus Kategori",
       text: "Apakah Anda Yakin Akan Menghapus Kategori ini?",
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
@endsection