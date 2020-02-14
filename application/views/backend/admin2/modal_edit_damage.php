    <?php foreach($damage->result() as $row):
$id=$row->stock_id;
$name=$row->name;
$cat_id=$row->category;
$d_id=$row->description_id;
$av=$row->available;
$damaged=$row->damaged;
?>
<?php endforeach;?>
<center><blockquote class="text-blue"><b>Add Quantity of <?php echo $name; ?> Damaged</b></blockquote></center>
<form action="<?php echo base_url().'admin/stock/update_damage/'.$id?>" method="post" >
	 <div class="form-group">
    	<label>Available Quantity</label>
    	<input type="number" name="available" class="form-control" min="0" value="<?php echo $av; ?>" readonly />
    
    </div>
    <div class="form-group">
    	<label>Damaged Quantity</label>
    	<input type="number" name="damage" class="form-control" min="0"  required/>
        <input type="hidden" name="rem" value="<?php echo $damaged; ?>" />
    
    </div>
    <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Add</button>
    <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
</form>