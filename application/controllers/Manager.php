<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

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
        if ($this->session->userdata('inventory_login') != 1)
            redirect(base_url(), 'refresh');
        if ($this->session->userdata('inventory_login') == 1)
            redirect(base_url() . 'manager/dashboard', 'refresh');
    }
	
		//for session check
	function check_session(){
        if ($this->session->userdata('inventory_login') != 1)
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
        $page_data['page_title'] = 'inventory manager dashboard';
        $this->load->view('index', $page_data);
    }
	
	function security_question($p1='',$p2=''){
		if($p1=='security'){
		$this->check_session();
        $page_data['page_name']  = 'Security';
        $page_data['page_title'] = 'Security Question';
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
				redirect ('manager/security_question/'.('security').'','refresh');
			}
		}
		else{
			$this->error404();
		}
	}
	
	
		/*** category***/
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
			redirect ('manager/category/'.('view').'','refresh');
				}
		
		}
		elseif($p1=='edit'){
			$data['cat_id']=$this->db->get_where('category', array('category_id' => $p2));
			$this->load->view('backend/inventory manager/modal_edit_category.php',$data);
		}
		elseif($p1=='update_category'){
			$this->crud->category('update',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Category was Updated Successfully.');
			redirect ('manager/category/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$data=array(
				'deleted_cat'=>'1'
			);
			$this->db->where('category_id',$p2);
			$this->db->update('category',$data);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Category was Deleted Successfully.');
			redirect ('manager/category/'.('view').'','refresh');
		}
		elseif($p1=='add_modal'){
			$this->load->view('backend/manager/modal_add_cat.php');
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
												<a href="'.base_url().'manager/stock/view"><button class="btn btn-green"><i class="fa fa-plus-circle"></i> Add Stock ?</button></a>
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
			redirect ('manager/descriptions/'.('view').'','refresh');
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
			$this->load->view('backend/inventory manager/modal_edit_desc.php',$data);
		}
		elseif($p1=='update'){
			$this->crud->descriptions('update',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Description Was Updated Successfully');
			redirect ('manager/descriptions/'.('view').'','refresh');
		}
		elseif($p1=='delete'){
			$this->db->where('description_id', $p2);
            $this->db->delete('descriptions');
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Description was deleted successfully!');
			redirect ('manager/descriptions/'.('view').'','refresh');
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
			$this->load->view('backend/inventory manager/modal_edit_stock.php',$data);
		}
		elseif($p1=='update'){
			$this->crud->stock('update',$p2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Stock Was Updated Successfully');
			redirect ('manager/stock/'.('view').'','refresh');			
		}
		elseif($p1=='damage'){
			$data['damage']=$this->db->get_where('stock',array('stock_id'=>$p2));
			$this->load->view('backend/inventory manager/modal_edit_damage.php',$data);
		}
		elseif($p1=='update_damage'){
			if($this->crud->stock('update_damage',$p2)){
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Stock Was Updated Successfully');
			redirect ('manager/stock/'.('view').'','refresh');
			}
			else{
			$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> Failed !!!</h4> The quantity value of damaged stock exceeds the available stock.');
			redirect ('manager/stock/'.('view').'','refresh');
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
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> Stock was deleted successfully!');
			redirect ('manager/stock/'.('view').'','refresh');
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
			$this->load->view('backend/inventory manager/modal_edit_sales.php',$data);
		}
		elseif($p1=='sales_update'){
			$this->crud->orders('update_sales',$p2);
			 $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4>'.get_phrase('payment_success_message').'!');
			redirect ('manager/outstandings/'.('sales').'','refresh');
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
	
	
	
	//downloads
	function downloads($p1='',$p2=''){
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
	}
	
	
	
	//manage events
	function events($param1='',$param2=''){
		$this->check_session();
		if($param1=='view'){
        $page_data['page_name']  = 'Events';
        $page_data['page_title'] = 'My Events';
        $this->load->view('index', $page_data);
		}
		
		if($param1=='add_event'){
			$param3='manager';
			$this->crud->event('add',$param3);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Added successfully');
			redirect ('manager/events/'.('view').'','refresh');
		}
		if($param1=='edit'){
			$data['event_id']=$this->db->get_where('events', array('id' => $param2));
		$this->load->view('backend/inventory manager/modal_edit_event.php',$data);
		}
		if($param1=='update_event'){
			$this->crud->event('update',$param2);		
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> Success !!!</h4> Event Updated successfully');
			redirect ('manager/events/'.('view').'','refresh');
		}
		if($param1=='delete'){
			$this->db->where('id', $param2);
            $this->db->delete('events');
            $this->session->set_flashdata('flash_message' ,'<h4><i class="fa fa-check"></i> Success !!!</h4> Event was deleted successfully!');
			redirect ('manager/events/'.('view').'','refresh');
		}
	}
	
	
			/***user reports***/
    function reports($p1='',$p2='')
    {
		$this->check_session();
		if($p1=='view'){
        $page_data['page_name']  = 'Reports';
        $page_data['page_title'] = 'Manage Reports';
        $this->load->view('index', $page_data);
		}
		
		elseif($p1=='sales_reports'){
        $page_data['page_name']  = 'Sales Reports';
        $page_data['page_title'] = 'Sales Reports';
        $this->load->view('index', $page_data);
		}
		elseif($p1=='purchases_reports'){
        $page_data['page_name']  = 'Purchases Reports';
        $page_data['page_title'] = 'Purchases Reports';
        $this->load->view('index', $page_data);
		}
		elseif($p1=='events_reports'){
        $page_data['page_name']  = 'Events Reports';
        $page_data['page_title'] = 'Events Reports';
        $this->load->view('index', $page_data);
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
			$this->crud->validate('manager');
			if($this->form_validation->run()==FALSE){
			
		$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-warning"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('input_fields_error').'');
			$this->profile('view','refresh');			 
		}else{
			$this->crud->manager_update($param2);
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('profile_update_message').'');
			redirect ('manager/profile/'.('view').'','refresh');
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
				redirect ('manager/profile/'.('view').'','refresh');
				}else{
					$this->session->set_flashdata('error_message' , '<h4><i class="fa fa-exclamation-circle"></i> '.get_phrase('error').' !!!</h4> '.get_phrase('password_mismatch_message').'');
					redirect ('manager/profile/'.('view').'','refresh');
				}
			}
		}
		elseif($param1=='update_image'){						
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $param2 . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<h4><i class="fa fa-check"></i> '.get_phrase('success').' !!!</h4> '.get_phrase('picture_update').'');
			redirect ('manager/profile/'.('view').'','refresh');
		}
		else{
			$this->error404();
			}
	}
	

//close class	
}