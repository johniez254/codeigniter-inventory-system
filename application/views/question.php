<?php
echo doctype('html5');
$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;
?>
<head>
	<meta charset="utf-8">
	<title>Login page</title>
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
                            <h4><strong>Security Question?</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">
                    <?php if($question!='1'){?>
                    
                        <?php echo form_open('main/forgot_password/confirm_answer'); ?>
                        
                        <p><b>Question : </b><span class="text text-blue"><?= $question; ?></span></p>
                                 <?php if(form_error('ans')==''){ ?>
                                <div class="form-group">
                                <?php 
								$data=array(
								'name'=> 'ans',
								'type'=>'password',
								'value'=>$this->input->post('ans'),
								'placeholder'=>'Input Your answer Here',
								'autocomplete'=>'off',
								'required'=>'required',
								'class'=>'form-control'
								
								);
								echo form_input($data);
								
								 ?>
                                </div>
                                <?php }else{?>
                                <div class="form-group has-error">
                                <?php 
								$data=array(
								'name'=> 'ans',
								'type'=>'password',
								'value'=>$this->input->post('ans'),
								'placeholder'=>'Answer',
								'autocomplete'=>'off',
								'required'=>'required',
								'class'=>'form-control'
								
								);
								echo form_input($data);
								
								 ?>                                
                                <span class="help-block">
                        <?php echo form_error('ans'); ?>
                        		</span>
                                </div>
                                <?php }?>
                                <input type="hidden" value="<?= $username?>" name="username">
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
                                <a href="<?php echo base_url() ?>main/forgot_password/forgot">Back To Forgot Password</a>|<a href="<?php echo base_url() ?>main/index">Or Login</a>
                            </p>
                        <?php echo form_close();
					}else{
						 ?>
                         <h4>Dear <b><?=$username;?></b>,</h4>
                         <p>It Seems like you had not yet set your security question before. You are therefore recomended to contact your <a href="Mailto:johnsonmatoke@gmail.com"><span class="text text-blue">Administrator</span></a> for further assistance.</p>
                         <a href="<?php echo base_url().'main/index' ?>" class="btn btn-lg btn-green btn-block">Back To Login</a>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<?php include'includes_bottom.php';?>

</body>
</html>