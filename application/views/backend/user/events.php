<?php $jina=$this->db->get_where('login', array('id' => $actype_id)); ?>
<?php foreach($jina->result() as $row):
$un=$row->user_id;
endforeach
?>
 <div class="row">

                    <div class="col-lg-8">

                        <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Events</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <ul id="myPortletTab" class="list-inline tabbed-portlets">
                                        <li class="active"><a class="btn btn-xs btn-default" href="#cal" data-toggle="tab">My Calendar</a>
                                        </li>
                                        <li><a class="btn btn-xs btn-default" href="#eve" data-toggle="tab">View Events</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <div id="myPortletTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="cal">
                                        <div class="table-responsive">
                                    		<div id="calendar"></div>
                                		</div>
                                    </div>
                                    <div class="tab-pane fade" id="eve">
                                        <!--events table-->
                                        <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Notice</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
				
										$op="status='0' OR posted_by='user' AND user_id=".$un."";
										 $this->db->order_by('event_date','desc');
										 $event=$this->db->get_where('events',$op);
										 foreach($event->result() as $row):
										$state=$row->status;
										$title=$row->title;
										$d=$row->event_date;
										$notice=$row->notice;
										$id=$row->id;
										?>
                               <?php if($state==0){$disp='Public';}else{$disp='Private';} ?>
                                            <tr>
                                                <td><b><?php echo $title; ?></b></td>
                                                <td><?php echo $notice; ?></td>
                                                <?php if($disp=='Public'){ ?>
                                                <td><span class="badge green"><?php echo $disp; ?></span></td>
                                                <?php }else{ ?>
                                                <td><span class="badge orange"><?php echo $disp; ?></span></td>
                                                <?php } ?>
                                                <td><?php echo date('M,d,Y', $d); ?></td>
                                                <td>
                                                
                      							<?php if($state=='1'): ?>
                      <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>user/events/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>user/events/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    <?php endif ?>

           
                                            </tr>
                                           
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>


                                        <!--end events-->
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="portlet portlet-green">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Add Your Personal Event</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                               <!-- <div id='external-events'>
                                    <div class='external-event'>Lunch</div>
                                    <div class='external-event'>Meeting</div>
                                    <div class='external-event'>Break</div>
                                    <div class='external-event'>Client</div>
                                    <div class='external-event'>Interview</div>
                                    <p>
                                        <input type='checkbox' id='drop-remove' />
                                        <label for='drop-remove'>Remove After Drop</label>
                                    </p>
                                </div>-->
                                 <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data');
            echo form_open("user/events/add_event", $attributes);?>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" required placeholder="Enter Event Title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Notice</label>
                                                    <textarea required name="notice" rows="6"  class="form-control" placeholder="Add Notice"></textarea>
                                                </div>
                                                <div class="form-group">
                                                	<input type="hidden" name="user_id" value="<?php echo $un ?>" />
                                                    <label>Date</label>
                                                    <div id="sandbox-container">
                                                    <input class="form-control" required type="text" name="edate" placeholder="mm/dd/yyyy" />
                                                	</div>
                                                </div>
                                                <button type="submit" class="btn btn-green btn-block">Submit</button>
                                            <?php echo form_close();?>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->

                </div>
                <!-- /.row -->
                
                
	
