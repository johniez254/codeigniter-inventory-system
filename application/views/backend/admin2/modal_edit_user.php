
<?php foreach($user_id->result() as $row):
$id=$row->id;
$fn=$row->fullnames;
$un=$row->username;
$phone=$row->phone;
$ad=$row->address;
$idno=$row->idno;
$d=$row->datereg;
$r=$row->role;
?>
<?php endforeach;?>
<?php $userpic       =	$this->db->get_where('login' , array('user_id'=>$id))->row()->id;?>
 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#picture" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo get_phrase('photo'); ?></a>
                                    </li>
                                    <li><a href="#user" data-toggle="tab"><i class="fa fa-user"></i> <?php echo get_phrase('profile'); ?></a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="picture">
                                        
                                        <!--start picture-->
                                        
                                        
                                        <h4><?php echo get_phrase('current_picture'); ?> :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('user',$userpic);?>"  alt="" width="200px" height="200px">
                    </a>
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data", "id"=>"updateUserimage");
            echo form_open_multipart(base_url() .'admin/users/edit_image/'.$userpic.'', $at);?>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic'); ?></label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_specify'); ?></p>
                              <?php
                                                                $dat=array(
								'type'=>'submit',
								'value'=>get_phrase('upload'),
								'class'=>'btn btn-green',
								'id'=>'submit'
								
								);
								echo form_input($dat);
								
								 ?>
                                 
                                 <?php
                                                                $dat=array(
								'type'=>'reset',
								'value'=>get_phrase('reset'),
								'class'=>'btn btn-orange',
								
								);
								echo form_input($dat);
								
								 ?>
                                 
                                 </div>
                                                        <?php echo form_close()?>
                                        
                                        
                                        <!--end profile-->
                                        
                                        
                                    </div>
                                    <div class="tab-pane fade" id="user">


<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/users/update_user/".$id, $attributes);?>
            
            <div class="form-group">
                                                    <label><?php echo get_phrase('fullnames'); ?></label>
                                                    
                                                    <input type="text" class="form-control" value="<?php echo $fn; ?>" name="names" required placeholder="Fullnames">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('username'); ?></label>
                                                   <input type="text" class="form-control" value="<?php echo $un; ?>" name="username" required placeholder="Username">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('phone'); ?></label>
                                                   <input type="text" class="form-control" value="<?php echo $phone; ?>" name="phone" required placeholder="Phone Number">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('idno'); ?></label>
                                                   <input type="text" class="form-control" value="<?php echo $idno; ?>" name="idno" required placeholder="Address">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('address'); ?></label>
                                                   <input type="text" class="form-control" value="<?php echo $ad; ?>" name="address" required placeholder="Address">
                                                </div>
                                                <div class="form-group">
                                                <label><?php echo get_phrase('role'); ?></label>
                                                <select name="role" class="form-control">
                                    	<option value="user" <?php if($r == 'user')echo 'selected';?>>User</option>
                                    	<option value="accountant" <?php if($r == 'accountant')echo 'selected';?>>Accountant</option>
                                    </select>
                                    			</div>
                                                <br />
                                                <button type="submit" id="btnSave" class="btn btn-green"><?php echo get_phrase('update'); ?></button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> <?php echo get_phrase('reset'); ?></button>

<?php echo form_close();?>
                                        
                                        
                                    </div>
                               </div>                 

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->