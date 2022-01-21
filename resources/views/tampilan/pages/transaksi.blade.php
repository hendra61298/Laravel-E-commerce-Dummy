@extends('tampilan.layout.apps')

@section('title','Halaman Home')

@section('meta')
    @include('tampilan.include.meta')
@endsection

@section('header')
    @include('tampilan.include.header')
@endsection

@section('content')
 
<div class="container"><!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br>
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
                    <h3 class="card-title"></h3>
                </div>
                <div class="card-body">
                <table id="users-table" class="table table-condensed table-striped table-hover">
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
                    <tbody></tbody>
                </table>
                <button type="button" class="btn btn-danger" onclick="window.location='{{ route('admin.product.export_excel') }}'">Export Excel</button>
                </div>
            <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
@endsection

@section('custom_script')
    @include('tampilan.include.custom_script')
 <script type="text/javascript">
    $(function() {
    $('#users-table').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
        "iDisplayLength": 10,
        processing: true,
        serverSide: true,
        ajax: {url: '{!! route('home.datatable') !!}',
                dataType: 'json',
                data: function (d) {
                d._token = "{{ csrf_token() }}";
                },
                type: 'GET'
        },
        columns: [
            { data: 'transaksinumber', name: 'transaksinumber' },
            { data: 'name', 
                render: function ( data, type, row ) {
                    text_name = "";
                    for (var i=0;i<row.detail.length;i++){
                        text_name = text_name + row.detail[i].product.name +"<br>" 
                    }
                    return text_name;
                }
            },
            { data: 'jumlah', 
                render: function ( data, type, row ) {
                    text_name = "";
                    for (var i=0;i<row.detail.length;i++){
                        text_name = text_name + row.detail[i].jumlah +"<br>" 
                    }
                    return text_name;
                }
            },

            { data: 'price', 
                render: function ( data, type, row ) {
                    text_name = "";
                    for (var i=0;i<row.detail.length;i++){
                        text_name = text_name + row.detail[i].product.price +"<br>" 
                    }
                    return text_name;
                }
            },
            { data: 'barang', name: 'barang' },
            { data: 'total', name: 'total' },
           
            { data: 'created_at', 
                render: function ( data, type, row ) {
                 
                    var date= new Date(row.created_at);
                    
                    return date.toISOString().split("T")[0] + " "+date.toISOString().split("T")[1].split(".")[0];
                }
            },
            
        ]
    });
});
        </script>
@endsection
