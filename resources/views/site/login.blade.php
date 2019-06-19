
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IEI Anchor Pensions [Recapture] - Login</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
    body {
        color: #999;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
	}
	.form-control {
		box-shadow: none;
		border-color: #ddd;
	}
	.form-control:focus {
		border-color: #4aba70; 
	}
	.login-form {
        width: 350px;
		margin: 0 auto;
		padding: 30px 0;
	}
    .login-form form {
        color: #434343;
		border-radius: 1px;
    	margin-bottom: 15px;
        background: #fff;
		border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
	}
	.login-form h4 {
		text-align: center;
		font-size: 22px;
        margin-bottom: 20px;
	}
    .login-form .avatar {
        color: #fff;
		margin: 0 auto 30px;
        text-align: center;
		width: 100px;
		height: 100px;
		border-radius: 50%;
		z-index: 9;
		background: #4aba70;
		padding: 15px;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
    .login-form .avatar i {
        font-size: 62px;
    }
    .login-form .form-group {
        margin-bottom: 20px;
    }
	.login-form .form-control, .login-form .btn {
		min-height: 40px;
		border-radius: 2px; 
        transition: all 0.5s;
	}
	.login-form .close {
        position: absolute;
		top: 15px;
		right: 15px;
	}
	.login-form .btn {
		background: #4aba70;
		border: none;
		line-height: normal;
	}
	.login-form .btn:hover, .login-form .btn:focus {
		background: #42ae68;
	}
    .login-form .checkbox-inline {
        float: left;
    }
    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .login-form .forgot-link {
        float: right;
    }
    .login-form .small {
        font-size: 13px;
    }
    .login-form a {
        color: #4aba70;
    }
    .error-form{
        color: #f00;
    }

</style>
</head>
<body>
<div class="login-form">    
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/process_login') }}" id="form-login">
    {!! csrf_field() !!}
		<div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
    	<h4 class="modal-title">Login with your PIN</h4>
        <div class="form-group">
            <input type="text" name="PIN" id="PIN" class="form-control" placeholder="PIN" required="required" value="{{ old('PIN') }}">
            <br>
            @if (session('error_msg'))
                <div class="alert alert-danger">
                <strong> {{ session('error_msg') }}</strong>
                </div>
            @endif
            
            @if ($errors->has('PIN'))
                <div class="alert alert-danger">
                <strong> {{ $errors->first('PIN') }}</strong>
                </div>
            @endif
        </div>
        <button id="login_button" type="submit" class="btn btn-success btn-lg btn-block info">
            Login
        </button>    
             
    </form>	
</div>

<script type="text/javascript">
$(document).ready(function () {


var base_url = "http://localhost:81/IEIOnlineRecapture/";
// var base_url = "https://datarecapture.ieianchorpensions.com/";


$("#login_button").on("click", function(){
    var client_pin=$("#PIN").val();
    if(client_pin)
    $(this).text("Logging in...")
//   var login_button=$(this).text()
});

});


</script>

</body>
</html>                                		                            