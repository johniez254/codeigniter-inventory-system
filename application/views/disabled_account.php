<?php
echo doctype('html5');
$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;
?>
<head>
	<meta charset="utf-8">
	<title>Success page</title>
<?php include'includes_top.php';?>
   

</head>



<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-banner text-center">
                    <h1><i class="fa fa-gears"></i> <?php echo $system_title; ?></h1>
                </div>
                <div class="portlet portlet-green">
                    <div class="portlet-body">
                    	<div class="alert alert-info">
                                            <center><h2><i class="fa fa-meh-o"></i> Oops <?= $username ?>!</h2> Your Account is temporarily disabled. Please Contact the administrator to activate your account.</center>
                                        </div>
                                        <a href="<?php echo base_url().'main/index' ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-sign-in"></i> Back to Login</a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<?php include'includes_bottom.php';?>

</body>
</html>