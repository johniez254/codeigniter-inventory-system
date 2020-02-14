 
 <?php foreach($stock_id->result() as $row):
$stock_id=$row->stock_id;
$name=$row->name;
$category=$row->category;
$description_id=$row->description_id;
$purchase_id=$row->purchase_id;
$b_price=$row->b_price;
$s_price=$row->s_price;
$available=$row->available;
$purchases_ordered=$row->purchases_ordered;
$purchase_total=$row->purchase_total;
$damaged=$row->damaged;

endforeach;

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
$oc="stock_id=".$stock_id."";
$this->db->select_sum('quantity_ordered');
$this->db->from('order_item');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$quantity_ordered=0;
foreach($desc as $row):
$quantity_ordered+=$row['quantity_ordered'];
endforeach;
?>
<?PHP
$oc="stock_id=".$stock_id."";
$this->db->select_sum('total');
$this->db->from('order_item');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$total=0;
foreach($desc as $row):
$total+=$row['total'];
endforeach;
?>
<?php
$desc_unit       =	$this->db->get_where('descriptions' , array('description_id'=>$description_id))->row()->unit;
$desc_quat       =	$this->db->get_where('descriptions' , array('description_id'=>$description_id))->row()->quantity;
$category       =	$this->db->get_where('category' , array('category_id'=>$category))->row()->c_name;
?>
 <!-- FAQ Accordion -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">

                                <div class="row">
                                    <div class="col-lg-9">
                                <div id="printer">
                                   
                                    <h3><span class="text text-blue">Stock:</span> <?=$name?>(<?=$desc_quat?><?=$desc_unit?>)<span class="text-muted"> &mdash; <?=$category?></span></h3>
                                    <hr />
                                     	<div class="row">
                                        	<div class="col-sm-3">
                                            	<div class="well well-sm">
                                                <h4><?=$available?></h4>
                                            	<p><small><strong>Quantity Available</strong></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                            	<div class="well well-sm">
                                            	<h4><?=$damaged?></h4>
                                            	<p><small><strong>Quantity Damaged</strong></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                            	<div class="well well-sm">
                                            	<h4><?=$quantity_ordered?></h4>
                                            	<p><small><strong>Total Sold</strong></small></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                            	<div class="well well-sm">
                                            	<h4><?=formatMoney($total,true)?></h4>
                                            	<p><small><strong>Revenue (Ksh)</strong></small></p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                         
                                    <div class="row">
                                        <div class="col-sm-4">
                                        <!--image-->
                                        <h4>Stock Picture</h4>
                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('stock',$stock_id);?>"  alt="">
                    </a>
                                        <!--end image-->
                                        
                                        </div>
                                        <div class="col-sm-4">
                                        <h4>Overview</h4>
                                        	<div class="table-responsive">
                                        	<table class="table">
                                            <tr>
                                                	<td>Stock Id:</td>
                                                    <td><b>00<?=$stock_id?></b></td>
                                                </tr>
                                            	<tr>
                                                	<td>Stock Name:</td>
                                                    <td><b><?=$name?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Category:</td>
                                                    <td><b><?=$category?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Description:</td>
                                                    <td><b><?=$desc_quat?><?=$desc_unit?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Status:</td>
                                                    <td><b><?php if($available=='0'){echo'<span class="label orange">Not Available</span>';}else{echo'<span class="label green">Available</span>';} ?></b></td>
                                                </tr>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                        <h4>Pricing</h4>
                                        	<div class="table-responsive">
                                        	<table class="table table-striped">
                                            
                                                <tr>
                                                	<td>Buying Price (Ksh):</td>
                                                    <td class="text-right"><b><?=formatMoney($b_price,true)?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Selling Price (Ksh):</td>
                                                    <td class="text-right"><b><?=formatMoney($s_price,true)?></b></td>
                                                </tr>
                                            	<tr>
                                                	<td>Purchases(Ksh):</td>
                                                    <td class="text-right"><b><?=formatMoney($purchase_total,true)?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Sales(Ksh):</td>
                                                    <td class="text-right"><b><?=formatMoney($total,true)?></b></td>
                                                </tr>
                                                <tr>
                                                	<td>Profit earned(Ksh):</td>
                                                    <?php 
														$sp=$s_price*$quantity_ordered;
														$bp=$b_price*$quantity_ordered;
														$profit=$sp-$bp;
													 ?>
                                                    <td class="text-right"><b><?=formatMoney($profit,true)?></b></td>
                                                </tr>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                         
                                    </div>
                                    </div>

                                    <div class="col-lg-3">
                                      <br /><br /><br /><br />
                                        <a href="<?php echo base_url().'admin/stock/view' ?>" class="btn btn-default btn-block"><i class="fa fa-arrow-circle-left"></i> Bact To Stock</a>
                                        <hr>
                                        <nav class="navbar mailbox-topnav" role="navigation">
                                        <div class="mailbox-nav">
                                        <ul class="nav navbar-nav button-tooltips">
                                            <li class="message-actions">
                                                <div class="btn-group navbar-btn">
                                                	<button type="button" class="btn btn-white" data-toggle="tooltip" data-placement="bottom" title="Edit Details" onclick="showAjaxModal('<?php echo base_url();?>admin/stock/edit/<?php echo $stock_id;?>');"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="bottom" title="Print"><i class="fa fa-print"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-white" data-toggle="tooltip" data-placement="bottom" title="Mark Damaged" onclick="showAjaxModalSmall('<?php echo base_url();?>admin/stock/damage/<?php echo $stock_id;?>');"><i class="fa fa-exclamation-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-white" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="confirm_modal('<?php echo base_url();?>admin/stock/delete/<?php echo $stock_id;?>');"><i class="fa fa-trash-o"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                        </div>
                                        </nav>
                                        <hr />
                                         <h4>Quick links</h4>
                                        <ul class="nav nav-pills nav-stacked">
                                            <li><a href="<?php echo base_url().'admin/stock/view' ?>">Manage Stock</a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/descriptions/view' ?>">Manage Descriptions</a>
                                            </li>
                                            <li><a href="<?php echo base_url().'admin/category/view'?>">Manage Categories</a>
                                            </li>
                                        </ul>
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
     <script>
	 //Morris Donut Chart
Morris.Donut({
element: 'morris-chart-donut',
data: [
 {label: "Referrals", value: 42.7},
 {label: "Direct", value: 8.3},
 {label: "Social", value: 12.8},
 {label: "Organic", value: 36.2}
],
resize: true,
colors: ['#16a085','#2980b9', '#f39c12', '#e74c3c'],
formatter: function (y) { return y + "%" ;}
});
	 </script>