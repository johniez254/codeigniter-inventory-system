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
				/**count all stock**/
				$where="deleted='0'";
				$this->db->select('*');
				$this->db->from('stock');
				$this->db->where($where);
				$count_all_stock	=	$this->db->count_all_results();
				
				/**count low stock**/
				$where="deleted='0' AND available<='10'";
				$this->db->select('*');
				$this->db->from('stock');
				$this->db->where($where);
				$count	=	$this->db->count_all_results();
				
				/**count damaged stock**/
				$whered="deleted='0' AND damaged >'0'";
				$this->db->select('*');
				$this->db->from('stock');
				$this->db->where($whered);
				$countd	=	$this->db->count_all_results();
				
				/**count sold stock**/
				$wheres="deleted_status='0'";
				$this->db->select('*');
				$this->db->from('order_item');
				$this->db->where($wheres);
				$count_sold	=	$this->db->count_all_results();
?>
 <!-- Pill Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4><?php echo get_phrase('stock'); ?></h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myPills" class="nav nav-pills" style="background-color:#f5f5f5;">
                                    <li class="active"><a href="#pillHome" data-toggle="tab"><?php echo get_phrase('available_stock'); ?> (<?php echo $count_all_stock; ?>)</a>
                                    </li>
                                    <li><a href="#pillProfile" data-toggle="tab"><?php echo get_phrase('low_stock'); ?> (<?php echo $count; ?>)</a>
                                    </li>
                                    <li><a href="#damaged" data-toggle="tab"><?php echo get_phrase('damaged_stock'); ?> (<?php echo $countd; ?>)</a>
                                    </li>
                                    
                                    <li><a href="#sold" data-toggle="tab"><?php echo get_phrase('sold_stock'); ?> (<?php echo $count_sold;?>)</a>
                                    </li>
                                </ul>
                                <hr />
                                <div id="myPillsContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="pillHome">
                                    
                                    		<?php											
											if($count_all_stock=='0'){
											?>
                                    
                                    
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    
                                    <?php }else{?>
                                    
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/excel' ?>" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Excel"><i class="fa fa-table"></i>
                                                    </a><?php */?>
                                         <a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a>
                                    	</div>
                                    </div>
                                    
                                    <?php }?>
                                        
                                        <div class="table-responsive">
                                         <div id="printer">
                                    <table class="table table-hover table-bordered  table-green" id="example-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th><?php echo get_phrase('item'); ?></th>
                                                <th><?php echo get_phrase('available'); ?></th>
                                                <th><?php echo get_phrase('damaged'); ?></th>
                                                <th><?php echo get_phrase('buying_price'); ?></th>
                                                <th><?php echo get_phrase('selling_price'); ?></th>
                                                <th><?php echo get_phrase('action'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->order_by('name','asc');
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $sprice= $row['s_price'];
								$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                			<?php if($avail<=10){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                                
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $avail; ?></center></td>
                                                <td><center><?php echo $damage; ?></center></td>
                                                <td><center><?php echo $bprice; ?></center></td>
                                                <td><center><?php echo $sprice; ?></center></td>
                                                <td style="width:150px;">
                                                    	 
                                                         
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="text-align:left;">
                                        	<li><a href="<?php echo base_url().'salesManager/stock/view_stock/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($id)))))))) ?>"><small><i class="fa fa-book"></i> View Stock</small></a>
                                            </li>
                                            
                                        	<li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>salesManager/stock/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Modify Price</small></a>
                                            </li>
                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        
                                        <!--end of stock table-->
                                        
                                    </div>
                                    <div class="tab-pane fade" id="pillProfile">
                                            <?php if($count!='0'): ?>
                                        <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a><?php */?>
                                    	</div>
                                        
                                    <hr />
                                    </div>
                                    <?php endif;?>
                                     <?php if($count=='0'): ?>
                                        <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="<?php echo get_phrase('print'); ?>"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a><?php */?>
                                    	</div>
                                        
                                    <hr />
                                    </div>
                                    <?php endif;?>
                   
                                        <div class="table-responsive">
                                         <div id="printer">
                                    <table class="table table-hover table-bordered  table-green" id="low-stock">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th><?php echo get_phrase('item'); ?></th>
                                                <th><?php echo get_phrase('available'); ?></th>
                                                <th><?php echo get_phrase('damaged'); ?></th>
                                                <th><?php echo get_phrase('buying_price'); ?></th>
                                                <th><?php echo get_phrase('selling_price'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											
											$where="deleted='0' AND available<='10'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($where);
											$this->db->order_by('name','asc');
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $sprice= $row['s_price'];
								$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                			<?php if($avail<=10){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                            
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $avail; ?></center></td>
                                                <td><center><?php echo $damage; ?></center></td>
                                                <td><center><?php echo $bprice; ?></center></td>
                                                <td><center><?php echo $sprice; ?></center></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        
                                        <!--end of stock table-->
                                        
                                    </div>
                                     <div class="tab-pane fade" id="damaged">
                                            <?php if($countd!='0'): ?>
                                        <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a><?php */?>
                                    	</div>
                                        
                                    <hr />
                                    </div>
                                    <?php endif;?>
                                    <?php if($countd=='0'): ?>
                                        <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDiv('printer')" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                         <?php /*?><a href="<?php echo base_url().'salesManager/downloads/stock/pdf' ?>" target="_blank" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="pdf"><i class="fa fa-download"></i>
                                                    </a><?php */?>
                                    	</div>
                                        
                                    <hr />
                                    </div>
                                    <?php endif;?>
                                                                                
                                        <div class="table-responsive">
                                         <div id="printer">
                                    <table class="table table-hover table-bordered  table-green" id="damaged-stock">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th><?php echo get_phrase('item'); ?></th>
                                                <th><?php echo get_phrase('available'); ?></th>
                                                <th><?php echo get_phrase('damaged'); ?></th>
                                                <th><?php echo get_phrase('buying_price'); ?></th>
                                                <th><?php echo get_phrase('selling_price'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											
											$wher="deleted='0' AND damaged>'0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($wher);
											$this->db->order_by('name','asc');
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $sprice= $row['s_price'];
								$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity']
								
								?>
                                			<?php if($avail<=10){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                                	
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $avail; ?></center></td>
                                                <td><center><?php echo $damage; ?></center></td>
                                                <td><center><?php echo $bprice; ?></center></td>
                                                <td><center><?php echo $sprice; ?></center></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                    </div>
                                     <div class="tab-pane fade" id="sold">
                                     	<?php
											if($count_sold=='0'){
											?>
                                         <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDivs('printers')" class="btn btn-white disabled" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                    	</div>
                                        <hr />
                                    </div>
                                    
                                    <?php }else{?>
                                    	<div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" target="_blank" onclick="printDivs('printers')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> <?php echo get_phrase('print_report'); ?>
                                                    </a>
                                    	</div>
                                        <hr />
                                    </div>
                                    <?php }?>
                                        
                                        <div class="table-responsive">
                                         <div id="printers">
                                    <table class="table table-hover table-bordered  table-green" id="sold-stock">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th><?php echo get_phrase('item'); ?></th>
                                                <th><?php echo get_phrase('sales_no'); ?></th>
                                                <th><?php echo get_phrase('quantity'); ?></th>
                                                <th><?php echo get_phrase('price'); ?></th>
                                                <th><?php echo get_phrase('total_price'); ?></th>
                                                <th><?php echo get_phrase('sales_date'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
											$where="deleted_status='0'";
											$this->db->select('*');
											$this->db->from('order_item');
											$this->db->where($where);
											//$this->db->order_by('name','asc');
											$this->db->join('stock', 'stock.stock_id = order_item.stock_id');
											$this->db->join('orders', 'orders.order_id = order_item.order_id');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$this->db->join('category', 'category.category_id = stock.category');
											$desc	=	$this->db->get()->result_array();
											$i='1';
								
                                foreach($desc as $row):?>
													
								<?php $id=$row['stock_id']; ?>
								<?php $cname= $row['c_name'];?>
								<?php $avail= $row['available'];?>
								<?php $damage= $row['damaged'];?>
                                <?php $sprice= $row['s_price'];
								$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $unit=$row['unit'];
									  $quat=$row['quantity'];
									  $orderdate=$row['order_date'];
									  $quantity_ordered=$row['quantity_ordered'];
									  $price=$row['price'];
									  $total=$row['total'];
									  $order_no=$row['order_no'];
								
								?>
                                			<?php if($avail<=0){ echo '<tr style="background-color:#d9edf7;">';}else{ echo '<tr>';}?>                                
                                                <td><?php echo $i++; ?>.</td>
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('stock',$id);?>" alt="" width="40px" height="40px">
                                                </td>
                                                <td>
                                                	<p class="text-blue"><?php echo $sname.'&nbsp;('.$quat.'&nbsp;'.$unit.')'; ?></p>
                                                	<p><i><?php echo $cname; ?></i></p>
                                                </td>
                                                <td><center><?php echo $order_no; ?></center></td>
                                                <td><center><?php echo $quantity_ordered; ?></center></td>
                                                <td><center><?php echo formatMoney($price,true); ?></center></td>
                                                <td><center><?php echo formatMoney($total,true); ?></center></td>
                                                <td><?php echo date('d'.'/'.'M'.'/'.'Y',$orderdate); ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
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

                                         <script type="text/javascript">
		function printDivs(printers){
			var printContents=document.getElementById(printers).innerHTML;
			var originalContents=document.body.innerHTML;
			document.body.innerHTML=printContents;
			window.print() ;
			document.body.innerHTML=printContents;
		}
	
	</script>