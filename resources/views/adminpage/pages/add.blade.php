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
                <h1>Add Product</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    
                    <li class="breadcrumb-item active">Add Page</li>
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
              <form  method="POST" action="{{route('admin.product.create')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Product</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukan Nama Produk" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" placeholder="Masukan Jumlah" name="jumlah" required min="1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Harga Product</label>
                    <input type="text" class="form-control" id="price" placeholder="Masukan Jumlah" name="price" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Desc Product</label>
                    <input type="text" class="form-control" id="desc" placeholder="Masukan desc product" name="desc" required>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Category Product</label>
                      <select name="category" id="category" class="form-control">
                          <option hidden>== Select Category ==</option>
                          @foreach($category as $c)
                          <option value="{{$c->name}}">{{$c->name}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <b>Upload Gambar</b><br/>
                    <input id="file" type="file" name="file" accept="image/*">
                  </div>

                  <div class="form-group">
                  <img class="backup_picture" id="image-prev" alt="Picture" width="200px"  src="{{asset('images/download.jfif')}}">
                    <img id="image" alt="Picture" width="400px"  src="" style="display:none">
                    <img id="image-after" alt="After" src="" style="display:none">
                    <button id="crop" type="button" class="btn btn-primary" style="display:none" >Crop</button>
                  </div>
                  <div class="form-group">
                    <input id="after" type="text" class="form-control" placeholder="Url" name="aftercrop" style="display:none" >
                  </div>
                  <div class="form-group">
                    <b id="label1" style="display:none">Upload Another Image</b><br/>
                    <img class="backup_picture1" id="image-prev1" alt="Picture" width="200px"  src="{{asset('images/download.jfif')}}" style="display:none">
                    <input id="file1" type="file" name="image1[]" accept="image/*" style="display:none"><br/><br/>
                    <img class="backup_picture2" id="image-prev2" alt="Picture" width="200px"  src="{{asset('images/download.jfif')}}" style="display:none">
                    <input id="file2" type="file" name="image1[]" accept="image/*" style="display:none"><br/><br/>
                    <img class="backup_picture3" id="image-prev3" alt="Picture" width="200px"  src="{{asset('images/download.jfif')}}" style="display:none">
                    <input id="file3" type="file" name="image1[]" accept="image/*" style="display:none"><br/><br/>
                  </div>
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
    <script src="https://unpkg.com/cropperjs/dist/cropper.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery-cropper.js')}}"></script>
    <script>


            $( "#image-prev" ).click(function()
                {
                  $('#file').trigger('click');
                  
                });
      

                $( "#image-prev1" ).click(function()
                {
                  $('#file1').trigger('click');
                  
                });
              $(document).ready(function (e) {
              $('#file1').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image-prev1').attr('src', e.target.result); 
                
                }
                reader.readAsDataURL(this.files[0]); 
              });
            });
            $('#file1').change(function(){  
              $('#file2').show();
              $('#image-prev2').show();
            }); 




            $( ".backup_picture2" ).click(function()
          {
            $('#file2').trigger('click');
          });
          $(document).ready(function (e) {
              $('#file2').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image-prev2').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
              });
            });
            $('#file2').change(function(){  
              $('#file3').show();
              $('#image-prev3').show();
            }); 


            $( ".backup_picture3" ).click(function()
            {
              $('#file3').trigger('click');
            });

          $(document).ready(function (e) {
              $('#file3').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image-prev3').attr('src', e.target.result); 
                }
                reader.readAsDataURL(this.files[0]); 
              });
            });

        $("#price").keyup(function() {
            if (/\D/g.test(this.value))
            {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, '');
            }
            $(this).val(convertNumberToPrice($(this).val()))
        });

        var $crop = $('#crop');
        var $image = $('#image');
        $image.cropper({
          aspectRatio: 195 / 243,
        });
            
        //on upload image
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#image').attr('src', e.target.result);
              $image.cropper("destroy");
              $image.cropper({
              cropBoxResizable: false,
                aspectRatio: 195 / 243,
                data:{ //define cropbox size
                    width: 243,
                    height:  195,
                  },
              });
              $image.show();
              $('#image-prev').hide();
           

            }
            reader.readAsDataURL(input.files[0]);
          } else {
            alert('select a file to see preview');
            $('#image').attr('src', '');
            $image.hide();
           
          };
      
        }

        $("#file").change(function() {
          readURL(this);
          $crop.show();
        
        });
        $('#crop').click(function(){
          $image = $('#image');
          var cropper = $image.data('cropper');
          var url = cropper.getCroppedCanvas( {fillColor: '#fff'}).toDataURL('image/jpeg').replace(/^data:image\/[^;]+/, 'data:application/octet-stream');
          $("#image-after").attr('src', url);
          $("#after").val( url);
          var $url = ("#url");
          $("#image-after").show();
          $(this).hide();
          $("#image").cropper("destroy");
          $("#image").hide();
          $('#label1').show();
          $('#file1').show();
          $('#image-prev1').show();
      })
        
    </script>
@endsection
