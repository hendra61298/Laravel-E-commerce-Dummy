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
                <h1>Buy Page</h1>
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
            <table id="table_id" class="table table-condensed table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th>Nama Product</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Buy Product</th>
                        <th>Jumlah Product di Keranjang</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $p)
                        <tr id="product_{{$p->id}}">
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ number_format($p->price,0,"",".")}}</td>
                            <td>
                                <button type="button" class="btn btn-warning"  onclick="nambahBelanja('{{$p->id}}','{{$p->price}}','{{$p->qty}}')">Add Product </button>
                                <button type="button" class="btn btn-danger"  onclick="kurangBelanja('{{$p->id}}','{{$p->price}}','{{$p->name}}')">Remove Product </button>
                            </td>
                            <td id="select_{{$p->id}}"></td>
                            <td id="select_total_{{$p->id}}"></td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card">
            <div class="card-header">
                <h1 class="card-title">Total Cost</h1>
            </div>
            <div class="card-body">
                
            <p id="total_cost">0</p>
            </div>
            <button type="button" class="btn btn-primary"  onclick="checkout()">Buy All </button>
            
            
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
    <script> type="text/javascript">
        $(document).ready(function () {
            $('#table_id').dataTable(
                {  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                }
            );
        });

        arrayBelanja = [];

        function nambahBelanja(id,price,jumlah){
            if (arrayBelanja.filter(e => e.id === id).length > 0) {
                index = arrayBelanja.map(function(e) { return e.id; }).indexOf(id);
                if (jumlah > arrayBelanja[index]["jumlah"]){
                    arrayBelanja[index]["price"] = parseInt(arrayBelanja[index]["price"]) + parseInt(price)
                    arrayBelanja[index]["jumlah"] = arrayBelanja[index]["jumlah"] + 1

                    //update table
                    $("#select_"+id).html(parseInt($("#select_"+id).html())+1)
                    $("#select_total_"+id).html(convertNumberToPrice(parseInt(convertPriceToNumber(arrayBelanja[index]["price"]))))
                    $("#total_cost").html(convertNumberToPrice(parseInt(convertPriceToNumber($("#total_cost").html()))+ parseInt(price)))
                }else {
                    alert('Stock tidak mencukupi');
                }
               
            } else {
                if (jumlah >= 1){
                    arrayBelanja.push({
                        "id" : id,
                        "price" : parseInt(price),
                        "jumlah" : 1,
                    });
                    $("#select_"+id).html(1)
                    $("#select_total_"+id).html(convertNumberToPrice(parseInt(convertPriceToNumber(price))))
                    $("#total_cost").html(convertNumberToPrice(parseInt($("#total_cost").html())+parseInt(price)))
                }else{
                    alert('Stock tidak mencukupi');
                }
            } 
        }

        function kurangBelanja(id,price,product){
            //arrayBelanja = [1,2,4,6,3,10];
            
            if (arrayBelanja.filter(e => e.id === id).length > 0 ) {
                index = arrayBelanja.map(function(e) { return e.id; }).indexOf(id);
                
                if (arrayBelanja[index]["jumlah"]>1){
                    arrayBelanja[index]["price"] = parseInt(arrayBelanja[index]["price"]) - parseInt(price)
                    arrayBelanja[index]["jumlah"] = arrayBelanja[index]["jumlah"] - 1
                    $("#select_"+id).html(parseInt($("#select_"+id).html())-1)
                    $("#select_total_"+id).html(convertNumberToPrice(parseInt(convertPriceToNumber(arrayBelanja[index]["price"]))))
                    $("#total_cost").html(convertNumberToPrice(parseInt(convertPriceToNumber($("#total_cost").html()))- parseInt(price)))
                } else {
                    arrayBelanja.splice(index, 1);
                    $("#select_"+id).html("")
                    $("#select_total_"+id).html("")
                    $("#total_cost").html(convertNumberToPrice(parseInt(convertPriceToNumber($("#total_cost").html()))- parseInt(price)))
                    alert(product+' sudah kosong di keranjang anda');
                }
            }else{
                alert(product+' sudah kosong di keranjang anda');
            }
        }

        function checkout(){
            Swal.fire({
                title: 'Apakah yakin membeli product ini?',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: `Tidak`,
                }).then((result) => {
                if (result.isConfirmed) {
                    //delete data from BE
                    $.ajax({
                        url: "{{route('product.checkout','')}}",
                        type: "POST",
                        data: {
                            "_token": "{{csrf_token()}}",
                            "products":arrayBelanja
                        },
                        success: function (response) {
                            if (response==1){
                                Swal.fire(
                                    'Berhasil',
                                    'Berhasil checkout product',
                                    'success'
                                ).then((result) => {window.location.reload(); });
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    'Gagal checkout product',
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
