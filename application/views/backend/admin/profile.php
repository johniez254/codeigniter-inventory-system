 <?php
            $username=$this->session->userdata('username');
            $role=$this->session->userdata('role');
            $sess_id=$this->session->userdata('login_user_id');           
            
            ?>
			
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-8">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('admin_profile') ?></h4>
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
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> <?php echo get_phrase('manage_profile') ?></a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-unlock-alt"></i> <?php echo get_phrase('change_password') ?></a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        
                                        <!--manage profile-->
                                        
                                         <?php $setting_id=$this->db->get_where('login', array('id' => $sess_id)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$pass=$row->password;
$names=$row->names;
//$address=$row->address;
$em=$row->username;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/profile/update/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('name')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('name') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>get_phrase('name'),
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
                                                          
                                                                <label><?php echo get_phrase('name') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>get_phrase('name'),
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
                                                          
                                                                <label><?php echo get_phrase('username') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>get_phrase('username'),
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
                                                          
                                                                <label><?php echo get_phrase('username') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>get_phrase('username'),
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
                                                            
                                                            
                                                                 <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('role') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'role',
								'type'=>'text',
								'placeholder'=>get_phrase('role'),
								'class'=>'form-control',
								'id'=>'role',
								'value'=>$role,
								'readonly'=>'readonly'
								
								);
								echo form_input($data);
								echo form_error('role');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>get_phrase('save'),
								
								);
								echo form_submit($data);
								?>
                                
                                                       <?php 
								$data=array(
								'type'=>'reset',
								'class'=>'btn btn-orange',
								'value'=>get_phrase('reset'),
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                        
                                         <!--end manage profile-->
                                        
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/profile/pass/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('oldpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('current_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>get_phrase('current_password'),
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('current_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>get_phrase('current_password'),
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
                                                          
                                                                <label><?php echo get_phrase('new_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>get_phrase('new_password'),
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('current_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>get_phrase('new_password'),
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
                                                          
                                                                <label><?php echo get_phrase('confirm_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>get_phrase('confirm_password'),
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('confirm_password') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>get_phrase('confirm_password'),
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
								'value'=>get_phrase('change_password'),
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->
                                        
                                    </div>
                                </div>
                                
                                </div></div>
                                <!-- nested col-lg-12 and row -->
                                
                                <?php } else{ ?>
                                
                                 
                                <ul id="myTab" class="nav nav-tabs">
                                    <li><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> <?php echo get_phrase('manage_profile') ?></a>
                                    </li>
                                    <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-unlock-alt"></i> <?php echo get_phrase('change_password') ?></a>
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
//$address=$row->address;
//$em=$row->email;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/profile/update/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('name')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('name') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>get_phrase('name'),
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
                                                          
                                                                <label><?php echo get_phrase('name') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>get_phrase('name'),
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
                                                          
                                                                <label><?php echo get_phrase('username') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>get_phrase('username'),
								'class'=>'form-control',
								'id'=>'username',
								'value'=>$username,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{ ?>
                                                            
                                                            <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('username') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>get_phrase('username'),
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
                                                            
                                                            
                                                                 <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('role') ?> :</label>
                 <?php 
								$data=array(
								'name'=> 'role',
								'type'=>'text',
								'placeholder'=>get_phrase('username'),
								'class'=>'form-control',
								'id'=>'role',
								'value'=>$role,
								'readonly'=>'readonly'
								
								);
								echo form_input($data);
								echo form_error('role');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>get_phrase('save'),
								
								);
								echo form_submit($data);
								?>
                                
                                                       <?php 
								$data=array(
								'type'=>'reset',
								'class'=>'btn btn-orange',
								'value'=>get_phrase('reset'),
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                        
                                         <!--end manage profile-->
                                        
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade in active" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/profile/pass/".$sess_id, $attributes);?>
                                                                        
															<?php if(form_error('oldpass')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('current_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>get_phrase('current_password'),
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('current_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>get_phrase('current_password'),
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
                                                          
                                                                <label><?php echo get_phrase('new_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>get_phrase('new_password'),
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('new_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>get_phrase('new_password'),
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
                                                          
                                                                <label><?php echo get_phrase('confirm_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>get_phrase('confirm_password'),
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('confirm_password')?> :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>get_phrase('confirm_password'),
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
								'value'=>get_phrase('change_password'),
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->
                                        
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
                                            <h4><i class="fa fa-picture-o"></i> <?php echo get_phrase('upload_profile_picture');?></h4>
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
                                        
                                        <h4><?php echo get_phrase('current_picture')?> :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('admin',$id);?>"  alt="" width="150px" height="150px">
                    </a>
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'admin/profile/update_image/'.$sess_id.'', $at);?>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic'); ?></label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								'required'=>'required'
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify');?></p>
                              <?php
                                                                $dat=array(
								'type'=>'submit',
								'value'=>get_phrase('upload'),
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
