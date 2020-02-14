<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	
	//for session check
	function check_session(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
	}
	
	/***ADMIN DASHBOARD***/
    function dashboard()
    {
		$this->check_session();
        $page_data['page_name']  = 'Dashboard';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('dashboard');
        $page_data['page_title'] = get_phrase('admin dashboard');
        $this->load->view('index', $page_data);
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
	/***ADMIN DASHBOARD***/
    function logs($p1='',$p2='')
    {	
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Logs';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('logs');
        $page_data['page_title'] = get_phrase('logs');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='delete'){
			$data=$this->input->post('selected');
			if($data!=null){
			for($s=0; $s<count($data); $s++) {
			$dut=array();
			$dut[$s] = array(
						'history_id'=>$data[$s],
           				'deleted_history'=>1,   
						);			
			$this->db->update_batch('history_logs',$dut,'history_id');
			}
			$this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> History was deleted successfully!');
			redirect ('admin/logs/'.('view').'','refresh');
			}
			else{
			$this->session->set_flashdata('error_message' ,'<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> No History was selected!');
			redirect ('admin/logs/'.('view').'','refresh');
			}
		}
		else{
			$this->error404();
		}
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
			redirect ('admin/suppliers/'.('view').'','refresh');
			}
		}
		elseif($p1=='edit'){
			$data['sup_id']=$this->db->get_where('supplier', array('supplier_id' => $p2));
			$this->load->view('backend/admin/modal_edit_supplier.php',$data);
			
		}
		elseif($p1=='update_supplier'){
			$this->crud->supplier('update',$p2);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','supplier',$user_id,$p2);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('supplier_updated_message').'!');
			redirect ('admin/suppliers/'.('view').'','refresh');
		}
		elseif($p1=='update_image'){
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $p2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('picture_update').'');
			redirect ('admin/suppliers/'.('view').'','refresh');
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
			redirect ('admin/suppliers/'.('view').'','refresh');
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
	
	/***ADMIN category***/
    function category($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Category';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('category');
        $page_data['page_title'] = get_phrase('manage_category');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='add'){
		$this->form_validation->set_rules('category','Category','required|trim|is_unique[category.c_name]',
		array(
		'required'=>'Category name is required',
		//'alpha'=>'Category name should contain letters only.',
		'is_unique'=>'This category already exists.',
		));
			if($this->form_validation->run()==FALSE){		
			echo validation_errors();
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> Error !!!</h4> You have some errors in the input fields');
			$this->category('view','refresh');
			}else{
				$data=array(
					'c_name'=>$this->input->post('category'),
					'status'=>$this->input->post('status'),
				);
				$this->db->insert('category',$data);		
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Category was Added successfully.');
			redirect ('admin/category/'.('view').'','refresh');
				}
		
		}
		elseif($p1=='edit'){
			$data['cat_id']=$this->db->get_where('category', array('category_id' => $p2));
			$this->load->view('backend/admin/modal_edit_category.php',$data);
		}
		elseif($p1=='update_category'){
			$this->crud->category('update',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Category was Updated Successfully.');
			redirect ('admin/category/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$data=array(
				'deleted_cat'=>'1'
			);
			$this->db->where('category_id',$p2);
			$this->db->update('category',$data);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Category was Deleted Successfully.');
			redirect ('admin/category/'.('view').'','refresh');
		}
		elseif($p1=='add_modal'){
			$this->load->view('backend/admin/modal_add_cat.php');
		}
		elseif($p1=='ajax_validate'){
			$this->form_validation->set_rules('name','Category','required|trim|is_unique[category.c_name]',
		array(
		'required'=>'Category name is required',
		'is_unique'=>'This category already exists.',
		));
			if($this->form_validation->run()==FALSE){		
			echo validation_errors();
			}else{
				$this->crud->add_cat();
				echo'success';
			}
		}
		elseif($p1=="select_category"){
			$this->db->select('*');
			$this->db->from('category');
			$this->db->distinct('descriptions.d_name');
			$this->db->order_by('c_name','asc');
			$this->db->join('descriptions', 'descriptions.description_id = category.category_id');
			$data=$this->db->get()->result_array();
			echo json_encode($data);
		}
		elseif($p1=='get_category'){
			$e = $this->db->get_where('category' , array('category_id' => $p2))->result_array();
        foreach ($e as $row) {
            $c_name=$row['c_name'];
			$c_id=$row['category_id'];
        	}
			//$c_url='admin/category/'.$c_id.'';
				//load exchage classes
				 echo'
                                                    <div class="portlet portlet-green">
                                                        <div class="portlet-heading">
                                                            <div class="portlet-title">
                                                                <h4>Category &raquo; '.$c_name.'</h4>
                                                            </div>
                                                            <div class="portlet-widgets">
                                                                <span class="divider"></span>
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#orangePortlet"><i class="fa fa-chevron-down"></i></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div id="orangePortlet" class="panel-collapse collapse in">
                                                            <div class="portlet-body">
																 <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Products</th>
                                                <th>Available</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
											$ocp="category='$c_id' AND deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($ocp);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$count	=	$this->db->count_all_results();
											
											
											if($count!='0'){
												
												//$fetch=array('deleted'=>0, 'AND'=>'AND','category'=>$c_id);
											//$oc="deleted='0' AND category=".$c_id."";
											$oc="category='$c_id' AND deleted='0'";
											$this->db->select('*');
											$this->db->from('stock');
											$this->db->where($oc);
											$this->db->join('category', 'category.category_id = stock.category');
											$this->db->join('descriptions', 'descriptions.description_id = stock.description_id');
											$cat	=	$this->db->get()->result_array();
											foreach($cat as $row):
											$n= $row['name'];
											$avail= $row['available'];
											$price= $row['s_price'];
											$stock_id= $row['stock_id'];
											$du= $row['unit'];
											$q= $row['quantity'];
										echo '
                                            <tr>
												<td><img class="img-circle" src="'.$this->crud->get_image_url('stock',$stock_id).'" alt="" width="40px" height="40px"></td>
                                                <td>'.$n.'&nbsp;('.$q.' '.$du.')</td>
                                                <td>'.$avail.'</td>
                                                <td>'.$price.'</td>
                                            </tr>';
											endforeach;
											}else{
												echo'<tr><td colspan="4"><center>No Stock available in <b>'.$c_name.'</b> Category.<br><br>
												<a href="'.base_url().'admin/stock/view"><button class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Stock ?</button></a>
												</center></td></tr>';
											}
											echo '
                                        </tbody>
                                    </table>
                                </div>
															</div>
                                                        </div>
                                                        
                                                    </div>';
			}
			
		else{
			$this->error404();
			}
    }
	
	/***ADMIN descriptions***/
    function descriptions($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Descriptions';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('descriptions');
        $page_data['page_title'] = get_phrase('manage_descriptions');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='add'){
			$this->crud->validate('descriptions');
			if($this->form_validation->run()==FALSE){			
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> Error !!!</h4> You have some errors in the input fields');
			$this->descriptions('view','refresh');
			}else{
			$this->crud->descriptions('add');
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Description Was Added Successfully');
			redirect ('admin/descriptions/'.('view').'','refresh');
				}
		}
		elseif($p1=='get_desc'){
			$desc = $this->db->get_where('descriptions' , array('d_name' => $p2))->result_array();
        	foreach ($desc as $row) {
            echo '<option value="' . $row['description_id'] . '">' . $row['quantity'] .'&nbsp;' . $row['unit'] .'</option>';
			}
		}
		elseif($p1=='edit'){
			$data['desc_id']=$this->db->get_where('descriptions', array('description_id' => $p2));
			$this->load->view('backend/admin/modal_edit_desc.php',$data);
		}
		elseif($p1=='update'){
			$this->crud->descriptions('update',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Description Was Updated Successfully');
			redirect ('admin/descriptions/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$this->db->where('description_id', $p2);
            $this->db->delete('descriptions');
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Description was deleted successfully!');
			redirect ('admin/descriptions/'.('view').'','refresh');
		}
		
		else{
			$this->error404();
			}
    }
	
	/***ADMIN stock***/
    function stock($p1='',$p2=''){
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Stock';
		$page_data['crumb']  = '1';	
		$page_data['page_name_phrase']  = get_phrase('stock');
        $page_data['page_title'] = get_phrase('manage_stock');
        $this->load->view('index', $page_data);
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
		elseif($p1=='updatearraystock'){
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->crud->stock('upstockarray')){
				$valid['success'] = true;
				$valid['messages'] = "Stock Was Updated Successfully.";
				echo json_encode($valid);
			}
			else{
			}
		}
		elseif($p1=='add_stock'){
			//$this->crud->stock('add');
			//$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Added Successfully');
			//redirect ('admin/stock/'.('view').'','refresh');
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
		elseif($p1=='edit'){
			$data['stock']=$this->db->get_where('stock',array('stock_id'=>$p2));
			$this->load->view('backend/admin/modal_edit_stock.php',$data);
		}
		elseif($p1=='update'){
			$this->crud->stock('update',$p2);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','stock',$user_id,$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Stock Was Updated Successfully');
			redirect ('admin/stock/'.('view').'','refresh');			
		}
		elseif($p1=='damage'){
			$data['damage']=$this->db->get_where('stock',array('stock_id'=>$p2));
			$this->load->view('backend/admin/modal_edit_damage.php',$data);
		}
		elseif($p1=='update_damage'){
			$dam=trim($this->input->post('damage'));
			if($this->crud->stock('update_damage',$p2)){
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','damage',$user_id,$p2,$dam);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Updated Successfully');
			redirect ('admin/stock/'.('view').'','refresh');
			}
			else{
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> Failed !!!</h4> The quantity value of damaged stock exceeds the available stock.');
			redirect ('admin/stock/'.('view').'','refresh');
			}
		}
		elseif($p1=='view_stock'){
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['stock_id']=$this->db->get_where('stock', array('stock_id'=>$encrypt));
        	$page_data['page_name']  = 'View Stock';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = get_phrase('manage_stock');
			$page_data['function']  = 'stock/view';
			$page_data['page_name_phrase']  = get_phrase('view_stock');
        	$page_data['page_title'] = get_phrase('view_stock');
        	$this->load->view('index', $page_data);
			}
		elseif($p1=='delete'){
			$flag=1;
			$data=array(
				'deleted'=>$flag,
			);
			$this->db->where('stock_id', $p2);
            $this->db->update('stock',$data);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('deleted','stock',$user_id);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Stock was deleted successfully!');
			redirect ('admin/stock/'.('view').'','refresh');
		}
		elseif($p1=='payment'){
			$data['p_id']=$this->db->get_where('purchases', array('purchase_id' => $p2));
			$this->load->view('backend/admin/modal_edit_payments.php',$data);
		}
		elseif($p1=='purchase_update'){
			$this->crud->stock('update_pay',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('payment_success_message').'!');
			redirect ('admin/outstandings/'.('purchases').'','refresh');
		}
		
		else{
			$this->error404();
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
	
	
	/***ADMIN sales***/
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
		else{
			$this->error404();
			}
	}
	
	
	/***ADMIN sales***/
    function sales($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Sales';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('sales');
        $page_data['page_title'] = get_phrase('sales');
        $this->load->view('index', $page_data);
		}
		elseif($p1=='payment'){
			$data['oid']=$this->db->get_where('orders', array('order_id' => $p2));
			$this->load->view('backend/admin/modal_edit_sales.php',$data);
		}
		elseif($p1=='sales_update'){
			$this->crud->orders('update_sales',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4>'.get_phrase('payment_success_message').'!');
			redirect ('admin/outstandings/'.('sales').'','refresh');
		}
		elseif($p1=='view_sales'){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$page_data['id']=$this->db->get_where('orders', array('order_id'=>$encrypt));
        	$page_data['page_name']  = 'View Sales';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'sales/view';	
			$page_data['page_crumb']  = get_phrase('sales');
			$page_data['page_name_phrase']  = get_phrase('view_sales');
        	$page_data['page_title'] = get_phrase('view_sales');
        	$this->load->view('index', $page_data);
		}
		else{
			$this->error404();
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
	
	/***ADMIN users***/
    function users($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Users';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('users');
        $page_data['page_title'] = get_phrase('users');
        $this->load->view('index', $page_data);
		}		
		elseif($p1=='edit'){
		$data['user_id']=$this->db->get_where('profiles', array('id' => $p2));
		$this->load->view('backend/admin/modal_edit_user.php',$data);
		}
		elseif($p1=='add_user'){
			$this->crud->validate('user');
			if($this->form_validation->run()==FALSE){			
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->users('view','refresh');
			}else{
			$this->crud->user('add');
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('added','user',$user_id);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('user_added_message').'');
			redirect ('admin/users/'.('view').'','refresh');
			}
		}
		elseif($p1=='update_user'){
			$this->crud->user('update',$p2);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','user',$user_id,$p2);		
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('user_updated_message').'');
			redirect ('admin/users/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$this->db->where('id', $p2);
            $this->db->delete('profiles');
			$this->db->where('user_id', $p2);
            $this->db->delete('login');
			
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('deleted','user',$user_id);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('user_deleted_message').'');
			redirect ('admin/users/'.('view').'','refresh');
		}
		
		elseif($p1=='activate'){
			$data=array(
				'login_status'=>'active'
			);
			$this->db->where('user_id', $p2);
            $this->db->update('login',$data);
			
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','activated',$user_id,$p2);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Account was Activated Successfully');
			redirect ('admin/users/'.('view').'','refresh');
		}
		elseif($p1=='disable'){
			$data=array(
				'login_status'=>'disabled'
			);
			$this->db->where('user_id', $p2);
            $this->db->update('login',$data);
			
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','deactivated',$user_id,$p2);
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Account was Disabled Successfully');
			redirect ('admin/users/'.('view').'','refresh');
		}
		elseif($p1=='edit_image'){
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $p2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('update_user_image').'');
			redirect ('admin/users/'.('view').'','refresh');
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
        $page_data['page_title'] = get_phrase('manage_events');
        $this->load->view('index', $page_data);
		}
		
		elseif($param1=='add_event'){
			$param3='admin';
			$this->crud->event('add',$param3);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Added successfully');
			redirect ('admin/events/'.('view').'','refresh');
		}
		elseif($param1=='edit'){
			$data['event_id']=$this->db->get_where('events', array('id' => $param2));
		$this->load->view('backend/admin/modal_edit_event.php',$data);
		}
		elseif($param1=='update_event'){
			$this->crud->event('update',$param2);		
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Was Updated successfully');
			redirect ('admin/events/'.('view').'','refresh');
		}
		elseif($param1=='delete'){
			$this->db->where('id', $param2);
            $this->db->delete('events');
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> Success !!!</h4> Event was deleted successfully!');
			redirect ('admin/events/'.('view').'','refresh');
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
			$this->crud->validate('admin');
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->profile('view','refresh');			 
		}else{
			$this->crud->admin_update($param2);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','profile',$user_id);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('profile_update_message').'');
			redirect ('admin/profile/'.('view').'','refresh');
			}
		}
		
		elseif($param1=='pass'){
			$this->crud->validate('passwords');				
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->profile('view','refresh');			 
		}else{
			if($this->crud->can_change_password($param2)){	
				$user_id=$this->session->userdata('login_user_id');
				$this->crud->history('updated','password',$user_id);
				$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('password_change_message').'');
				redirect ('admin/profile/'.('view').'','refresh');
				}else{
					$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-exclamation-circle"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('password_mismatch_message').'');
					redirect ('admin/profile/'.('view').'','refresh');
				}
			}
		}
		elseif($param1=='update_image'){						
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $param2 . '.jpg');	
			 $user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','image',$user_id);		 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('picture_update').'');
			redirect ('admin/profile/'.('view').'','refresh');
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
		if($p1=='users'){
			if($p2=='pdf'){
				redirect(base_url() . 'downloads/users/pdf', 'refresh');
			}
			if($p2=='excel'){
				redirect(base_url() . 'downloads/users/excel', 'refresh');
			}
		}
	}
	
	//settings			
	function settings($param1='',$param2=''){
		$this->check_session();
		if($param1=='view'){
        $page_data['page_name']  = 'Settings';
		$page_data['crumb']  = '1';
		$page_data['page_name_phrase']  = get_phrase('settings');
        $page_data['page_title'] = get_phrase('system_settings');
        $this->load->view('index', $page_data);
	}
		elseif($param1=='update'){
			$this->crud->validate('settings');
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->settings('view','refresh');			 
		}
			else{
				$this->crud->settings_update($param2);
				$user_id=$this->session->userdata('login_user_id');
				$this->crud->history('updated','settings',$user_id);
				$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('settings_update_message').'');
				redirect ('admin/settings/'.('view').'','refresh');
			}
		}
		
		elseif ($param1 == 'create') {
			$this->crud->create_backup($param2);
		}
		elseif ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('added','phrases',$user_id);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('phrase_added').'');
			redirect ('admin/settings/'.('view').'','refresh');
		}
		elseif ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('added','language',$user_id);
			
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('language_added_message').'');
				redirect ('admin/settings/'.('view').'','refresh');
		}
		elseif ($param1 == 'update_phrase'){
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			
			$user_id=$this->session->userdata('login_user_id');
			$this->crud->history('updated','language',$user_id,$param2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('language_success_message').'');
				redirect ('admin/settings/'.('manage_language'.'/'.$param2).'','refresh');
		}
		
		elseif($param1=='restore'){
			$this->crud->restore_backup();
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Restore Made Successfully');
				redirect ('admin/settings/'.('view').'','refresh');
		}
		elseif($param1=='manage_language'){
        	$page_data['page_name']  = 'Manage Language';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'settings/view';	
			$page_data['page_crumb']  = get_phrase('settings');
			$page_data['page_name_phrase']  = get_phrase('manage_language');
        	$page_data['page_title'] = get_phrase('manage_language');
			$page_data['lang']=$param2;
        	$this->load->view('index', $page_data);
		}
		elseif($param1=='language_settings'){
        	$page_data['page_name']  = 'Language Settings';
			$page_data['crumb']  = '2';
			$page_data['function']  = 'settings/view';	
			$page_data['page_crumb']  = get_phrase('settings');
			$page_data['page_name_phrase']  = get_phrase('language_settings');
        	$page_data['page_title'] = get_phrase('language_settings');
			//$page_data['lang']=$param2;
        	$this->load->view('index', $page_data);
		}
		else{
			$this->error404();
			}
	}

//end of class bracket	
}