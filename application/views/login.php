<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("dist/css/sb-admin-2.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div id="sucess_msg" class="alert alert-success" style="display:none"></div>
                    <div id="error_msg" class="alert alert-danger" style="display:none"></div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a id="button_login" class="btn btn-lg btn-success btn-block">Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="loader"></div>

    <!-- jQuery -->
    <script src="<?php echo base_url("vendor/jquery/jquery.min.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("vendor/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("dist/js/sb-admin-2.js"); ?>"></script>
    
    <script type="text/javascript">
	$("#button_login").click(function(){
		var param = { username: $("#username").val(), password:$("#password").val()};
		$.ajax({
			method: "POST",
			url: "<?php echo base_url("/index.php/api/login_api/userlogin"); ?>",
			dataType: "json",
			data: param,
			success: function(data){
				var loginObject = JSON.parse(data);
				if(loginObject[0].ResponseType){
					$("#sucess_msg").html(loginObject[0].ErrorMessage);
					$("#sucess_msg").show();
					$("#error_msg").hide();
					setTimeout(function(){ 
						window.location.href = "<?php echo base_url("/index.php/home"); ?>";
					}, 1000);					
				}
				else{
					$("#error_msg").html(loginObject[0].ErrorMessage);
					$("#sucess_msg").hide();
					$("#error_msg").show();
				}
			},
			error: function(xhr, status, error) {
			  var err = eval("(" + xhr.responseText + ")");
			  alert(err.Message);
			}
		});
	});
	</script>

</body>

</html>
