@extends('adminpage.layout.apps')

@section('title','Halaman Product')

@section('meta')
    @include('adminpage.include.meta')
@endsection

@section('header')
    @include('adminpage.include.header')
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>List Product</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Product</h3>
            </div>
            <div class="card-body">
            <table id="table_id" class="table table-condensed table-striped table-hover">
                <thead>
                    <tr>
                        <th><center>Gambar Product</th>
                        <th><center>Nama Product</th>
                        <th><center>Jumlah</th>
                        <th><center>Harga</th>
                        <th><center>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $p)
                        <tr>
                            <td><center><img width="150px" src="{{ $p->qty == 0 ? asset('images/habis.jpg') : asset($p->img_url)}}"/></td>
                            <td><center>{!! $p->qty == 0 ? '<del>'.$p->name.'</del>' : $p->name!!}</td>
                            <td><center>{{ $p->qty == 0 ? 'Stok '.$p->name.' Telah Habis' : $p->qty }}</td>
                            <td><center>{{ number_format($p->price,0,"",".")}}</td>
                            
                            <td><center>
                                <button type="button" class="btn btn-warning"  onclick="window.location='{{route('admin.product.edit',$p->id)}}'">Edit</button>
                                <button  type="button" class="btn btn-danger" onCLick="submitDelete('{{ $p->id }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('footer')
    @include('adminpage.include.footer')
@endsection

@section('custom-script')
    @include('adminpage.include.custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table_id').dataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            }
                
            );
        });
        
        function submitDelete(id){
            Swal.fire({
                title: 'Apakah yakin menghapus data ini?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: `Tidak`,
                }).then((result) => {
                if (result.isConfirmed) {
                    //delete data from BE
                    $.ajax({
                        url: "{{route('admin.product.destroy','')}}/"+id,
                        type: "DELETE",
                        data: {
                            "_token": "{{csrf_token()}}"
                        },
                        success: function (response) {
                            if (response==1){
                                Swal.fire(
                                    'Berhasil',
                                    'Berhasil menghapus data',
                                    'success'
                                ).then((result) => {window.location.reload(); });
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    'Gagal menghapus data',
                                    'error'
                                ).then((result) => { window.location.reload(); });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                } else if (result.isDenied) {
                }
            })
        }
       
        
    </script>
@endsection
