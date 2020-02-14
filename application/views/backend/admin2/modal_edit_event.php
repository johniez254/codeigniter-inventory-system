<?php foreach($event_id->result() as $row):
$id=$row->id;
$title=$row->title;
$notice=$row->notice;
$date=$row->event_date;
$status=$row->status;


?>

                                 <?php endforeach;?>
					 <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("admin/events/update_event/".$id, $attributes);?>
                                                <div class="form-group">
                                                    <label>Title</label>
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
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="check">Check if the event is private.
                                                    </label>
                                                </div>
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Event</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>
                                            <?php echo form_close();?>