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
				
				
if($pdf_name=='supplier'){
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Monthly Report \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Registered Suppliers</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="10px">#</th>
                                                <th>Supplier Number</th>
                                                <th width="90px">Supplier Name</th>
                                                <th>Phone</th>
                                                <th width="110px">Email</th>
                                                <th>Address</th>
                                                <th>Datereg</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
											$sid=$row['supplier_id'];
											$sn=$row['supplier_number'];
											$sname=$row['supplier_name'];
											$p=$row['supplier_phone'];
											$add=$row['supplier_address'];
											$semail=$row['supplier_email'];
											$sdate=$row['date_added']; 
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="10px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1"><?php echo $sn; ?></td>
                                                <td width="90px" class="td1"><?php echo $sname; ?></td>
                                                
                                                <td class="td1">0<?php echo $p; ?></td>
                                                <td class="td1" width="110px"><?php echo $semail; ?></td>
                                                <td class="td1"><?php echo $add; ?></td>
                                                <td class="td1"><?php echo date('d'.'/'.'M'.'/'.'Y',$sdate) ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('suppliers.pdf', 'I');
}

//start descriptions
if($pdf_name=='descriptions'){
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Description Report \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Stock Descriptions</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th width="180px">Description Name</th>
                                                <th width="180px">Description Unit</th>
                                                <th>Description Measurement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($des as $row):?>
													
								<?php
											$dname=$row['d_name'];
											$un=$row['unit'];
											$q=$row['quantity'];
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td width="180px" class="td1"><?php echo $dname ?></td>
                                                <td width="180px" class="td1"><?php echo $un; ?></td>
                                                
                                                <td class="td1"><?php echo $q; ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('descriptions.pdf', 'I');
}

//stock
if($pdf_name=='stock'){
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Stock Reports \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff; text-align:center;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.td1n{  border-bottom:1px solid #EDEAFD; text-align:right;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Stock Available</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th width="90px">Available Stock</th>
                                                <th>Damaged Stock</th>
                                                <th width="110px">Buying Price(Ksh)</th>
                                                <th>Selling Price(Ksh)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
										$sid=$row['stock_id'];
										$avail= $row['available'];
										$damage= $row['damaged'];
                                		$price= $row['s_price'];
										$bprice= $row['b_price'];
									  $sname=$row['name'];
									  $d_id=$row['description_id']; 
									  $c_id=$row['category'];
			$d_quat       =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->quantity;
			$d_unit       =	$this->db->get_where('descriptions' , array('description_id'=>$d_id))->row()->unit;
			$c_cat       =	$this->db->get_where('category' , array('category_id'=>$c_id))->row()->c_name;
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1"><?php echo $sname; ?> (<?php echo $d_quat; ?> <?php echo $d_unit; ?>)</td>
                                                <td class="td1"><?php echo $c_cat; ?></td>
                                                <td width="90px" class="td1n"><?php echo $avail; ?></td>
                                                
                                                <td class="td1n"><?php echo $damage; ?></td>
                                                <td class="td1n" width="110px"><?php echo formatMoney($bprice,true); ?></td>
                                                <td class="td1n"><?php echo formatMoney($price,true); ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('stock.pdf', 'I');
}
if($pdf_name=='sales'){
		tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Sales Reports \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff; text-align:center;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.td1n{  border-bottom:1px solid #EDEAFD; text-align:right;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Sales Report</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th>Order Number</th>
                                                <th width="90px">Customer Name</th>
                                                <th>Contact</th>
                                                <th>Sales Date</th>
                                                <th width="100px">Items Sold</th>
                                                <th>Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
										$cname=$row['customer_name'];
										$order_id=$row['order_id'];
									  $phone=$row['phone'];
									  $on=$row['order_no'];
									  $order_date=$row['order_date'];
									  $pstatus=$row['payment_status'];
									  $o_status=$row['order_status'];
									  
									  if($pstatus=='1'){$ppstatus='Full Payment';}
									  if($pstatus=='2'){$ppstatus='Advance Payment';}
									  if($pstatus=='3'){$ppstatus='No Payment';}
									  
									  		$oc="order_id=".$order_id."";
											$this->db->select('*');
											$this->db->from('order_item');
											$this->db->where($oc);
											$count	=	$this->db->count_all_results();
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1"><?php echo $on; ?></td>
                                                <td class="td1" width="90px"><?php echo $cname; ?></td>
                                                <td class="td1">0<?php echo $phone; ?></td>
                                                
                                                <td class="td1"><?php echo date('d'.'/'.'M'.'/'.'Y',$order_date); ?></td>
                                                <td class="td1n" width="100px"><?php echo $count; ?></td>
                                                <td class="td1"><?php echo $ppstatus; ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('stock.pdf', 'I');
}
if($pdf_name=='purchase_outstandings'){
		tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Purchase Outstanding Reports \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff; text-align:center;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.td1n{  border-bottom:1px solid #EDEAFD; text-align:right;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Purchase Outstanding Reports</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th>Supplier Name</th>
                                                <th width="90px">Purchases Number</th>
                                                <th>Purchases Date</th>
                                                <th>Total Amount</th>
                                                <th width="100px">Total Paid</th>
                                                <th>Remaining Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
											$id=$row['supplier_id'];
											$pid=$row['purchase_id'];
											$pno=$row['purchase_no'];
											$pdate=$row['purchase_date'];
											$sname=$row['supplier_name'];
											$tta=$row['grand_total'];
											$ttp=$row['paid'];
											$due=$row['due'];
									  $sup_name       =	$this->db->get_where('supplier' , array('supplier_id'=>$id))->row()->supplier_name;
									  		
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1"><?php echo $sup_name; ?></td>
                                                <td class="td1" width="90px"><?php echo $pno; ?></td>
                                                <td class="td1"><?php echo date('d'.'/'.'M'.'/'.'Y',$pdate); ?></td>
                                                
                                                <td class="td1n"><?php echo formatMoney($tta,true); ?></td>
                                                <td class="td1n" width="100px"><?php echo formatMoney($ttp,true); ?></td>
                                                <td class="td1n"><?php echo formatMoney($due,true); ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('sales_outstandings.pdf', 'I');
}
if($pdf_name=='sales_outstandings'){
	tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Sales Outstanding Reports \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff; text-align:center;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.td1n{  border-bottom:1px solid #EDEAFD; text-align:right;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Purchase Outstanding Reports</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th>Customer Name</th>
                                                <th width="90px">Sales Number</th>
                                                <th>Sales Date</th>
                                                <th>Items Ordered</th>
                                                <th>Total Amount</th>
                                                <th width="100px">Total Paid</th>
                                                <th>Remaining Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
											$id=$row['order_id'];
											$name=$row['customer_name'];
											$pno=$row['order_no'];
											$pdate=$row['order_date'];
											$sname=$row['order_id'];
											$tta=$row['grand_total'];
											$ttp=$row['paid'];
											$due=$row['due'];
								
											$where="due>='1'";
											$this->db->select('*');
											$this->db->from('orders');
											$this->db->where($where);
											$this->db->order_by('order_date','asc');
											//$this->db->join('stock', 'stock.purchase_id = purchases.purchase_id');
											//$this->db->join('supplier', 'supplier.supplier_id = purchases.supplier_id');
											$count	=	$this->db->count_all_results();	  //$sup_name       =	$this->db->get_where('supplier' , array('supplier_id'=>$id))->row()->supplier_name;
									  		
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1"><?php echo $name; ?></td>
                                                <td class="td1" width="90px"><?php echo $pno; ?></td>
                                                <td class="td1"><?php echo date('d'.'/'.'M'.'/'.'Y',$pdate); ?></td>
                                                <td class="td1n"><?php echo $count; ?></td>
                                                <td class="td1n"><?php echo formatMoney($tta,true); ?></td>
                                                <td class="td1n" width="100px"><?php echo formatMoney($ttp,true); ?></td>
                                                <td class="td1n"><?php echo formatMoney($due,true); ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('sales_outstandings.pdf', 'I');
}
if($pdf_name=='users'){
		tcpdf();
	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$obj_pdf->SetCreator(PDF_CREATOR);
	$title = "Johniez Inventory";
	$obj_pdf->SetTitle($title);	
	$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, 100, $title, "Registered Users \nDate: ".date('d'.'/'.'M'.'/'.'Y')."");
	$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$obj_pdf->SetFont('helvetica','', 9);
	$obj_pdf->setFontSubsetting(false);
	$obj_pdf->AddPage();
	ob_start();
?>
<style>
.h11{ text-align:center; color:#34495e;}
.ptr{	font-weight:bold; background-color:#16a085; color:#fff;	border:1px solid #fff; text-align:center;	}
.ptr1{ padding:5px; background-color:#fff;}
.td1{  border-bottom:1px solid #EDEAFD;  border-left:1px solid #EDEAFD;}
.td1n{  border-bottom:1px solid #EDEAFD; text-align:right;  border-left:1px solid #EDEAFD;}
.ptr2{background-color:#F0F0FF;}
</style>
		<h1 class="h11"><u>Registered Users</u></h1>
		 <table style="background-color:#CCC; width:100%; border:1px solid #EDEAFD;" cellpadding="70%">
                                        <thead>
                                            <tr class="ptr">
                                            	<th width="20px">#</th>
                                                <th width="100px">Full names</th>
                                                <th>Username</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>IDNO</th>
                                                <th>Date Registered</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
								$i=1;
                                foreach($sup as $row):?>
													
								<?php
									$id=$row['id'];
								$fn= $row['fullnames'];
								$un= $row['username'];
								$p= $row['phone'];
								$ad= $row['address'];
								$idno= $row['idno'];
								$d= $row['datereg'];
								$role= $row['role'];
									  		
								?>
								
								
               
								
                                            <?php
											$odd++;
											 if($odd%2!=0){
												 echo '<tr class="ptr2">'
												  ?>
                                            <?php }else
												echo '<tr class="ptr1">';
												
											?>
                                            	<td width="20px" class="td1"><?php echo $i++; ?></td>
                                                <td class="td1" width="100px"><?php echo $fn; ?></td>
                                                <td class="td1"><?php echo $un; ?></td>
                                                <td class="td1"><?php echo $p; ?></td>
                                                <td class="td1"><?php echo $ad; ?></td>
                                                <td class="td1"><?php echo $idno; ?></td>
                                                <td class="td1"><?php echo date('d'.'/'.'M'.'/'.'Y',$d); ?></td>
                                                <td class="td1"><?php echo $role; ?></td>                                           
                                    
                                            </tr>
                                  
                        <?php endforeach;?>
                                            
                                        </tbody>
                                    </table>
                                    
<?php
		$content = ob_get_contents();
	ob_end_clean();
	$obj_pdf->writeHTML($content, true, false, true, false, '');
	$obj_pdf->Output('Users.pdf', 'I');
}
?>