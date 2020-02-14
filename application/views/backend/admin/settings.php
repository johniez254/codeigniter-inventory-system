
								
                                 <div class="row">                    
                    
                     <div class="col-lg-8">
                     <div class="row">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                     <h4><i class="fa fa-gears"></i> <?php echo get_phrase('settings');?></h4>
                                </div>
                                <div class="portlet-widgets">
                                    <ul id="myTab" class="list-inline tabbed-portlets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#purplePortlet"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="purplePortlet" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade in active" id="general">
                                            <h4>
                                            	<strong><i class="fa fa-list"></i> <?php echo get_phrase('general_settings');?><hr /></strong>
                                            </h4> <div class="row">
                                        <div class="col-lg-12">
                                     
									 <?php $setting_id=$this->db->get_where('settings', array('id' => 1)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$sname=$row->systemname;
$st=$row->systemtitle;
$address=$row->address;
$em=$row->email;
$phone=$row->phone;
//$cur=$row->currency;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/settings/update/1", $attributes);?>
                                                                        
															<?php if(form_error('sname')==''){ ?>
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('system_name');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'sname',
								'type'=>'text',
								'placeholder'=>get_phrase('system_name'),
								'class'=>'form-control',
								'id'=>'sname',
								'value'=>$sname,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                                 <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('system_name');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'sname',
								'type'=>'text',
								'placeholder'=>get_phrase('system_name'),
								'class'=>'form-control',
								'id'=>'sname',
								'value'=>set_value('sname'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('sname'); ?></span>
                                                            </div>
                                                            <?php }if (form_error('st')==''){?>
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('system_title');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'st',
								'type'=>'text',
								'placeholder'=>get_phrase('system_title'),
								'class'=>'form-control',
								'id'=>'st',
								'value'=>$st,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
								echo form_error('st');
															
								 ?>
                                      
                                                            </div>
                                                            <?php }else{?>
                                                            
                                                                <div class="form-group has-error">
                                                          
                                                                <label><?php echo get_phrase('system_title');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'st',
								'type'=>'text',
								'placeholder'=>get_phrase('system_title'),
								'class'=>'form-control',
								'id'=>'st',
								'value'=>set_value('st'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                      <span class="help-block"><?php echo form_error('st'); ?></span>
                                                            </div>
                                                            
                                                            <?php }?>
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('address');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>get_phrase('address'),
								'class'=>'form-control',
								'id'=>'address',
								'value'=>$address,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
								echo form_error('address');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('email');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'email',
								'type'=>'email',
								'placeholder'=>get_phrase('address'),
								'class'=>'form-control',
								'id'=>'email',
								'value'=>$em,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
								echo form_error('email');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('phone_number');?> :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'number',
								'placeholder'=>get_phrase('phone_number'),
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>$phone,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
								echo form_error('phone');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                                           <div class="form-group">
                                                          
                                                                <label><?php echo get_phrase('language');?> :</label>
                                  <select name="lang" class="form-control">
                                <?php
									$fields = $this->db->list_fields('language');
									foreach ($fields as $field)
									{
										if ($field == 'phrase_id' || $field == 'phrase')continue;
										
										$current_default_language	=	$this->db->get_where('settings' , array('id'=>'1'))->row()->language;
										?>
                                		<option value="<?php echo $field;?>"
                                        	<?php if ($current_default_language == $field)echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php
									}
									?>
                           </select>
                                      
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

                                            
                                        </div>
                                    </div>
                                        </div>
                                        <div class="tab-pane fade" id="language">
                                            <h4>
                                            	<strong><i class="fa fa-rocket"></i> <?php echo get_phrase('language_settings');?><hr /></strong>
                                            </h4>
                                            


                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.col-lg-8-->

                    
                    
                    

                    <div class="col-lg-4">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-picture-o"></i> <?php echo get_phrase('upload_logo');?></h4>
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
                                        
                                        <h4><?php echo get_phrase('current_logo');?> :</h4>
                                        <div class="tile light-gray">

                    <a href="#">
                        <img src="<?php echo base_url(); ?>components/img/logo.png" class="img-responsive" alt="">
                    </a>
                                        </div>
                                        
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'admin/settings/update_logo/'.$id.'', $at);?>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('choose_a_new_logo');?></label>
                              
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
                        
                        
                     <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-shield"></i> Data Manager</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet2"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="headingsPortlet2" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                         
                                         	<!--<div class="btn-group btn-group-justified">
                                        <a class="btn btn-blue" role="button"><i class="fa fa-folder"></i> Backup</a>
                                        <a class="btn btn-red" role="button"><i class="fa fa-mail-reply-all"></i> Restore</a>
                                    </div>
                                    -->
                                    
                                    <div class="panel-group" id="accordion">
                                            <div class="panel panel-green">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration:none;">
                                                        <p class="panel-title"><button class="btn btn-blue btn-block"><i class="fa fa-download"></i> <?php echo get_phrase('backup_data');?></button></p>
                                                    </a>
                                                <div id="collapseOne" class="panel-collapse collapse" style="border-left:1px solid #2980b9; border-bottom:1px solid #2980b9; border-right:1px solid #2980b9;">
                                                    <div class="panel-body">
                                                        <!--back up data-->
                                                        <center>

                <table cellpadding="0" cellspacing="0" border="0" class="table table-normal" >

                    <tbody>
                                                        
                                                        
                    	<?php 

						for($i = 1; $i<= 14; $i++):

						

							if($i	==	1)	$type	=	'all';

							else if($i	==	2)$type	=	'category';
							else if($i	==	3)$type	=	'descriptions';
							else if($i	==	4)$type	=	'events';
							else if($i	==	5)$type	=	'history_logs';
							else if($i	==	6)$type	=	'language';
							else if($i	==	7)$type	=	'login';
							else if($i	==	8)$type	=	'orders';
							else if($i	==	9)$type	=	'order_item';
							else if($i	==	10)$type	=	'profiles';
							else if($i	==	11)$type	=	'purchases';
							else if($i	==	12)$type	=	'settings';
							else if($i	==	13)$type	=	'stock';
							else if($i	==	14)$type	=	'supplier';

							?>

							<tr>

								<td><?php echo $type;?></td>

								<td align="center">

									<a href="<?php echo base_url();?>admin/settings/create/<?php echo $type;?>" 

										class="btn btn-blue btn-xs" data-toggle="tooltip" title="download backup"><i class="fa fa-download" ></i>

											</a>

								</td>

							</tr>

							<?php 

						endfor;

						?>

                    </tbody>

                </table>

                </center>

                                                        
                                                        <!--end backuu data-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-green">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration:none;">
                                                        <p class="panel-title"><button class="btn btn-orange btn-block"><i class="fa fa-mail-reply-all"></i> <?php echo get_phrase('restore_data');?></button></p>
                                                    </a>
                                                <div id="collapseTwo" class="panel-collapse collapse" style="border-left:1px solid #f39c12; border-bottom:1px solid #f39c12; border-right:1px solid #f39c12;">
                                                    <div class="panel-body">
                                                        <?php echo form_open('admin/settings/restore' , array('enctype' => 'multipart/form-data'));?>

                   <div class="form-group">
                                                    <input type="file" name="userfile" id="exampleInputFile">
                                                    <p class="help-block"><?php echo get_phrase('to_restore_data');?>.</p>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-orange btn-block"><?php echo get_phrase('restore_backup');?></button>

                <?php echo form_close();?>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>


                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-12 (nested) -->


                        </div>
                        <!-- /.row (nested) -->
                                        

                    </div>
                    <!-- /.col-lg-4 -->                                     
                                    
                    
                </div>
                <!-- /.row -->

