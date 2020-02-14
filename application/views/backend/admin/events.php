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
				
										$op="posted_by='admin'";
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
                                                
                                              <?php /*?><div class="tooltip-sidebar-toggle">
                                              
                                              
                            
                           
                             <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/events/edit/<?php echo $id;?>');"> <button type="button" class="btn btn-blue btn-xs" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-pencil"></i></button>
                              </a>                          
                                                                    
                        
                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/events/delete/<?php echo $id;?>');"><button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="delete"><i class="fa fa-trash-o"></i></button></a>
                        
                    </div><?php */?>
                    
                    <?php /*?><div class="tooltip-demo">

                    <button type="button" class="btn btn-blue" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
                                        Action
                                    </button>

                      </div><?php */?>  
                      <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/events/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/events/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->

           
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
                                    <h4>Add Event</h4>
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
            echo form_open("admin/events/add_event", $attributes);?>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" name="title" required placeholder="Enter Event Title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Notice</label>
                                                    <textarea required name="notice" rows="6"  class="form-control" placeholder="Add Notice"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date</label>
                                                    <div id="sandbox-container">
                                                    <input class="form-control" required type="text" name="edate" placeholder="mm/dd/yyyy" />
                                                	</div>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="1" name="check">Check if the event is private.
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-green btn-block">Submit</button>
                                            <?php echo form_close();?>

                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->

                </div>
                <!-- /.row -->
                
                
	
