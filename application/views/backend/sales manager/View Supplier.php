<?php foreach($sid->result() as $row):
$id=$row->supplier_id;
$sname=$row->supplier_name;
$s=$row->supplier_number;
$phone=$row->supplier_phone;
$ad=$row->supplier_address;
$em=$row->supplier_email;
$d=$row->date_added;
?>
<?php endforeach;?>
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
<?php
$oc="supplier_id=".$id."";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($oc);
$this->db->join('stock','stock.purchase_id=purchases.purchase_id');
$count_stock	=	$this->db->count_all_results();
?>

<?php
$oc="due>0 AND supplier_id=".$id."";
$this->db->select('*');
$this->db->from('purchases');
$this->db->where($oc);
$count_outstandings	=	$this->db->count_all_results();
?>

<?PHP
$oc="supplier_id=".$id."";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$tot=0;
foreach($desc as $row):
$tot+=$row['grand_total'];
endforeach;
?>
<?PHP
$oc="supplier_id=".$id."";
$this->db->select_sum('due');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$dtot=0;
foreach($desc as $row):
$dtot+=$row['due'];
endforeach;
?>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">
                                <ul id="userTab" class="nav nav-tabs">
                                    <li class="active"><a href="#overview" data-toggle="tab"><?php echo get_phrase('overview'); ?></a>
                                    </li>
                                    <li><a href="#profile-settings" data-toggle="tab"><?php echo get_phrase('update_supplier'); ?></a>
                                    </li>
                                </ul>
                                <div id="userTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="overview">

                                        <div class="row">
                                            <div class="col-lg-2 col-md-3">
                                                <h4><?php echo get_phrase('picture'); ?></h4>
                                                <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('supplier',$id);?>" alt="">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active"><?php echo get_phrase('overview'); ?></a>
                                                    <a href="<?php echo base_url().'salesManager/stock/view' ?>" class="list-group-item"><?php echo get_phrase('supplied'); ?><span class="badge green"><?=$count_stock?></span></a>
                                                    <a href="<?php echo base_url().'salesManager/outstandings/purchases' ?>" class="list-group-item"><?php echo get_phrase('outstandings'); ?><span class="badge orange"><?=$count_outstandings?></span></a>
                                                    <?php /*?><a href="#" class="list-group-item">Tasks<span class="badge blue">10</span></a><?php */?>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-5">
                                                <h1><?=$sname?></h1>
                                                <ul class="list-inline">
                                                    <li><i class="fa fa-user fa-muted"></i> <?php echo get_phrase('supplier'); ?></li>
                                                    <li><i class="fa fa-calendar fa-muted"></i> <?php echo get_phrase('supplier'); ?> <?php echo get_phrase('since'); ?>: <?=date('d'.'S'.'/'.'M'.'/'.'Y',$d)?></li>
                                                </ul>
                                                <HR>
                                                <p>
                                                	<blockquote>
                                                <table cellpadding="5">
                                                    <tr>
                                                    <td><B><?php echo get_phrase('total_purchasing_price'); ?> :</B></td><td>Ksh &nbsp;<?=formatMoney($tot,true);?></td>
                                                    </tr>
                                                    <tr>
                                                    <td><b><?php echo get_phrase('purchases_outstandings'); ?> :</b></td>
                                                    <td>Ksh &nbsp;<?=formatMoney($dtot,true);?>
                                                    </td>
                                                    </tr>
                                                   </table>  
                                                    </blockquote>               
                                                </p>
                                                <h3>Recent Supplies</h3>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><?php echo get_phrase('date_supplied'); ?></th>
                                                                <th><?php echo get_phrase('category'); ?></th>
                                                                <th><?php echo get_phrase('stock'); ?></th>
                                                                <th><?php echo get_phrase('quantity'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php
//count order items data
$oc="supplier_id=".$id."";
$this->db->select('*');
$this->db->limit('10');
$this->db->order_by('stock_id','desc');
$this->db->from('stock');
$this->db->where($oc);
$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
$this->db->join('purchases', 'purchases.purchase_id = stock.purchase_id');
$this->db->join('category','category.category_id=stock.category');
//$count	=	$this->db->count_all_results();
$desc	=	$this->db->get()->result_array();
											$i=1;
                                			foreach($desc as $row):
											$stock_name=$row['name'];
												$purchases_ordered=$row['purchases_ordered'];
												$purchase_total=$row['purchase_total'];
												$unit=$row['unit'];
									  			$quat=$row['quantity'];
												$price=$row['b_price'];
												$date=$row['purchase_date'];
												$c_name=$row['c_name'];
?>
                                                            <tr>
                                                                <td><?=$i++?></td>
                                                                <td><?=date('D'.'-'.'d'.'/'.'M'.'/'.'Y',$date)?></td>
                                                                <td><?=$c_name?></td>
                                                                <td><?=$stock_name?>&nbsp;(<?=$quat?><?=$unit?>)</td>
                                                                <td style="width:60px;" class="text-right"><?=$purchases_ordered?>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                            <a href="<?php echo base_url().'salesManager/suppliers/view' ?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> <?php echo get_phrase('back_to_suppliers'); ?></a>
                                        <hr>
                                                <h3><?php echo get_phrase('contact_details'); ?></h3>
                                                <p><i class="fa fa-phone fa-muted fa-fw"></i> +(254) <?=$phone?></p>
                                                <p><i class="fa fa-building-o fa-muted fa-fw"></i> <?=$ad?></p>
                                                <p><i class="fa fa-envelope-o fa-muted fa-fw"></i>  <a href="mailto:<?=$em?>"><?=$em?></a>
                                                </p>
                                                 <hr>
                                        <h4><?php echo get_phrase('quick_links'); ?></h4>
                                        <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'salesManager/sales/view' ?>"><?php echo get_phrase('sales'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/purchases/view' ?>"><?php echo get_phrase('purchases'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/outstandings/purchases' ?>"><?php echo get_phrase('purchases_outstandings'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/outstandings/sales' ?>"><?php echo get_phrase('sales_outstandings'); ?></a>
                                            </li>
                                            <li><a href="<?php echo base_url().'salesManager/stock/view' ?>"><?php echo get_phrase('manage_stock'); ?></a>
                                        </ul>
                                               
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="profile-settings">

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <ul id="userSettings" class="nav nav-pills nav-stacked">
                                                    <li class="active"><a href="#basicInformation" data-toggle="tab"><i class="fa fa-user fa-fw"></i> <?php echo get_phrase('basic_information'); ?></a>
                                                    </li>
                                                    <li><a href="#profilePicture" data-toggle="tab"><i class="fa fa-picture-o fa-fw"></i> <?php echo get_phrase('profile_picture'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-9">
                                                <div id="userSettingsContent" class="tab-content">
                                                    <div class="tab-pane fade in active" id="basicInformation">
                                                        <form role="form" action="<?php echo base_url().'salesManager/suppliers/update_supplier/'.$id?>" method="post">
                                                            <h4 class="page-header"><?php echo get_phrase('personal_information'); ?>:</h4>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('supplier_number'); ?></label>
                                                                <input type="text" name="sn" readonly class="form-control" value="<?=$s?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('supplier_name'); ?></label>
                                                                <input type="text" name="sname" required placeholder="<?php echo get_phrase('supplier_name'); ?>" class="form-control" value="<?=$sname?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('phone'); ?></label>
                                                                <input type="text" name="phone" required placeholder="<?php echo get_phrase('phone'); ?>" class="form-control" value="0<?php echo $phone?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('address'); ?></label>
                                                                <input type="text" class="form-control" name="address" required placeholder="<?php echo get_phrase('address'); ?>" value="<?=$ad?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label><i class="fa fa-envelope-o fa-fw"></i> <?php echo get_phrase('email'); ?></label>
                                                                <input type="email" name="email" required placeholder="Email" class="form-control" value="<?=$em?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-green"><?php echo get_phrase('update_supplier'); ?></button>
                                                            <button class="btn btn-orange" type="reset"><?php echo get_phrase('reset'); ?></button>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="profilePicture">
                                                        <h3><?php echo get_phrase('current_picture'); ?>:</h3>
                                                        <img class="img-responsive img-profile"  src="<?php echo $this->crud->get_image_url('supplier',$id);?>" alt="">
                                                        <br>
                                                        <form role="form" action="<?php echo base_url().'salesManager/suppliers/update_image/'.$id?>" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label><?php echo get_phrase('chose_new_pic'); ?></label>
                                                                <input type="file" name="userfile">
                                                                <p class="help-block"><i class="fa fa-warning"></i> <?php echo get_phrase('image_must_be_no_larger_than_500x500_pixels'); ?></p>
                                                                <button type="submit" class="btn btn-default"><?php echo get_phrase('update_supplier_picture'); ?></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->


                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->