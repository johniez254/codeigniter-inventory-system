<?php 
$uid=$this->session->userdata('login_user_id');
$quiz=$this->db->get_where('login' , array('id'=>$uid))->row()->question;
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
    <?php $actype_id       =	$this->session->userdata('login_user_id'); ?>
    <?php $jina=$this->db->get_where('login', array('id' => $actype_id)); ?>
	<?php foreach($jina->result() as $row):
	$un=$row->user_id;
	endforeach
	?>

  <!-- begin DASHBOARD CIRCLE TILES -->
                <div class="row">
                <?php if($quiz=='1' or $quiz=='2'): ?>
                	<div class="col-lg-12">
                    	 <div class="alert alert-info alert-dismissable">
                           	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><i class="fa fa-info-circle"></i> Info Alert:</strong> You have not yet set your security Question. To set your security question, <b><a href="<?php echo base_url().'manager/security_question/security' ?>"><i class="fa fa-hand-o-right"></i> Click here...</a></b>
                      	</div>

                    </div>
                    <?php endif ?>
                    <div class="col-xs-6 col-sm-3">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."manager/stock/view" ?>">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-suitcase fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Stock Available
                                </div>
                                <div class="circle-tile-number text-faded">
                                	<?php
											$where="deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$count	=	$this->db->count_all_results();
									?>
                                    <?php echo $count; ?>
                                </div>
                                <a href="<?php echo base_url()."manager/stock/view" ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-6 col-sm-3">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/stock/view' ?>">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-exclamation-triangle fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Low Stock
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
                                <a href="<?php echo base_url().'manager/stock/view' ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."manager/sales/view" ?>">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-money fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Sales
                                </div>
                                <div class="circle-tile-number text-faded">
                                     <?php echo $this->db->count_all('orders'); ?>
                                </div>
                                <a href="<?php echo base_url()."manager/sales/view" ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                   <!-- <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-bell fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Alerts
                                </div>
                                <div class="circle-tile-number text-faded">
                                    9 New
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-tasks fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Tasks
                                </div>
                                <div class="circle-tile-number text-faded">
                                    10
                                    <span id="sparklineB"></span>
                                </div>
                                <a href="#" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-xs-6 col-sm-3">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/purchases/view' ?>">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-thumb-tack fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Purchases
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php
//$ol="due>=1";
$this->db->select('*');
$this->db->from('purchases');
//$this->db->where($ol);
$out	=	$this->db->count_all_results();

echo $out;
?>
                                </div>
                                <a href="<?php echo base_url().'manager/purchases/view' ?>" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end DASHBOARD CIRCLE TILES -->
                
                    <div class="row">

                    <div class="col-lg-3">
                        <div class="tile tile-img tile-time" style="height: 200px">
                            <p class="time-widget">
                                <span class="time-widget-heading">It Is Currently</span>
                                <br>
                                <strong>
                                    <span id="datetime"></span>
                                </strong>
                            </p>
                        </div>
                        <div class="tile dark-blue checklist-tile" style="height: 370px">
                            <h4><i class="fa fa-check-square-o"></i> Recent Events</h4>
                            <hr />
                            <?php
                            $op="status='0' OR posted_by='inventory manager' AND user_id=".$un."";
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
                        <?php endforeach ?>
                        <a href="<?php echo base_url().'inventory manager/events/view' ?>" class="btn btn-white btn-block btn-xs"><i  class="fa fa-arrow-circle-right"></i> View All Events Details</a>
                    </div>
                    </div>
                    
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="tile green" style="height: 320px">
                                    <h4>SALES / PURCHASES STATISTICS <a href="javascript:;"><i class="fa fa-refresh pull-right"></i></a>
                                    </h4>
                                    <div id="morris-chart-dashboard"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="tile green" style="height: 320px">
                                    <h4><i class="fa fa-bolt"></i> DB Status <a href="javascript:;"><i class="fa fa-refresh pull-right"></i></a>
                                    </h4>
                                    <hr />
                                    <p class="text-faded">
                                        <strong><i class="fa fa-gavel"></i> Driver : </strong><?php echo $this->db->platform(); ?><br /><br />
                                        <strong><i class="fa fa-fire"></i>&nbsp;&nbsp;Version : </strong><?php echo $this->db->version(); ?><br /><br />
                                        <strong><i class="fa fa-cloud-download"></i> Memory : </strong>
                                        <?php echo $this->benchmark->memory_usage();?><br /><br />
                                        <strong><i class="fa fa-rocket"></i>&nbsp;&nbsp;Time : </strong>
                                        <?php echo $this->benchmark->elapsed_time();?>s<br /><br />
                                        <?php echo  (ENVIRONMENT === 'development') ?  '<strong><i class="fa  fa-leaf"></i> &nbsp;System Version : </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . CI_VERSION . '' : '' ?>
                                    </p>
                                    <div class="flot-chart flot-chart-dashboard">
                                        <div class="flot-chart-content" id="flot-chart-moving-line"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 col-sm-6">
                                <div class="tile green dash-demo-tile">
                                 <?php
											$where="deleted='0' AND available<='10'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											//$this->db->order_by('available','asc');
											//$this->db->limit('2');
											//$this->db->join('category', 'category.category_id = stock.category');
											//$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$countdesc	=	$this->db->count_all_results();
											?>
                                    <h4><i class="fa fa-shopping-cart fa-fw"></i> Low Stock (<?=$countdesc?>)</h4>
                                    
                                    <?php if($countdesc!='0'){ ?>
                                    
                                    <div class="table-responsive">
                                    <table class="table table-green">
                                        <thead>
                                            <tr>
                                                <th><center>#</center></th>
                                                <th><center>Image</center></th>
                                                <th><center>Products</center></th>
                                                <th><center>Remaining</center></th>
                                                <th><center>Price (Ksh)</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="deleted='0' AND available<='10'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->order_by('available','asc');
											$this->db->limit('2');
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
								$i=1;
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $price= $row['s_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                		<tr>                             
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><?php echo $avail; ?></td>
                                                <td><?php echo formatMoney($price,true); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                   <?php }else{
									   ?> 
                                       <bR />
                                       <h3 class="text-left"><i class="fa fa-check"></i> No Low Stock Available.</h3>
                                       <?php
								   }
									   ?>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
