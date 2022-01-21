@extends('adminpage.layout.apps')

@section('title','Halaman Product')

@section('meta')
    @include('adminpage.include.meta')
    <link rel="stylesheet" href="{{asset('css/cropper.css')}}" crossorigin="anonymous">
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
                <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    
                    <li class="breadcrumb-item active">Add Category</li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Penambahan Produk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="POST" action="{{route('admin.categoryadd')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                        <label for="exampleInputEmail1">Category Product</label>
                        <input type="text" class="form-control" id="category" placeholder="Masukan Category Produk" name="category" required>
                  </div>
                </div>
                <!-- /.card-body -->

                    <div class="card-footer">
                         <button type="submit" class="btn btn-primary" value="Upload">Tambahkan</button>
                    </div>
              </form>
              
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
   
@endsection
