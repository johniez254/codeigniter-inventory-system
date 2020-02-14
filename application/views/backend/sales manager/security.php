<?php $username       =	$this->session->userdata('username'); ?>
<?php $user_id       =	$this->session->userdata('login_user_id');
$quiz       =	$this->db->get_where('login' , array('id'=>$user_id))->row()->question;
$ans      =	$this->db->get_where('login' , array('id'=>$user_id))->row()->answer; 
$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle;


if($quiz=='1'or $quiz=='2'){
?>

<div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <h3 class="error-msg"><i class="fa fa-info-circle text-blue"></i> <?php if ($quiz=='1'){echo "Welcome";}else{echo "Hi";}?> <?php echo $username; ?>.</h3>
                        
                        <p class="lead"><small><small><?php if ($quiz=='1'){echo "It Seems You are Logging into ".$system_title." for the first time. ";}else{echo "";}?>For Security measures and Reasons, it is advisable to set up a security question for recovery actions incase you lose your password.</small></small></p>
                        <div class="well">
                        	<h4>Add Your Security Question Here...</h4>
                            <form action="<?php echo base_url() ?>salesManager/security_question/add/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($user_id)))))))); ?>" method="post">
                            <?php if(form_error('quiz')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                            <label>Security Question</label>
                            <input type="text" autocomplete="off" name="quiz" class="form-control" placeholder="e.g What is your favourite book?" value="<?php echo set_value('quiz') ?>">
                            <span class="help-block"><?php echo form_error('quiz'); ?></span>
                            </div>
                            <?php if(form_error('pass1')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                                	<label>Your Answer</label>
                                    <input type="password" name="pass1" value="<?php echo set_value('pass1') ?>" class="form-control" placeholder="Input Answer To Your Question here..">
                            <span class="help-block"><?php echo form_error('pass1'); ?></span>
                            </div>
                            <?php if(form_error('pass2')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                                	<label>Confirm Answer</label>
                                    <input type="password" value="<?php echo set_value('pass2') ?>" name="pass2" class="form-control" placeholder="Confirm Your Answer here..">
                                    <span class="help-block"><?php echo form_error('pass2'); ?></span>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-green btn-sm">Submit</button>
                            <button type="reset" class="btn btn-orange btn-sm">Reset</button>
                            <!-- /input-group -->
                            </form>
                        </div>
                        
                        <ul class="list-inline">
                            <li>
                                <a class="btn btn-default" href="<?php echo base_url() ?>salesManager/dashboard"><i class="fa fa-arrow-circle-left"></i> Back to Dashboard</a>
                            </li>
                             <li>
                                <a class="btn btn-blue" href="<?php echo base_url() ?>salesManager/profile/view"><i class="fa fa-hand-o-right"></i> View Your Profile</a>
                            </li>
                            <li>
                                <a class="logout_open btn btn-red" href="#logout"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
                <br />
                <?php }else{ ?>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <h3 class="error-msg"><i class="fa fa-thumbs-up text-blue"></i> Ready to go <?php echo $username; ?>.</h3>
                        
                        <p class="lead"><small>You have successfully created your security question. You will use it incase you forget Your Password.</small></p>
                        <div class="well">
                        	<h4>Edit Security Question</h4>
                            <form action="<?php echo base_url() ?>salesManager/security_question/add/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($user_id)))))))); ?>" method="post">
                            <?php if(form_error('quiz')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                            <label>Security Question</label>
                            <input type="text" autocomplete="off" name="quiz" class="form-control" placeholder="e.g What is your favourite book?" value="<?php echo $quiz; ?>">
                            <span class="help-block"><?php echo form_error('quiz'); ?></span>
                            </div>
                            <?php if(form_error('pass1')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                                	<label>Your Answer</label>
                                    <input type="password" name="pass1" value="<?php echo set_value('pass1'); ?>" class="form-control" placeholder="Input Answer To Your Question here..">
                            <span class="help-block"><?php echo form_error('pass1'); ?></span>
                            </div>
                            <?php if(form_error('pass2')==''){echo'<div class="form-group">';}else{ echo '<div class="form-group has-error">';} ?>
                                	<label>Confirm Answer</label>
                                    <input type="password" value="<?php echo set_value('pass2'); ?>" name="pass2" class="form-control" placeholder="Confirm Your Answer here..">
                                    <span class="help-block"><?php echo form_error('pass2'); ?></span>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-green btn-sm">Submit</button>
                            <button type="reset" class="btn btn-orange btn-sm">Reset</button>
                            <!-- /input-group -->
                            </form>
                        </div>
                        
                        <ul class="list-inline">
                            <li>
                                <a class="btn btn-default" href="<?php echo base_url() ?>salesManager/dashboard"><i class="fa fa-arrow-circle-left"></i> Back to Dashboard</a>
                            </li>
                             <li>
                                <a class="btn btn-blue" href="<?php echo base_url() ?>salesManager/profile/view"><i class="fa fa-hand-o-right"></i> View Your Profile</a>
                            </li>
                            <li>
                                <a class="logout_open btn btn-red" href="#logout"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
                <br />
                <?php } ?>
