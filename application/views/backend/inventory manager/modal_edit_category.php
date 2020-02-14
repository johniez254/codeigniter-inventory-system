<?php foreach($cat_id->result() as $row):
$id=$row->category_id;
$c_name=$row->c_name;
$status=$row->status;
//$paid=$row->paid;
endforeach;
?>
<center><blockquote class="text-blue"><b>Edit Category</b></blockquote></center>
<form action="<?php echo base_url().'admin/category/update_category/'.$id?>" method="post" >
	 <div class="form-group">
    	<label>Category Name</label>
    	<input type="text" name="c_name" class="form-control" value="<?php echo $c_name; ?>" required />
    
    </div>
    <div class="form-group">
    <label>Status</label>
    	<select name="status" class="form-control">
                              <option value="1"<?php if($status == 1) {
				      							echo "selected";
				      							} ?> >Available</option>
                                            	<option value="0"<?php if($status == 0) {
				      							echo "selected";
				      							} ?> >Not Available</option>
        </select>
    
    </div>
    <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Update</button>
    <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>
</form>