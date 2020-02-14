<?php foreach($desc_id->result() as $row):
$id=$row->description_id;
$name=$row->d_name;
$un=$row->unit;
$q=$row->quantity;
?>
<?php endforeach;?>
<center><h3><i class="fa fa-edit"></i> Edit Description</h3></center>
<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("manager/descriptions/update/".$id, $attributes);?>
                                                <div class="form-group">
                                                    <label>Description name * :</label>
                                                    <input type="text" class="form-control" value="<?php echo $name; ?>" name="name" required placeholder="e.g Kilogrammes">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Unit * :</label>
                                                    <input type="text" class="form-control" value="<?php echo $un; ?>" name="unit" required placeholder="e.g kg">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Quantity/Measurement * :</label>
                                                    <input type="text" class="form-control" value="<?php echo $q; ?>" name="quantity" required >
                                                </div>	
                                                
                                                <button type="submit" class="btn btn-green">Update</button>	
                                                <button type="reset" class="btn btn-orange">Reset</button>
                                                <?php echo form_close()?>		 
               