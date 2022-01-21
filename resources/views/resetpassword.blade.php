<html>
    <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <style>
    .form-gap {
    padding-top: 70px;
}
            </style>
</head>
<body>

 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Reset Password </h2>
                  <p>Enter Your New Password</p>
                  <div class="panel-body">
                  <div class="form-group">
            <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="{{route('home.passwordupdate')}}">
                @csrf
                <input id="token" name="token" type="text" style="display:none" value="{{$token}}">
                <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input id="password" name="password" placeholder="password" class="form-control"  type="password"  required>
                </div>
                </div>
                <div class="form-group ">
                <div class="input-group">
                <span class="input-group-addon"><i class="color-blue"></i></span>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>
                <div class="form-group">
                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                </div>
            </form>
                      </div>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
</body>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $('#register-form').validate({
        rules : {
            password : {
                minlength : 5
            },
            password_confirmation : {
                minlength : 5,
                equalTo : '[name="password"]'
            }
        },
        messages: {
            password: {
                required: "password is required",
                minlength: "Masukan minimal 5 digit"
            },
            password_confirmation: {
                required: "confirm password is required",
                equalTo : 'Confirm password not same'
            }
        }
    })
</script>
</html>