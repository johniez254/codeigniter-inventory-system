<?php
echo doctype('html5');
$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;
?>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
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
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title">
                            <h4><strong>Change Your Password <?= $username ?></strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                    
                        <?php echo form_open('main/forgot_password/change_password'); ?>
                        
                                <div class="form-group">
                                <label>Username :</label>
                                <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'value'=>$username,
								'placeholder'=>'username',
								'autocomplete'=>'off',
								'readonly'=>'readonly',
								'class'=>'form-control'
								
								);
								echo form_input($data);
								
								 ?>
                                </div>
                               
                                
                                <?php if(form_error('password')==''){ ?>
                                <div class="form-group">
                                <?php }else{?>
                                <div class="form-group has-error">
                                <?php }?>
                                <label>New Password</label>
                                    <?php 
								$data=array(
								'name'=> 'password',
								'type'=>'password',
								'placeholder'=>'Password',
								'class'=>'form-control',
								'value'=>set_value('password'),
								
								);
								echo form_input($data);
								
								 ?>
                                 <span class="help-block">                        
                                 <?php echo form_error('password'); ?>
                                 </span>
                                </div>
                                
                                <?php if(form_error('cpassword')==''){ ?>
                                <div class="form-group">
                                <?php }else{?>
                                <div class="form-group has-error">
                                <?php }?>
                                <label>Confirm Password</label>
                                    <?php 
								$data=array(
								'name'=> 'cpassword',
								'type'=>'password',
								'placeholder'=>'Confirm Password',
								'class'=>'form-control',
								'value'=>set_value('cpassword'),
								
								);
								echo form_input($data);
								
								 ?>
                                 <span class="help-block">                        
                                 <?php echo form_error('cpassword'); ?>
                                 </span>
                                </div>
                                <br>
                              <?php 
								$data=array(
								'type'=> 'submit',
								'value'=>'Submit',
								'class'=>'btn btn-lg btn-green btn-block'
								
								);
								echo form_submit($data);
								
								 ?>
                            <br>
                            <p class="small">
                                <a href="<?php echo base_url() ?>main/index">Or Login?</a>
                            </p>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<?php include'includes_bottom.php';?>

</body>
</html>