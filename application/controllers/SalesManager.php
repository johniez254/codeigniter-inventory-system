<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesManager extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Crud_model','crud');
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		
		 $this->load->library('session');
	}
	
	 public function index()
    {
        if ($this->session->userdata('sales_login') != 1)
            redirect(base_url(), 'refresh');
        if ($this->session->userdata('sales_login') == 1)
            redirect(base_url() . 'salesManager/dashboard', 'refresh');
    }
	
		//for session check
	function check_session(){
        if ($this->session->userdata('sales_login') != 1)
            redirect(base_url(), 'refresh');
	}
	
	/**function 404 error**/
	function error404(){
		$this->check_session();
        $page_data['page_name']  = '404 Error';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('404');
        $page_data['page_title'] = get_phrase('404');
        $this->load->view('index', $page_data);
	}
	
	
	/***manager DASHBOARD***/
    function dashboard()
    {
		$this->check_session();
        $page_data['page_name']  = 'Dashboard';
        $page_data['page_title'] = 'Sales manager dashboard';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('dashboard');
        $this->load->view('index', $page_data);
    }
	
	/**FUNCTION OF SUPPLIERS**/
	function suppliers($p1='',$p2=''){
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Suppliers';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('suppliers');
        $page_data['page_title'] = get_phrase('suppliers');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='add_supplier'){
			$this->crud->validate('supplier');
			if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'.');
			$this->suppliers('view','refresh');
			}
			else{
				$this->crud->supplier('add');
				$user_id=$this->session->userdata('login_user_id');
				$this->crud->history('added','supplier',$user_id);
				$this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('supplier_added_message').'!');
			redirect ('salesManager/suppliers/'.('view').'','refresh');
			}
		}
		elseif($p1=='edit'){
			$data['sup_id']=$this->db->get_where('supplier', array('supplier_id' => $p2));
			$this->load->view('backend/sales manager/modal_edit_supplier.php',$data);
			
		}
		elseif($p1=='update_supplier'){
			$this->crud->supplier('update',$p2);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','supplier',$user_id,$p2);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('supplier_updated_message').'!');
			redirect ('salesManager/suppliers/'.('view').'','refresh');
		}
		elseif($p1=='update_image'){
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $p2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('picture_update').'');
			redirect ('salesManager/suppliers/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$data=array(
				'deleted_supplier'=>'1',
			);
			$this->db->where('supplier_id',$p2);
			$this->db->update('supplier',$data);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('deleted','supplier',$user_id,$p2);
			$this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> Success !!!</h4> Supplier Was Deleted successfully!');
			redirect ('salesManager/suppliers/'.('view').'','refresh');
		}
		elseif($p1=='view_details'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['sid']=$this->db->get_where('supplier', array('supplier_id'=>$encrypt));
        	$page_data['page_name']  = 'View Supplier';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'suppliers/view';	
		$page_data['page_crumb']  = get_phrase('suppliers');
			$page_data['page_name_phrase']  = get_phrase('view_supplier');
        	$page_data['page_title'] = get_phrase('view_supplier');
        	$this->load->view('index', $page_data);
		}
		else{
			$this->error404();
			}
	}
	
	
	/*** sales***/
    function purchases($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Purchases';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('purchases');
        $page_data['page_title'] = get_phrase('purchases');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='view_purchases'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['pid']=$this->db->get_where('purchases', array('purchase_id'=>$encrypt));
        	$page_data['page_name']  = 'View Purchases';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'purchases/view';	
			$page_data['page_crumb']  = get_phrase('purchases');
			$page_data['page_name_phrase']  = get_phrase('view_purchases');
        	$page_data['page_title'] = get_phrase('view_purchases');
        	$this->load->view('index', $page_data);
		}
		elseif($p1=='get_desc'){
			$desc = $this->db->get_where('descriptions' , array('d_name' => $p2))->result_array();
        	foreach ($desc as $row) {
            echo '<option value="' . $row['description_id'] . '">' . $row['quantity'] .'&nbsp;' . $row['unit'] .'</option>';
			}
		}
		elseif($p1=='add_stock'){
			//$this->crud->stock('add');
			//$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Added Successfully');
			//redirect ('saleManager/stock/'.('view').'','refresh');
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->crud->stock('add')){
				$valid['success'] = true;
				$valid['messages'] = "Stock Was Successfully Added.";
				echo json_encode($valid);
			}
			else{
				$valid['messages'] = "Not Added";
			}
		}
		else{
			$this->error404();
			}
	}
	
	/***saales manager sales***/
    function sales($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Sales';
        $page_data['page_title'] = 'Manage Sales';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('sales');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='payment'){
			$data['oid']=$this->db->get_where('orders', array('order_id' => $p2));
			$this->load->view('backend/sales manager/modal_edit_sales.php',$data);
		}
		elseif($p1=='sales_update'){
			$this->crud->orders('update_sales',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> Success !!!</h4> Sales Outstandings were updated successfully!');
			redirect ('salesManager/outstandings/'.('sales').'','refresh');
		}elseif($p1=='view_sales'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['id']=$this->db->get_where('orders', array('order_id'=>$encrypt));
        	$page_data['page_name']  = 'View Sales';
        	$page_data['page_title'] = 'View Sales';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'sales/view';	
			$page_data['page_crumb']  = get_phrase('sales');
			$page_data['page_name_phrase']  = get_phrase('view_sales');
        	$this->load->view('index', $page_data);
		}
    }
	
	/**Purchse Outstandings**/
	function outstandings($p1='',$p2='',$p3=''){
		$this->check_session();
		if($p1=='purchases'){
		$page_data['page_name']  = 'Purchase outstandings';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('purchases_outstandings');
        $page_data['page_title'] = get_phrase('purchases_outstandings');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='sales'){
		$page_data['page_name']  = 'Sales outstandings';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('sales_outstandings');
        $page_data['page_title'] = get_phrase('sales_outstandings');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='view_purchases'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['pid']=$this->db->get_where('purchases', array('purchase_id'=>$encrypt));
        	$page_data['page_name']  = 'View Purchases Outstandings';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'outstandings/purchases';	
			$page_data['page_crumb']  = get_phrase('purchases_outstandings');
			$page_data['page_name_phrase']  = get_phrase('view_purchases_outstandings');
        	$page_data['page_title'] = get_phrase('view_purchases_outstandings');
        	$this->load->view('index', $page_data);
		}
		elseif($p1=='view_sales'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['oid']=$this->db->get_where('Orders', array('order_id'=>$encrypt));
        	$page_data['page_name']  = 'View Sales Outstandings';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'outstandings/sales';	
			$page_data['page_crumb']  = get_phrase('sales_outstandings');
			$page_data['page_name_phrase']  = get_phrase('view_sales_outstandings');
        	$page_data['page_title'] = get_phrase('view_sales_outstandings');
        	$this->load->view('index', $page_data);
		}
		else{
			$this->error404();
		}
	}
	
	
	/***stock***/
    function stock($p1='',$p2=''){
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Stock';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('stock');
        $page_data['page_title'] = get_phrase('stock');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='view_stock'){
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['stock_id']=$this->db->get_where('stock', array('stock_id'=>$encrypt));
        	$page_data['page_name']  = 'View Stock';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = get_phrase('stock');
			$page_data['function']  = 'stock/view';
			$page_data['page_name_phrase']  = get_phrase('view_stock');
        	$page_data['page_title'] = get_phrase('view_stock');
        	$this->load->view('index', $page_data);
			}
		elseif($p1=='edit'){
			$data['stock']=$this->db->get_where('stock',array('stock_id'=>$p2));
			$this->load->view('backend/sales manager/modal_edit_stock.php',$data);
		}
		elseif($p1=='pricing'){
			$this->crud->stock('pricing',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Changes were Updated Successfully');
			redirect ('salesManager/stock/'.('view').'','refresh');			
		}
		
		elseif($p1=='purchase_update'){
			$this->crud->stock('update_pay',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('payment_success_message').'!');
			redirect ('salesManager/outstandings/'.('purchases').'','refresh');
		}
		
		elseif($p1=='sales_update'){
			$this->crud->orders('update_sales',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4>'.get_phrase('payment_success_message').'!');
			redirect ('salesManager/outstandings/'.('sales').'','refresh');
		}
		
		elseif($p1=='payment'){
			$data['p_id']=$this->db->get_where('purchases', array('purchase_id' => $p2));
			$this->load->view('backend/sales manager/modal_edit_payments.php',$data);
		}
		elseif($p1=='stock_report'){
		$page_data['crumb']  = '2';	
        $page_data['page_name']  = 'Stock Reports';
		$page_data['page_crumb']  = get_phrase('reports');
		$page_data['function']  = 'reports/view';
		$page_data['page_name_phrase']  = get_phrase('stock_reports');
        $page_data['page_title'] = get_phrase('stock_reports');
        $this->load->view('index', $page_data);
		}
		else{
			$this->error404();
			}
		
    }
	
	
		/***user oders***/
	function orders($p1='',$p2=''){
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Orders';
        $page_data['page_title'] = 'Manage Orders';
        $this->load->view('index', $page_data);
		}
		if($p1=='get_stock'){
			$op="deleted='0'";
			$this->db->select('*');
			$this->db->from('stock');
			$this->db->where($op);
			$this->db->order_by('name','asc');
			$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
			$data=$this->db->get()->result_array();
			echo json_encode($data);
			
		}
		if($p1=='print'){
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
			$orderId = $_POST['orderId'];
			$op="order_id=".$orderId."";
			$this->db->select('*');
			$this->db->from('orders');
			$this->db->where($op);
			$desc	=	$this->db->get()->result_array();
			foreach($desc as $row):
				$order_id=$row['order_id'];
				$order_no=$row['order_no'];
				$order_date=$row['order_date'];
				$c_name=$row['customer_name'];
				$c_phone=$row['phone'];
				$order_status=$row['order_status'];
				$sub_amount=$row['sub_total'];
				$total_amount=$row['total_amount'];
				$discount=$row['discount'];
				$grand_total=$row['grand_total'];
				$vat=$row['vat'];
				$paid_amount=$row['paid'];
				$due_amt=$row['due'];
				$payment_type=$row['payment_type'];
				$payment_status=$row['payment_status'];
				endforeach;
				
				$setting_id=$this->db->get_where('settings', array('id' => 1));
				foreach($setting_id->result() as $row):
				$s_id=$row->id;
				$sname=$row->systemname;
				$st=$row->systemtitle;
				$s_address=$row->address;
				$em=$row->email;
				$s_phone=$row->phone;
				//$cur=$row->currency;
				endforeach;
				
				$table = '
 <table border="0" cellspacing="0" cellpadding="1" width="100%">
 <tr>
 <tr><th colspan="2"><center><h3><i class="fa fa-gears"></i> '.$st.'</h3></center></th></tr>
 				<td></td>
				<td style="text-align:right;"><b>Address</b> '.$s_address.'</td>
				</tr>
				<tr>
				<td></td>
				<td style="text-align:right;">
				<b>Phone :</b> '.$s_phone.'
				</td>
				</tr>
				<tr>
				<td></td>
				<td style="text-align:right;">
				<b>Email : </b>'.$em.'
				</td>
				</tr>	
				
		</tr>
		<tr>
				<td><b>Sales No :</b> '.$order_no.'</td><td></td>
				</tr>
		<tr>
				<td><b>Sales Date :</b> '.date('d'.'/'.'M'.'/'.'Y',$order_date).'</td><td></td>
				</tr>
				<tr><td>
				<b>Customer Name :</b> '.$c_name.'
				</td><td></td>
				</tr>
				<tr><td>
				<b>Phone :</b> 0'.$c_phone.'
				</td><td></td>	
		</tr>
		<tr><td colspan=2><hr></td></tr>
</table>
<table border="0" width="100%;" cellpadding="5" style="">

	<tbody>
		<tr>
			<th colspan="5"><h3 style="border-bottom:3px solid double;">Items Sold</h3></th>
		</tr>
		<tr>
			<td><b>S.no</b></td>
			<td><b>Product</b></td>
			<td><b>Price</b></td>
			<td><b>Quantity</b></td>
			<td><b>Total</b></td>
		</tr>';

			$op="order_id=".$orderId."";
			$this->db->select('*');
			$this->db->from('order_item');
			$this->db->where($op);
			$this->db->join('stock','stock.stock_id=order_item.stock_id');
			$this->db->join('descriptions','descriptions.description_id=stock.description_id');
			$desc	=	$this->db->get()->result_array();
			$x=1;
			foreach($desc as $row):			
						
			$table .= '<tr>
				<td>'.$x.'</th>
				<td>'.$row['name'].'&nbsp;('.$row['quantity'].$row['unit'].')'.'</td>
				<td>'.formatMoney($row['price'],true).'</td>
				<td>'.$row['quantity_ordered'].'</td>
				<td>'.formatMoney($row['total'],true).'</td>
			</tr>
			';
		$x++;
		endforeach; // /while

		$table .= '<tr>
			<th colspan="5"><hr></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Sub Amount</b></td>
			<td style="text-align:right;">'.formatMoney($sub_amount,true).'</td>			
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>VAT (10%)</b></td>
			<td style="text-align:right;">'.formatMoney($vat,true).'</td>			
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Total Amount</b></td>
			<td style="text-align:right;">'.formatMoney($total_amount,true).'</td>			
		</tr>	

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Discount</b></td>
			<td style="text-align:right;">'.formatMoney($discount,true).'</td>			
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Grand Total</b></td>
			<td style="text-align:right;">'.formatMoney($grand_total,true).'</td>			
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Paid Amount</b></td>
			<td style="text-align:right;">'.formatMoney($paid_amount,true).'</td>			
		</tr>

		<tr>
		<td></td>
		<td></td>
		<td></td>
			<td style="text-align:left;"><b>Due Amount</b></td>
			<td style="text-align:right;">'.formatMoney($due_amt,true).'</td>			
		</tr>
	</tbody>
</table>
 ';
	echo $table;			
		}
		if($p1=='getproductdata'){
			$stockid = $this->input->post('stockid');
			$this->db->where('stock_id', $stockid);
			$query=$this->db->get('stock');
				if($query->num_rows()>0){
					$row = $query->row();
				}
			echo json_encode($row);
		}
		if($p1=='add_order'){
			$valid['success'] = array('success' => false, 'messages' => array(),'order_id'=>'');
			//$add=$this->crud->orders('add_order');
			//if($add){
				
				$data=array(
			'order_date'=>strtotime($this->input->post('orderdate')),
			'customer_name'=>$this->input->post('names'),
			'phone'=>$this->input->post('phone'),
			'sub_total'=>$this->input->post('subTotalValue'),
			'vat'=>$this->input->post('vatValue'),
			'total_amount'=>$this->input->post('ttavalue'),
			'discount'=>$this->input->post('discount'),
			'grand_total'=>$this->input->post('grandTotalValue'),
			'paid'=>$this->input->post('paid'),
			'due'=>$this->input->post('dueValue'),
			'payment_type'=>$this->input->post('ptype'),
			'payment_status'=>$this->input->post('pstatus'),
			'order_no'=>$this->input->post('order_no'),
			'om_date'=>date('M'),
			);
			$this->db->insert('orders',$data);
			//get last id
			$last_insert = $this->db->insert_id();
			//continue
			$product=$this->input->post('product');
			$quantity=$this->input->post('quantity');
			$price=$this->input->post('priceValue');
			$totalValue=$this->input->post('totalValue');
			for($i=0; $i<count($product); $i++) {
					
			$op="stock_id=".$product[$i]."";
			$this->db->select('available');
			$this->db->from('stock');
			$this->db->where($op);
			$p	=	$this->db->get()->result_array();
			foreach($p as $row):
			$selected=$row['available'];
			$updateQuantity[$i]=$selected-$quantity[$i];
			$dat=array();
			$dat[$i] = array(
						'stock_id'=>$product[$i],
           				'available' => $updateQuantity[$i], 
						);			
			$this->db->update_batch('stock',$dat,'stock_id');
			endforeach;
			
			$da =array();
					$da[$i] = array(
           				'order_id' => $last_insert, 
           				'stock_id' => $product[$i],
           				'quantity_ordered'=>$quantity[$i],
						'price'=>$price[$i],
						'total'=>$totalValue[$i],
						'order_item_status'=>'0',
           			);		   
			$insert=$this->db->insert_batch('order_item', $da);
			}
				
				//end code
				
				$valid['success'] = true;
				$valid['messages'] = "Order Was Successfully Added.";
				$valid['order_id'] = $last_insert;
				echo json_encode($valid);
			
		}
		if($p1=='view_order'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['order_id']=$this->db->get_where('orders', array('order_id'=>$encrypt));
        	$page_data['page_name']  = 'View Order';
        	$page_data['page_title'] = 'View Order';
        	$this->load->view('index', $page_data);
		}
		if($p1=='edit_order'){
			$valid['success'] = array('success' => false, 'messages' => array(),);
			if($this->crud->orders('edit_order',$p2)){
				$valid['success'] = true;
				$valid['messages'] = "Order Was Updated Successfully.";
				echo json_encode($valid);
			}
			else{
				$valid['messages'] = "Not Added";
			}
		}
	}
	
	/**append purchase row function***/
	public function getAppendBulkPurchaseRow($countId = null){
		
		if($countId) {
			$classData = $this->crud->fetchCategoryData();
			$descData = $this->crud->fetchDescData();
			
			$row = '
			<tr id="row'.$countId.'">
                <td>
                	<input type="button" value="'.$countId.'" disabled="true" class="form-control" />                  
                </td>
                <td>
                		<input type="text" name="name[]" autocomplete="off" id="name'.$countId.'" class="form-control" placeholder="Stock Name" />
                </td>
                <td>
						<select name="category[]" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Category"   id="category'.$countId.'" >
						<option value="">Select Category</option>';
						 foreach ($classData as $key => $value) { 
	                      $row .= '<option value="'.$value["category_id"].'">'.$value['c_name'].'</option>';
	                    } 
	                  	$row .= '</select>                
                </td>
				<td>
					<select name="desc[]" class="form-control" id="desc'.$countId.'" onchange="return get_description(this.value, id='.$countId.')" >
					<option value="">~~Description~~</option>';
					 foreach($descData as $key => $val){ 
						 $row .= '<option value="'.$val["d_name"].'">'.$val['d_name'].'</option>';
					 }  
	                  	$row .= '</select>
				</td>
				<td>
					<select name="measurements[]" class="form-control" id="measurements'.$countId.'" >
					<option value="">Select Description first</option>
                    </select>
				</td>
				<td>
					<input type="number" name="qt[]" onkeyup="getTotalPrice('.$countId.')"  id="qt'.$countId.'" autocomplete="off" class="form-control" min="1" placeholder="e.g 1,2,3..." />
				</td>
				<td>
					<input type="number" name="b_price[]" id="b_price'.$countId.'" autocomplete="off" class="form-control" min="1" placeholder="Buying price" onkeyup="getTotalPrice('.$countId.')" />
				</td>
				<td>
					<input type="number" name="s_price[]" id="s_price'.$countId.'" autocomplete="off" class="form-control" min="1" placeholder="Selling price" />
                    <input type="hidden" name="ptotal[]" readonly id="ptotal'.$countId.'" class="form-control">
                    <input type="hidden" name="ptotalValue[]" id="ptotalValue'.$countId.'" autocomplete="off" class="form-control" />
				</td>
                <td>
                  <button class="btn btn-red  removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow('.$countId.')"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
                </td>
              </tr>
			';
			echo $row;
		}
	}
	
	function security_question($p1='',$p2=''){
		if($p1=='security'){
		$this->check_session();
        $page_data['page_name']  = 'Security';
        $page_data['page_title'] = 'Security Question';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('security_question');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='add'){
			$this->crud->validate('question');
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> Error !!!</h4> You have some errors in the input fields');
		$this->security_question('security','refresh');
			}
			else{
				$this->crud->security('add',$p2);
				$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Security Was Added Successfully.');
				redirect ('salesManager/security_question/'.('security').'','refresh');
			}
		}
		else{
			$this->error404();
		}
	}
	

//manage events
	function events($param1='',$param2=''){
		$this->check_session();
		if($param1=='view'){
        $page_data['page_name']  = 'Events';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('events');
        $page_data['page_title'] = 'My Events';
        $this->load->view('index', $page_data);
		}
		
		if($param1=='add_event'){
			$param3='salesManager';
			$this->crud->event('add',$param3);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Added successfully');
			redirect ('salesManager/events/'.('view').'','refresh');
		}
		if($param1=='edit'){
			$data['event_id']=$this->db->get_where('events', array('id' => $param2));
		$this->load->view('backend/sales manager/modal_edit_event.php',$data);
		}
		if($param1=='update_event'){
			$this->crud->event('update',$param2);		
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Updated successfully');
			redirect ('salesManager/events/'.('view').'','refresh');
		}
		if($param1=='delete'){
			$this->db->where('id', $param2);
            $this->db->delete('events');
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> Success !!!</h4> Event was deleted successfully!');
			redirect ('salesManager/events/'.('view').'','refresh');
		}
	}
	
	
		/***ADMIN reports***/
    function reports($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
		$page_data['crumb']  = '1';
        $page_data['page_name']  = 'Reports';
		$page_data['page_name_phrase']  = get_phrase('reports');
        $page_data['page_title'] = get_phrase('reports');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='category_reports'){
		$page_data['crumb']  = '2';
		$page_data['function']  = 'reports/view';	
		$page_data['page_crumb']  = get_phrase('reports');
        $page_data['page_name']  = 'Category Reports';
		$page_data['page_name_phrase']  = get_phrase('category_reports');
        $page_data['page_title'] = get_phrase('category_reports');
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='purchases_reports'){
		$page_data['crumb']  = '2';
		$page_data['function']  = 'reports/view';	
		$page_data['page_crumb']  = get_phrase('reports');
        $page_data['page_name']  = 'Purchases Reports';
		$page_data['page_name_phrase']  = get_phrase('purchases_reports');
        $page_data['page_title'] = get_phrase('purchases_reports');
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='sales_reports'){
		$page_data['crumb']  = '2';	
		$page_data['page_crumb']  = get_phrase('reports');
		$page_data['function']  = 'reports/view';
        $page_data['page_name']  = 'Sales Reports';
		$page_data['page_name_phrase']  = get_phrase('sales_reports');
        $page_data['page_title'] = get_phrase('sales_reports');
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='sales_outstanding_reports'){
		$page_data['crumb']  = '2';
		$page_data['function']  = 'reports/view';	
		$page_data['page_crumb']  = get_phrase('reports');
        $page_data['page_name']  = 'Sales Outstanding Reports';
		$page_data['page_name_phrase']  = get_phrase('sales_outstanding_reports');
        $page_data['page_title'] = get_phrase('sales_outstanding_reports');
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='purchases_outstanding_reports'){
		$page_data['crumb']  = '2';
		$page_data['function']  = 'reports/view';	
		$page_data['page_crumb']  = get_phrase('reports');
        $page_data['page_name']  = 'Purchases Outstanding Reports';
		$page_data['page_name_phrase']  = get_phrase('purchases_outstanding_reports');
        $page_data['page_title'] = get_phrase('purchases_outstanding_reports');
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='events_reports'){
		$page_data['crumb']  = '2';
		$page_data['function']  = 'reports/view';	
		$page_data['page_crumb']  = get_phrase('reports');
        $page_data['page_name']  = 'Events Reports';
		$page_data['page_name_phrase']  = get_phrase('events_reports');
        $page_data['page_title'] = get_phrase('events_reports');
        $this->load->view('index', $page_data);
		}
		
		else{
			$this->error404();
			}
    }
	
		/***profile***/
	function profile($param1='',$param2=''){
		$this->check_session();
		if($param1=='view'){
        $page_data['page_name']  = 'Profile';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('my_profile');
        $page_data['page_title'] = get_phrase('profile');
        $this->load->view('index', $page_data);
		}
		
		elseif($param1=='update'){
			$this->crud->validate('salesManager');
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->profile('view','refresh');			 
		}else{
			$this->crud->manager_update($param2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('profile_update_message').'');
			redirect ('salesManager/profile/'.('view').'','refresh');
			}
		}
		
		elseif($param1=='pass'){
			$this->crud->validate('passwords');				
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->profile('view','refresh');			 
		}else{
			if($this->crud->can_change_password($param2)){
				$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('password_change_message').'');
				redirect ('salesManager/profile/'.('view').'','refresh');
				}else{
					$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-exclamation-circle"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('password_mismatch_message').'');
					redirect ('salesManager/profile/'.('view').'','refresh');
				}
			}
		}
		elseif($param1=='update_image'){						
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $param2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('picture_update').'');
			redirect ('salesManager/profile/'.('view').'','refresh');
		}
		else{
			$this->error404();
			}
	}
	

//downloads
	function downloads($p1='',$p2=''){
		if($p1=='suppliers'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/suppliers/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/suppliers/excel', 'refresh');
			}
		}
		if($p1=='descriptions'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/descriptions/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/descriptions/excel', 'refresh');
			}
		}
		if($p1=='stock'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/stock/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/stock/excel', 'refresh');
			}
		}
		if($p1=='sales'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/sales/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/sales/excel', 'refresh');
			}
		}
		if($p1=='purchase_outstandings'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/purchase_outstandings/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/purchase_outstandings/excel', 'refresh');
			}
		}
		if($p1=='sales_outstandings'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/sales_outstandings/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/sales_outstandings/excel', 'refresh');
			}
		}
	}
		


//end of class bracket	
}