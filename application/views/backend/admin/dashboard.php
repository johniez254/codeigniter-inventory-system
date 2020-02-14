  <?php
 function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}

?>
<?PHP
$this->db->select_sum('purchases_ordered');
$this->db->from('stock');
$desc=$this->db->get()->result_array();
$purchases_ordered=0;
foreach($desc as $row):
$purchases_ordered+=$row['purchases_ordered'];
endforeach;
?>
<?PHP
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$desc=$this->db->get()->result_array();
$purchase_total=0;
foreach($desc as $row):
$purchase_total+=$row['grand_total'];
endforeach;
?>
<?php
$where="due>='1'";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($where);
$this->db->order_by('purchase_date','asc');
$count_p	=	$this->db->count_all_results();
?>
<?PHP
$where="due>='1'";
$this->db->select_sum('due');
$this->db->from('purchases');
$this->db->where($where);
$desc=$this->db->get()->result_array();
$pgrand_total=0;
foreach($desc as $row):
$pgrand_total+=$row['due'];
endforeach;
?>
<?PHP
$where="due>='1'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($where);
$desc=$this->db->get()->result_array();
$sgrand_total=0;
foreach($desc as $row):
$sgrand_total+=$row['grand_total'];
endforeach;
?>
<?php
	$where="due>='1'";
	$this->db->select('*');
	$this->db->from('orders');
	$this->db->where($where);
	$this->db->order_by('order_date','asc');
	$count_s	=	$this->db->count_all_results();
				
 ?>
  <!-- begin DASHBOARD CIRCLE TILES -->

                <div class="row">
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."admin/suppliers/view" ?>">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('suppliers'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo $this->db->count_all('supplier'); ?>
                                </div>
                                <a href="<?php echo base_url()."admin/suppliers/view" ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'admin/sales/view' ?>">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-shopping-cart fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('sales'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php
$oc="deleted=0";
$this->db->select('*');
$this->db->from('orders');
$this->db->where($oc);
$count_orders	=	$this->db->count_all_results();

echo $count_orders;
?>
                                </div>
                                <a href="<?php echo base_url().'admin/sales/view' ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'admin/purchases/view' ?>">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-suitcase fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('purchases'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php
//$ol="deleted=0";
$this->db->select('*');
$this->db->from('purchases');
//$this->db->where($ol);
$lstock	=	$this->db->count_all_results();

echo $lstock;
?>
                                </div>
                                <a href="<?php echo base_url().'admin/purchases/view' ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'admin/stock/view' ?>">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-warning fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('low_stock'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php
$ol="available<=10";
$this->db->select('*');
$this->db->from('stock');
$this->db->where($ol);
$low_stock	=	$this->db->count_all_results();

echo $low_stock;
?>
                                    
                                </div>
                                <a href="<?php echo base_url().'admin/stock/view' ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."admin/users/view" ?>">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-user fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('users'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                     <?php echo $this->db->count_all('profiles'); ?>
                                </div>
                                <a href="<?php echo base_url()."admin/users/view" ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                  
                     <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'admin/events/view' ?>">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-bell fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    <?php echo get_phrase('total_events'); ?>
                                </div>
                                <div class="circle-tile-number text-faded">
                                      <?php
$op="posted_by='admin'";
$this->db->select('*');
$this->db->from('events');
$this->db->where($op);
$events	=	$this->db->count_all_results();

echo $events;
?>
                                </div>
                                <a href="<?php echo base_url().'admin/events/view' ?>" class="circle-tile-footer"><?php echo get_phrase('more_info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end DASHBOARD CIRCLE TILES -->
                
                    <div class="row">

                    <div class="col-lg-3">
                        <div class="tile tile-img tile-time" style="height: 200px">
                            <p class="time-widget">
                                <span class="time-widget-heading"><?php echo get_phrase('it_is_currently'); ?></span>
                                <br>
                                <strong>
                                    <span id="datetime"></span>
                                </strong>
                            </p>
                        </div>
                        <div class="tile dark-blue checklist-tile" style="height: 350px">
                            <h4><i class="fa fa-check-square-o"></i> <?php echo get_phrase('recent_events'); ?></h4>
                            <hr />
                            <?php
                            $op="posted_by='admin'";
							$this->db->order_by('event_date','desc');
							$this->db->limit('4');
										 $event=$this->db->get_where('events',$op);
										 foreach($event->result() as $row):
										$state=$row->status;
										$title=$row->title;
										$d=$row->event_date;
										$notice=$row->notice;
										$id=$row->id;
										?>
                            <div class="checklist">
                            <?php $now_date=date('m'.'/'.'d'.'/'.'Y');
							$str_date=strtotime($now_date);
							if($state=='0'){$p='Public';}else{$p='Private';}
							if($d < $str_date){?>
                            <small><?php echo $p; ?> Event</small>
                             <label class="selected">
                                    <input type="checkbox" checked> <i class="fa fa-tags fa-fw text-faded"></i> <?php echo $title; ?>  
                                    <span class="task-time text-faded pull-right"><?php echo date('j'.'S'.' - '.'M'.' - '.'Y',$d); ?></span>
                                </label>
								<?php }else{?>
                            
                               <small><?php echo $p; ?> Event</small>
                                 <label>
                                    <input type="checkbox"> <?php if($state=='1'){?><i class="fa fa-tags fa-fw text-orange"></i><?php }else{?><i class="fa fa-tags fa-fw text-green"></i><?php } ?> <?php echo $title; ?>
                                    <span class="task-time text-faded pull-right"><?php echo date('j'.'S'.' - '.'M'.' - '.'Y',$d); ?></span>
                                </label>
                                <?php }?>
                            </div>
                                <hr />
                            <?php endforeach?>
                            <a href="<?php echo base_url().'admin/events/view' ?>" class="btn btn-white btn-block btn-xs"><i  class="fa fa-arrow-circle-right"></i> <?php echo get_phrase('view_all_events'); ?></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-9">
                    	<div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="tile green" style="height: 230px">
                                    <h4 style="border-bottom:3px double;padding-bottom:10px;"><i class="fa fa-hospital-o fa-fw"></i> <?php echo get_phrase('purchases_details'); ?></h4>
                                    <br />
                                    <center><strong><?php echo get_phrase('total_stock_ordered'); ?></strong></center>
                                       <center><h4><?=$purchases_ordered?></h4></center>
                                       <hr  />
                                    <center><strong><?php echo get_phrase('total_cost'); ?> (Ksh)</strong></center>
                                    <center><h4><?=formatMoney($purchase_total,true)?></h4></center>
                                    <hr />
                                </div>
                            </div>
                            <div class="col-lg-8 col-sm-6">
                                <div class="tile green" style="height: 230px; overflow:auto;">
                                    <h4 style="border-bottom:3px double;padding-bottom:10px;"><i class="fa fa-foursquare fa-fw"></i> <?php echo get_phrase('outstandings'); ?></h4>
                                    <div class="row">
                                    	<div class="col-sm-6">
                                        <div class="table-responsive">
                                        <table class="table">
                                        <tr>
                                        	<td colspan="2"><h4><strong><?php echo get_phrase('purchases_outstandings'); ?></strong></h4></td>
                                        </tr>
                                        <tr>
                                                	<td class="text-left"><b><?php echo get_phrase('outstandings'); ?>:</b></td>
                                                    <td class="text-right"><?=$count_p?></td>
                                                </tr>
                                                <tr>
                                                	<td class="text-left"><b><?php echo get_phrase('amount'); ?> (Ksh):</b></td>
                                                    <td class="text-right"><?=formatMoney($pgrand_total,true)?></td>
                                                </tr>
                                                <tr>
                                                	<td></td><td class="text-right"><a href="<?php echo base_url().'admin/outstandings/purchases' ?>" class="btn circle-tile-footer btn-xs"><i class="fa fa-angle-double-right"></i> <?php echo get_phrase('more_info'); ?></a></td>
                                                </tr>
                                        </table>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <div class="table-responsive">
                                        	<table class="table">
                                                <tr>
                                                    <td colspan="2"><h4><strong><?php echo get_phrase('sales_outstandings'); ?></strong></h4></td>
                                                </tr>
                                                <tr>
                                                	<td class="text-left"><b><?php echo get_phrase('outstandings'); ?>:</b></td>
                                                    <td class="text-right"><?=$count_s?></td>
                                                </tr>
                                                <tr>
                                                	<td class="text-left"><b><?php echo get_phrase('amount'); ?> (Ksh):</b></td>
                                                    <td class="text-right"><?=formatMoney($sgrand_total,true)?></td>
                                                </tr>
                                                <tr>
                                                	<td></td><td class="text-right"><a href="<?php echo base_url().'admin/outstandings/sales' ?>" class="btn circle-tile-footer btn-xs"><i class="fa fa-angle-double-right"></i> <?php echo get_phrase('more_info'); ?></a></td>
                                                </tr>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="tile green" style="height: 320px">
                                    <h4><i class="fa fa-shopping-cart"></i> <?php echo get_phrase('sales'); ?> / <?php echo get_phrase('purchases'); ?> <?php echo get_phrase('overview'); ?>(Ksh) <a href="javascript:;"><i class="fa fa-refresh pull-right"></i></a>
                                    </h4>
                                    <div id="morris-chart-dashboard"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="tile green" style="height: 320px">
                                    <h4><i class="fa fa-bolt"></i> DB <?php echo get_phrase('Status'); ?> <a href="javascript:;"><i class="fa fa-refresh pull-right"></i></a>
                                    </h4>
                                    <hr />
                                    <p class="text-faded">
                                        <strong><i class="fa fa-gavel"></i> <?php echo get_phrase('driver'); ?> : </strong><?php echo $this->db->platform(); ?><br /><br />
                                        <strong><i class="fa fa-fire"></i>&nbsp;&nbsp;<?php echo get_phrase('version'); ?> : </strong><?php echo $this->db->version(); ?><br /><br />
                                        <strong><i class="fa fa-cloud-download"></i> <?php echo get_phrase('memory'); ?> : </strong>
                                        <?php echo $this->benchmark->memory_usage();?><br /><br />
                                        <strong><i class="fa fa-rocket"></i>&nbsp;&nbsp;<?php echo get_phrase('time'); ?> : </strong>
                                        <?php echo $this->benchmark->elapsed_time();?>s<br /><br />
                                        <?php echo  (ENVIRONMENT === 'development') ?  '<strong><i class="fa  fa-leaf"></i> &nbsp; '.get_phrase('system_version').' : </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . CI_VERSION . '' : '' ?>
                                    </p>
                                    <div class="flot-chart flot-chart-dashboard">
                                        <div class="flot-chart-content" id="flot-chart-moving-line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
