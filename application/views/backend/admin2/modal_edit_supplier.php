
<?php foreach($sup_id->result() as $row):
$id=$row->supplier_id;
$sname=$row->supplier_name;
$s=$row->supplier_number;
$phone=$row->supplier_phone;
$ad=$row->supplier_address;
$em=$row->supplier_email;
$d=$row->date_added;
?>
<?php endforeach;?>
 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">
	<blockquote><h3><?php echo get_phrase('edit_supplier_details'); ?></h3></blockquote>

<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/suppliers/update_supplier/".$id, $attributes);?>
            
            <div class="form-group">
                                                    <label><?php echo get_phrase('supplier_number'); ?> :</label>
                                                    
                                                    <input type="text" class="form-control" value="<?php echo $s; ?>" name="sn" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('supplier_name'); ?> :</label>
                                                   <input type="text" class="form-control" value="<?php echo $sname; ?>" name="sname" required placeholder="<?php echo get_phrase('supplier_name'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('phone'); ?></label>
                                                   <input type="text" class="form-control" value="0<?php echo $phone; ?>" name="phone" required placeholder="<?php echo get_phrase('phone'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('email'); ?> :</label>
                                                   <input type="text" class="form-control" value="<?php echo $em; ?>" name="email" required placeholder="<?php echo get_phrase('email'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo get_phrase('address'); ?></label>
                                                   <input type="text" class="form-control" value="<?php echo $ad; ?>" name="address" required placeholder="<?php echo get_phrase('address'); ?>">
                                                </div>
                                                
                                                <br />
                                                <button type="submit" id="btnSave" class="btn btn-green"><?php echo get_phrase('update_supplier'); ?></button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> <?php echo get_phrase('reset'); ?></button>

<?php echo form_close();?>                 

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->