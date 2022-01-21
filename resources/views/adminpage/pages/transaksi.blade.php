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
                <h1>Riwayat Transaksi</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Transaksi</h3>
            </div>
            <div class="card-body">
            <table id="table_id" class="table table-condensed table-striped table-hover">
            
                <thead>
                    <tr>
                        <th><center>No Transaksi</th>
                        <th><center>Nama Product</th>
                        <th><center>Jumlah Product</th>
                        <th><center>Harga Product</th>
                        <th><center>Total Product</th>
                        <th><center>Total Harga</th>
                        <th><center>Tanggal Transaksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $p)
                        <tr>
                            <td><center>{{$p->transaksinumber}}</td>
                            <td><center>
                            @foreach($p->detail as $detail)
                                {!! $detail->product->name . "<br>" !!}
                            @endforeach
                            </td>
                            <td><center>
                            @foreach($p->detail as $detail)
                                {!! $detail->jumlah . "<br>" !!}
                            @endforeach
                            </td>
                            <td><center>
                            @foreach($p->detail as $detail)
                                {!! number_format($detail->price,0,"",".") . "<br>" !!}
                            @endforeach
                            </td>
                            <td><center>{{$p->barang }}</td>
                            <td><center>{{number_format($p->total,0,"",".") }}</td>
                            <td><center>{{$p->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-danger" onclick="window.location='{{ route('admin.product.export_excel') }}'">Export Excel</button>
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
                "order": [[ 6, "desc" ]],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        });

        
    </script>
@endsection
