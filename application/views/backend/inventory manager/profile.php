 <?php
            $username=$this->session->userdata('username');
            $role=$this->session->userdata('role');
            $sess_id=$this->session->userdata('login_user_id');           
            $quiz       =	$this->db->get_where('login' , array('id'=>$sess_id))->row()->question;
            ?>
			
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-8">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>User Profile &raquo; <?php echo $username; ?></h4>
                                </div>
                                <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet1"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="headingsPortlet1" class="panel-collapse collapse in">
                            <div class="portlet-body">
                            
                            	<div class="row">
                                <div class="col-lg-12">
                                
                                <?php
								
								//confirm for absence of error (incase no error instance)
								if(form_error('oldpass')=='' && form_error('newpass')=='' && form_error('confpass')=='' ){
								
								 ?>
                                 
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> Manage Profile</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-unlock-alt"></i> Change Password</a>
                                    </li>
                                    <li><a href="#security" data-toggle="tab"><i class="fa fa-question-circle"></i> Security Question</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        
                                        <!--manage profile-->
                                        
                                         <?php $setting_id=$this->db->get_where('login', array('id' => $sess_id)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$pass=$row->password;
//$names=$row->names;
//$address=$row->address;
$em=$row->username;
$user_id=$row->user_id;


?>

                                 <?php endforeach;?>
                                 
                                 <?php $profile_id=$this->db->get_where('profiles', array('id' => $user_id)); ?>
								 <?php foreach($profile_id->result() as $row):
$pid=$row->id;
$phone=$row->phone;
$address=$row->address;
$idno=$row->idno;
$names=$row->fullnames;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("manager/profile/update/".$pid, $attributes);?>
                                                                        
															<?php if(form_error('name')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Names * :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'Your Fullnames',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>$names,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Name * :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'Your Name',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>set_value('name'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('name'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                           
                                                         
                                                                                                                      
                                                            <?php if(form_error('username')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Username * :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>'Your username',
								'class'=>'form-control',
								'id'=>'username',
								'value'=>$em,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Username * :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>'Your username',
								'class'=>'form-control',
								'id'=>'username',
								'value'=>set_value('username'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('username'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                             <?php if(form_error('phone')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Phone Number * :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'text',
								'placeholder'=>'Your phonenumber',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>$phone,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Phone Number * :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'text',
								'placeholder'=>'Your phonenumber',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>set_value('phone'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('phone'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                             <?php if(form_error('address')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Address * :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>'Your address',
								'class'=>'form-control',
								'id'=>'address',
								'value'=>$address,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Address :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>'Your address',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>set_value('address'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('address'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Id Number :</label>
                 <?php 
								$data=array(
								'name'=> 'idno',
								'type'=>'number',
								'placeholder'=>'Your idno',
								'class'=>'form-control',
								'id'=>'idno',
								'value'=>$idno,
								'readonly'=>'readonly',
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>                                                           
                                                            
                                                                
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'Save',
								
								);
								echo form_submit($data);
								?>
                                
                                                       <?php 
								$data=array(
								'type'=>'reset',
								'class'=>'btn btn-orange',
								'value'=>'Reset',
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                        
                                         <!--end manage profile-->
                                        
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("manager/profile/pass/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('oldpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Current Password :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>'Your Current Password',
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Current Password :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>'Your Current Password',
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('oldpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                            <?php if(form_error('newpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>New Password :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>'Your New Password',
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>New password :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>'Your New Password',
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('newpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                            <?php if(form_error('confpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Confirm Password :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>'Confirm Password',
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Confirm Password :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>'Confirm Password',
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('confpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                              <?php
														   $data=array(
														   'type'=>'hidden',
														   'name'=>'username',
														   'value'=>$username,
														   );
														   echo form_input($data);
														    ?>
                                                            
                                                         
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'Change Password',
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->
                                        
                                    </div>
                                    <div class="tab-pane fade" id="security">
                                    	<h3>Hi? <?=$username?>,</h3>
                                        <?php if($quiz=='1' or $quiz=='2'){ ?>
                                        <p>You have not yet set up your security question. You are Recommended To do that. Incase you lose your password, it will help your in the password Recovery Actions.</p>
                                        <a href="<?=base_url().'manager/security_question/security'?>" class="btn btn-green btn-sm">Setup now?</a>
                                        <?php }else{ ?>
                                        <p>You have already setup your security question. You are good to go. You can however edit your security question details if you want to.</p>
                                        <p><b>Your question : </b><span class="text-blue"><?=$quiz?></span></p>
                                        <a href="<?=base_url().'manager/security_question/security'?>" class="btn btn-green btn-sm">Edit now?</a>
                                        <?php }?>
                                    </div>
                                </div>
                                
                                </div></div>
                                <!-- nested col-lg-12 and row -->
                                
                                <?php } else{ ?>
                                
                                 
                                <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> Manage Profile</a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-unlock-alt"></i> Change Password</a>
                                    </li>
                                    
                                    <li><a href="#security" data-toggle="tab"><i class="fa fa-question-circle"></i> Security Question</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade" id="home">
                                        
                                        <!--manage profile-->
                                        
                                         <?php $setting_id=$this->db->get_where('login', array('id' => $sess_id)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$pass=$row->password;
$names=$row->names;
$em=$row->username;
$user_id=$row->user_id;


?>

                                 <?php endforeach;?>
                                 
                                 <?php $profile_id=$this->db->get_where('profiles', array('id' => $user_id)); ?>
								 <?php foreach($profile_id->result() as $row):
$pid=$row->id;
$phone=$row->phone;
$address=$row->address;
$idno=$row->idno;
$names=$row->fullnames;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("manager/profile/update/".$pid, $attributes);?>
                                                                        
															<?php if(form_error('name')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Names * :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'Your Fullnames',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>$names,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Name * :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'Your Name',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>set_value('name'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('name'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                           
                                                         
                                                                                                                      
                                                            <?php if(form_error('username')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Username * :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>'Your username',
								'class'=>'form-control',
								'id'=>'username',
								'value'=>$em,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Username * :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>'Your username',
								'class'=>'form-control',
								'id'=>'username',
								'value'=>set_value('username'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('username'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                             <?php if(form_error('phone')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Phone Number * :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'text',
								'placeholder'=>'Your phonenumber',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>$phone,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Phone Number * :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'text',
								'placeholder'=>'Your phonenumber',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>set_value('phone'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('phone'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                             <?php if(form_error('address')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Address * :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>'Your address',
								'class'=>'form-control',
								'id'=>'address',
								'value'=>$address,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label>Address :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>'Your address',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>set_value('address'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      <span class="help-block"><?php echo form_error('address'); ?></span>
                                                            </div>
                                                            
                                                            <?php } ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Id Number :</label>
                 <?php 
								$data=array(
								'name'=> 'idno',
								'type'=>'number',
								'placeholder'=>'Your idno',
								'class'=>'form-control',
								'id'=>'idno',
								'value'=>$idno,
								'readonly'=>'readonly',
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>                                                           
                                                            
                                                                
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'Save',
								
								);
								echo form_submit($data);
								?>
                                
                                                       <?php 
								$data=array(
								'type'=>'reset',
								'class'=>'btn btn-orange',
								'value'=>'Reset',
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                        
                                         <!--end manage profile-->
                                        
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade in active" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("manager/profile/pass/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('oldpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Current Password :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>'Your Current Password',
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Current Password :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>'Your Current Password',
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('oldpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                            <?php if(form_error('newpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>New Password :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>'Your New Password',
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>New password :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>'Your New Password',
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('newpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                            <?php if(form_error('confpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label>Confirm Password :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>'Confirm Password',
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label>Confirm Password :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>'Confirm Password',
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('confpass'); ?></span>
                                                            </div>
                                                            <?php }?>
                                                            
                                                              <?php
														   $data=array(
														   'type'=>'hidden',
														   'name'=>'username',
														   'value'=>$username,
														   );
														   echo form_input($data);
														    ?>
                                                            
                                                         
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'Change Password',
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="security">
                                    	<h3>Hi? <?=$username?>,</h3>
                                        <?php if($quiz=='1' or $quiz=='2'){ ?>
                                        <p>You have not yet set up your security question. You are Recommended To do that. Incase you lose your password, it will help your in the password Recovery Actions.</p>
                                        <a href="<?=base_url().'manager/security_question/security'?>" class="btn btn-green btn-sm">Setup now?</a>
                                        <?php }else{ ?>
                                        <p>You have already setup your security question. You are good to go. You can however edit your security question details if you want to.</p>
                                        <p><b>Your question : </b><span class="text-blue"><?=$quiz?></span></p>
                                        <a href="<?=base_url().'manager/security_question/security'?>" class="btn btn-green btn-sm">Edit now?</a>
                                        <?php }?>
                                    </div>
                                </div>
                                
                                </div></div>
                                <!-- nested col-lg-12 and row -->
                                
                                <?php } ?>
                                
                            </div>
                            <!-- /.portlet-body -->
                            </div>
                            <!--collapse-->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                
                <!--end manage profile -->
                
                <!--start pass picture tab-->
                
                
                	<div class="col-lg-4">
                    	
                         <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-picture-o"></i> Upload Profile picture</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="headingsPortlet" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                        
                                        <h4>Current Picture :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('user',$sess_id);?>"  alt="" width="150px" height="150px">
                    </a>
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'manager/profile/update_image/'.$sess_id.'', $at);?>
                                                            <div class="form-group">
                                                                <label>Choose a New Picture</label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG</p>
                              <?php
                                                                $dat=array(
								'type'=>'submit',
								'value'=>'Upload',
								'class'=>'btn btn-green btn-block',
								'id'=>'submit'
								
								);
								echo form_input($dat);
								
								 ?>
                                                            </div>
                                                        <?php echo form_close()?>

                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-12 (nested) -->


                        </div>
                        <!-- /.row (nested) -->

                        
                    </div>
                
                <!--end pass picture tab-->
                
                </div>
                <!-- /.full row -->
