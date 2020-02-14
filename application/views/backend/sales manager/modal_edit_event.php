<?php foreach($event_id->result() as $row):
$id=$row->id;
$title=$row->title;
$notice=$row->notice;
$date=$row->event_date;
$status=$row->status;


?>

                                 <?php endforeach;?>
					 <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("salesManager/events/update_event/".$id, $attributes);?>
            
            <center><h3><i class="fa fa-clipboard"></i> Edit Your Personal Event :</h3></center>
            <hr />
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    
                                                    <input type="hidden" name="check" value="1" />
                                                    <input type="text" class="form-control" value="<?php echo $title; ?>" name="title" required placeholder="Enter Event Title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Notice</label>
                                                    <textarea required name="notice" rows="3"  class="form-control" placeholder="Add Notice"> <?php echo $notice; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <div id="sandbox-container">
                                                    <input class="form-control" required type="text" name="edate" placeholder="mm/dd/yyyy" value="<?php echo date('m/d/Y', $date)?>" />
                                                	</div>
                                                </div>
                                                <br />
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Event</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>
                                            <?php echo form_close();?>