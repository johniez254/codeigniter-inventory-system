<?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/category/add", $attributes);?>
            <center><blockquote><b>Add Category</b></blockquote></center>
            									
                                                <small><div id="sucmessage"></div></small>
            									<small><div id="alertmsg"></div></small>
                                                <div class="form-group">
                                                    <label>Category name * :</label>
                                                    <input type="text" id="name" class="form-control" value="" name="name" required placeholder="Name" autocomplete="off">
                                                </div>
                                                
                                                <div class="form-group">
                                                	<label>Status * :</label>
                                                    <select name="status" id="status" class="form-control">
                                                    	<option value="1" selected>Available</option>
                                                        <option value="0">Not Available</option>
                                                    </select>
                                                </div>
                                                
                                                <button type="button" id="submit" onclick="ajax_validate()" class="btn btn-green">Add</button>	
                                                <button type="reset" class="btn btn-orange">Reset</button>		 
               <?php echo form_close() ?>