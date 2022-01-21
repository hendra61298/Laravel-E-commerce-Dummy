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
                <h1>Admin</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Email</h3>
            </div>
            <div class="card-body">
            <table id="table_id" class="table table-condensed table-striped table-hover">
                <thead>
                    <tr>
                        <th><center>No</th>
                        <th><center>Nama</th>
                        <th><center>Email</th>
                        <th><center>Role</th>
                        <th><center>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $p)
                        <tr>
                            <td><center>{{ $p->id }}</td>
                            <td><center>{{ $p->name }}</td>
                            <td><center>{{ $p->email }}</td>
                            <td><center>{{ $p->role }}</td>
                            <td><center>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" onClick="setEdit('{{$p->id}}','{{$p->name}}','{{$p->email}}','{{$p->role}}')">Edit</button>
                                <button  type="button" class="btn btn-danger" onCLick="submitDelete('{{ $p->id }}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
      <form  method="POST" action="{{route('admin.product.updaterole')}}">
                {{ csrf_field() }}
                <input type="text" id="id" name="id" value="" style="display:none">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukan Nama" name="name" value="" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="email" name="email" value="" required disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1"> Role</label>
                    <select name="role" id="role" class="form-control">
                                <option hidden> select role</option>
                              @foreach($role as $c)
                                <option value="{{$c->name}}">{{$c->name}}</option>
                              @endforeach
                            </select>
                  </div>
                  </div>
                  <div class="form-check" style= "padding-left: 45px;">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label" for="exampleCheck1" >Cek Kembali</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" onClick="submidedit">Edit User</button>
                   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
      </div>
     
      </div>
    </div>

  </div>
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
        id_edit = 0;

        $(document).ready(function () {
            $('#table_id').dataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            }
                
            );
        });
        
        function setEdit(id,name,email,role){
            $("#id").val(id);
            $("#name").val(name);
            $("#email").val(email);
            $("#role").val(role);

        }



        function submitDelete(id){
            Swal.fire({
                title: 'Apakah yakin menghapus Akun ini?',
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
