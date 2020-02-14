<?php
class Crud_model extends CI_model{	
	public function checkLogin($username){
		$this->db->where('username',$this->input->post('username'));
		$query=$this->db->get('login');
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
	}	
	//trylogin
	public function can_do_login(){
		$username=$this->input->post('username');
		if($this->checkLogin($username)){
		$query=$this->db->get_where('login', array('username' => $username))->result_array();
		foreach($query as $row):
			$fetched_pass=$row['password'];
		endforeach;
		if(password_verify($this->input->post('password'),$fetched_pass)){
			return true;
		}
		else{
			return false;
			}
		}else{
			return false;
		}
	}
	public function change_login_credentials(){
		$username=$this->input->post('username');
		$password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
		$data=array(
			'password'=>$password,
		);
		$this->db->where('username',$username);
		$this->db->update('login',$data);
	}
	
	//validations
	function validate($p1=''){
		if($p1=='descriptions'){
			$this->form_validation->set_rules('name[]','','required|trim|alpha',
		array(
		'required'=>'Descripion name is required!',
		'alpha'=>'Descripion name should contain letters only',
		));
		
		$this->form_validation->set_rules('unit[]','','required|trim|alpha',
		array(
		'required'=>'Unit name is required!',
		'alpha'=>'Unit name should contain letters only',
		));
		
		$this->form_validation->set_rules('quantity[]','','required|trim',
		array(
		'required'=>'Quantity value is required!',
		));
		}
		
		if($p1=='user'){
			$this->form_validation->set_rules('name','Name','required|trim',
		array(
		'required'=>get_phrase('fullnames_error')
		));
		
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[profiles.username]',
		array(
		'required'=>get_phrase('username_error'),
		'is_unique'=>get_phrase('username_exist_error')
		));
		
		$this->form_validation->set_rules('phone','','required|trim|numeric|min_length[9]|max_length[9]',
		array(
		'required'=>get_phrase('phone_require_message'),
		'numeric'=>get_phrase('phone_digits_message'),
		'min_length'=>get_phrase('phone_digits_length'),
		'max_length'=>'Phone number should contain a maximum of <b>9</b> digits',
		));
		
		$this->form_validation->set_rules('idno','','required|trim|numeric',
		array(
		'required'=>get_phrase('idno_error'),
		'numeric'=>'idno Should contain numbers only.',
		));
		
		$this->form_validation->set_rules('address','','required|trim',
		array(
		'required'=>get_phrase('address_error_message'),
		));
		}
		if($p1=='manager'){
			$this->form_validation->set_rules('name','Name','required|trim',
		array(
		'required'=>get_phrase('fullnames_error')
		));
		
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[profiles.username]',
		array(
		'required'=>get_phrase('username_error'),
		'is_unique'=>get_phrase('username_exist_error')
		));
		
		$this->form_validation->set_rules('phone','','required|trim|numeric|min_length[9]|max_length[9]',
		array(
		'required'=>get_phrase('phone_require_message'),
		'numeric'=>get_phrase('phone_digits_message'),
		'min_length'=>get_phrase('phone_digits_length'),
		));
		
		$this->form_validation->set_rules('idno','','required|trim|numeric',
		array(
		'required'=>get_phrase('idno_error'),
		'numeric'=>'idno Should contain numbers only.',
		));
		
		$this->form_validation->set_rules('address','','required|trim',
		array(
		'required'=>get_phrase('address_error_message'),
		));
		}
		if($p1=='salesManager'){
			$this->form_validation->set_rules('name','Name','required|trim',
		array(
		'required'=>get_phrase('fullnames_error')
		));
		
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[profiles.username]',
		array(
		'required'=>get_phrase('username_error'),
		'is_unique'=>get_phrase('username_exist_error')
		));
		
		$this->form_validation->set_rules('phone','','required|trim|numeric|min_length[9]|max_length[9]',
		array(
		'required'=>get_phrase('phone_require_message'),
		'numeric'=>get_phrase('phone_digits_message'),
		'min_length'=>get_phrase('phone_digits_length'),
		));
		
		$this->form_validation->set_rules('idno','','required|trim|numeric',
		array(
		'required'=>get_phrase('idno_error'),
		'numeric'=>'idno Should contain numbers only.',
		));
		
		$this->form_validation->set_rules('address','','required|trim',
		array(
		'required'=>get_phrase('address_error_message'),
		));
		}
		if($p1=='admin'){
			$this->form_validation->set_rules('name','Name','required|trim',
		array(
		'required'=>get_phrase('fullnames_error')
		));
		
		$this->form_validation->set_rules('username','Username','required|trim',
		array(
		'required'=>get_phrase('username_error'),
		));
		}
		if($p1=='passwords'){
				$this->form_validation->set_rules('oldpass','old password','required|trim',
		array(
		'required'=>get_phrase('current_password_error'),
		));
		
		$this->form_validation->set_rules('newpass','new password','required|trim',
		array(
		'required'=>get_phrase('new_password_error'),
		//'is_unique'=>'This password matches your current password. Input another Password that is unique.',
		));
		
		$this->form_validation->set_rules('confpass','new password','required|trim|matches[newpass]',
		array(
		'required'=>get_phrase('confirm_password_error'),
		'matches'=>get_phrase('password_mismatch_error'),
		));
		}
		if($p1=='settings'){
				$this->form_validation->set_rules('sname','System Name','required|trim',
		array(
		'required'=>'System Name is required'
		));
		
		$this->form_validation->set_rules('st','System Name','required|trim',
		array(
		'required'=>'System Title is required'
		));
		}
		if($p1=='stock'){
			$this->form_validation->set_rules('name','Stock Name','required|trim',
			array(
			'required'=>'Stock Name is required'
			));
		}
		if($p1=='supplier'){
		
		$this->form_validation->set_rules('sname','Supplier Name','required|trim',
		array(
		'required'=>get_phrase('supplier_name_error'),
		//'is_unique'=>'The username above has already been taken. Please select another username',
		));
		
		$this->form_validation->set_rules('phone','','required|trim|numeric|min_length[9]|max_length[9]',
		array(
		'required'=>get_phrase('phone_require_message'),
		'numeric'=>get_phrase('phone_digits_message'),
		'min_length'=>get_phrase('phone_digits_length'),
		'max_length'=>'Phone Number should contain a maximum of <b>9</b> digits!',
		));
		
		$this->form_validation->set_rules('email','','required|trim|valid_email',
		array(
		'required'=>get_phrase('supplier_email_error'),
		'valid_email'=>get_phrase('supplier_invalid_email_error'),
		));
		
		$this->form_validation->set_rules('address','','required|trim',
		array(
		'required'=>get_phrase('address_error_message'),
		));
		}
		if($p1=='question'){
			$this->form_validation->set_rules('quiz','question','required|trim',
			array(
			'required'=>'Please Input Your Security Question.'
			));
			$this->form_validation->set_rules('pass1','answer','required|trim',
			array(
			'required'=>'Input Your Answer.'
			));
			$this->form_validation->set_rules('pass2','Confirm answer','required|trim|matches[pass1]',
			array(
			'required'=>'Confirm Your Answer.',
			'matches'=>'This answer does not match the answer given above',
			));
		}
	}
	
	//skip security page after login for the first time.
	public function skip_question($param2){
		$data=array(
			'question'=>'2',
			);
			
			$this->db->where('username',$param2);
			$this->db->update('login',$data);
	}
	
	
	 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
		if($type=='admin' or $type=='user' or $type=='supplier' or $type=='manager' or $type=='sales'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/temp.jpg';

        return $image_url;
		}
		elseif($type=='stock'){
			if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/stock.jpg';

        return $image_url;
		}
    }
	
	public function settings_update($param2){
		$data=array(
			'systemname'=>$this->input->post('sname'),
			'systemtitle'=>$this->input->post('st'),
			'address'=>$this->input->post('address'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'language'=>$this->input->post('lang'),
			);
			
			$this->db->where('id',$param2);
			$this->db->update('settings',$data);
	}
	
	public function admin_update($param2){
		$data=array(
			'names'=>$this->input->post('name'),
			'username'=>$this->input->post('username'),
			);
			
			$this->db->where('id',$param2);
			$this->db->update('login',$data);
	}
	
	public function user_update($param2){
		$data=array(
			'fullnames'=>$this->input->post('name'),
			'username'=>$this->input->post('username'),
			'address'=>$this->input->post('address'),
			'phone'=>$this->input->post('phone'),
			);
			
		$dat=array(
			'names'=>$this->input->post('name'),
			'username'=>$this->input->post('username'),
		);	
				
			$this->db->where('id',$param2);
			$this->db->update('profiles',$data);
			
			$this->db->where('user_id',$param2);
			$this->db->update('login',$dat);
	}
	
		public function manager_update($param2){
		$data=array(
			'fullnames'=>$this->input->post('name'),
			'username'=>$this->input->post('username'),
			'address'=>$this->input->post('address'),
			'phone'=>$this->input->post('phone'),
			);
			
		$dat=array(
			'names'=>$this->input->post('name'),
			'username'=>$this->input->post('username'),
		);	
				
			$this->db->where('id',$param2);
			$this->db->update('profiles',$data);
			
			$this->db->where('user_id',$param2);
			$this->db->update('login',$dat);
	}
	
	public function can_change_password($param2){
		
		$oldpass=$this->input->post('oldpass');
		$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);
		$username=$this->input->post('username');
		
		$query=$this->db->get_where('login', array('username' => $username))->result_array();
		foreach($query as $row):
			$fetched_pass=$row['password'];
		endforeach;
		if(password_verify($oldpass,$fetched_pass)){
		$this->db->where('username', $username);
		$this->db->where('password', $fetched_pass);
		$query=$this->db->get('login');
		
		if($query->num_rows()==1){			
			$data=array(
			'password'=>$newpass,
			);
			$this->db->where('id',$param2);
			$this->db->update('login',$data);
			return true;
		}
		else{
			return false;
			}
		}else{
			return false;
			}
	}
	
	//manage supplier
	function supplier($p1='',$p2=''){
		if($p1=='add'){
			$data=array(
				'supplier_number'=>$this->input->post('s'),
				'supplier_name'=>$this->input->post('sname'),
				'supplier_phone'=>$this->input->post('phone'),
				'supplier_address'=>$this->input->post('address'),
				'supplier_email'=>$this->input->post('email'),
				'date_added'=>strtotime($this->input->post('d')),
				);
				
			$this->db->insert('supplier',$data);
			$supplier_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/supplier_image/' . $supplier_id . '.jpg');
		}
		if($p1=='update'){
			$data=array(
				'supplier_name'=>$this->input->post('sname'),
				'supplier_phone'=>$this->input->post('phone'),
				'supplier_address'=>$this->input->post('address'),
				'supplier_email'=>$this->input->post('email'),
				);
				$this->db->where('supplier_id',$p2);
				$this->db->update('supplier',$data);
		}
	}
	//manage users
	function user($p1='',$p2=''){
		if($p1=='add'){
			$data=array(
				'fullnames'=>$this->input->post('name'),
				'username'=>$this->input->post('username'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'idno'=>$this->input->post('idno'),
				'role'=>$this->input->post('role'),
				'datereg'=>strtotime($this->input->post('d')),
				//'datereg'=>date("Y-m-d H:i:s"),
				
			);
			//$this->db->set('datereg','NOW()',FALSE);
			$this->db->insert('profiles',$data);
			$user_id = $this->db->insert_id();	
			$dat=array(
				'names'=>$this->input->post('name'),
				'username'=>$this->input->post('username'),
				'role'=>$this->input->post('role'),
				'login_status'=>'active',			
				//'password'=>md5($this->input->post('idno')),
				'password'=>password_hash($this->input->post('idno'),PASSWORD_DEFAULT),
				'user_id'=>$user_id,
				'question'=>'1',
			);
			$this->db->insert('login',$dat);
			$log_id = $this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $log_id . '.jpg');
		}
		if($p1=='update'){
			$data=array(
				'fullnames'=>$this->input->post('names'),
				'username'=>$this->input->post('username'),
				'phone'=>$this->input->post('phone'),
				'address'=>$this->input->post('address'),
				'idno'=>$this->input->post('idno'),
				'role'=>$this->input->post('role'),
			);
			$dat=array(
				'names'=>$this->input->post('names'),
				'username'=>$this->input->post('username'),
				'role'=>$this->input->post('role'),
		);
			$this->db->where('id',$p2);
			$this->db->update('profiles',$data);
			
			$this->db->where('user_id',$p2);
			$this->db->update('login',$dat);
		}
	}
	//manage category
	function category($p1='',$p2=''){
		if($p1=='update'){
			$data=array(
				'c_name'=>$this->input->post('c_name'),
				'status'=>$this->input->post('status'),
			);
			$this->db->where('category_id',$p2);
			$this->db->update('category',$data);
		}
	}
	
	//manage stock
	function stock($p1='',$p2=''){
		if($p1=='add'){
			$data=array(
			'purchase_date'=>strtotime($this->input->post('orderdate')),
			'purchase_no'=>$this->input->post('purchase_no'),
			'supplier_id'=>$this->input->post('supplier'),
			'sub_total'=>$this->input->post('subTotalValue'),
			'vat'=>$this->input->post('vatValue'),
			'total_amount'=>$this->input->post('ttavalue'),
			'discount'=>$this->input->post('discount'),
			'grand_total'=>$this->input->post('grandTotalValue'),
			'paid'=>$this->input->post('paid'),
			'due'=>$this->input->post('dueValue'),
			'payment_type'=>$this->input->post('ptype'),
			'payment_status'=>$this->input->post('pstatus'),
			'pm_date'=>date('M'),
			);
			$this->db->insert('purchases',$data);
			//get last id
			$last_insert = $this->db->insert_id();
			//continue
			$stock_name=$this->input->post('name');
			$category=$this->input->post('category');
			$description=$this->input->post('measurements');
			$qt=$this->input->post('qt');
			$bp=$this->input->post('b_price');
			$sp=$this->input->post('s_price');
			$tt=$this->input->post('ptotal');
			for($i=0; $i<count($stock_name); $i++) {
				$da =array();
					$da[$i] = array(
           				'name' => $stock_name[$i], 
           				'purchase_id' => $last_insert,
           				'category'=>$category[$i],
						'description_id'=>$description[$i],
						'b_price'=>$bp[$i],
						's_price'=>$sp[$i],
						'available'=>$qt[$i],
						'purchases_ordered'=>$qt[$i],
						'purchase_total'=>$tt[$i],
           			);		   
			$this->db->insert_batch('stock', $da);
			}
			return true;
		}
		if($p1=='update'){
			$data=array(
				'name'=>$this->input->post('name'),
				'category'=>$this->input->post('category'),
				'available'=>$this->input->post('avail'),
				'description_id'=>$this->input->post('measure'),
				's_price'=>$this->input->post('price')
				);
				$this->db->where('stock_id',$p2);
				$this->db->update('stock',$data);
				move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/stock_image/' . $p2 . '.jpg');
		}
		if($p1=='pricing'){
			$data=array(
				's_price'=>$this->input->post('price')
				);
				$this->db->where('stock_id',$p2);
				$this->db->update('stock',$data);
		}
		if($p1=='upstockarray'){
			$stockid=$this->input->post('sid');
			$bprice=$this->input->post('bprice');
			$sprice=$this->input->post('sprice');
			$damn=$this->input->post('damaged');
			$availables=$this->input->post('available');
			for($s=0; $s<count($stockid); $s++) {
			$dut=array();
			$dut[$s] = array(
						'stock_id'=>$stockid[$s],
           				'b_price'=>$bprice[$s], 
						's_price'=>$sprice[$s], 
						'available'=>$availables[$s],
						'damaged'=>$damn[$s],  
						);			
			$this->db->update_batch('stock',$dut,'stock_id');
			}
			return true;
		}
		if($p1=='update_damage'){
			$actual_d=$this->input->post('rem');
			$avail=trim($this->input->post('available'));
			$dam=trim($this->input->post('damage'));
			$rem=($avail-$dam);
			$final_damage=($actual_d+$dam);
			if($rem >= 0){
				$data=array(
					'available'=>$rem,
					'damaged'=>$final_damage,
				);
				$this->db->where('stock_id',$p2);
				$this->db->update('stock',$data);
				return true;
			}
			else{
				return false;
			}
		}
		if($p1=='update_pay'){
			$due=$this->input->post('x');
			$payment=$this->input->post('payment');
			$paid=$this->input->post('paid');
			$f_paid=$paid+$payment;
			$f_due=$due-$payment;
			$pstatus=$this->input->post('pstatus');
			if($pstatus=='3'){
				$data=array(
					'paid'=>$f_paid,
					'due'=>$f_due,
					'payment_status'=>'1',
					);
			}else{
				$data=array(
					'paid'=>$f_paid,
					'due'=>$f_due,
					);
			}
			$this->db->where('purchase_id',$p2);
			$this->db->update('purchases',$data);
			}
	}
	
	function orders($p1='',$p2=''){
		
		if($p1=='update_sales'){
			$due=$this->input->post('x');
			$payment=$this->input->post('payment');
			$paid=$this->input->post('paid');
			$f_paid=$paid+$payment;
			$f_due=$due-$payment;
			$pstatus=$this->input->post('pstatus');
			
			if($pstatus=='3'){
				$data=array(
					'paid'=>$f_paid,
					'due'=>$f_due,
					'payment_status'=>'1',
					);
			}else{
				$data=array(
					'paid'=>$f_paid,
					'due'=>$f_due,
					);
			}
			$this->db->where('order_id',$p2);
			$this->db->update('orders',$data);
		}
		if($p1=='edit_order'){
			$data=array(
			'order_date'=>strtotime($this->input->post('odate')),
			'customer_name'=>$this->input->post('cname'),
			'phone'=>$this->input->post('contact'),
			'sub_total'=>$this->input->post('osubTotalValue'),
			'vat'=>$this->input->post('ovatValue'),
			'total_amount'=>$this->input->post('ottavalue'),
			'discount'=>$this->input->post('odiscount'),
			'grand_total'=>$this->input->post('ograndTotalValue'),
			'paid'=>$this->input->post('opaid'),
			'due'=>$this->input->post('odueValue'),
			'payment_type'=>$this->input->post('optype'),
			'payment_status'=>$this->input->post('opstatus'),
			'order_no'=>$this->input->post('ono'),
			);
			$this->db->where('order_id',$p2);
			$this->db->update('orders',$data);
			//get last id
			$last_insert = $p2;
			//continue
			$product=$this->input->post('oproduct');
			$quantity=$this->input->post('oquantity');
			$price=$this->input->post('opriceValue');
			$totalValue=$this->input->post('ototalValue');
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
			
			//delete from order_item table first 
			$this->db->where('order_id', $p2);
            $this->db->delete('order_item');
			
			//add afresh the data in order_item
			$da =array();
					$da[$i] = array(
           				'order_id' => $last_insert, 
           				'stock_id' => $product[$i],
           				'quantity_ordered'=>$quantity[$i],
						'price'=>$price[$i],
						'total'=>$totalValue[$i],
						'order_item_status'=>'0',
           			);		   
			$this->db->insert_batch('order_item',$da);
			}
			//return $last_insert;
			return true;
			
		}
	}
	
	//manage events
	function event($param1='',$param3=''){
		if($param1=='add'){
			if($param3=='admin'){
			$check=$this->input->post('check');
			if($check==1){$state=1;}else{$state=0;}
			$data=array(
				'title'=>$this->input->post('title'),
				'notice'=>$this->input->post('notice'),
				'status'=>$state,
				'posted_by'=>'admin',
				'event_date'=>strtotime($this->input->post('edate')),
			);
			$this->db->insert('events',$data);
			}
			elseif($param3=='user'){
			$data=array(
				'title'=>$this->input->post('title'),
				'notice'=>$this->input->post('notice'),
				'status'=>1,
				'posted_by'=>'user',
				'user_id'=>$this->input->post('user_id'),
				'event_date'=>strtotime($this->input->post('edate')),
			);
			$this->db->insert('events',$data);
			}
			elseif($param3=='salesManager'){
			$data=array(
				'title'=>$this->input->post('title'),
				'notice'=>$this->input->post('notice'),
				'status'=>1,
				'posted_by'=>'sales manager',
				'user_id'=>$this->input->post('user_id'),
				'event_date'=>strtotime($this->input->post('edate')),
			);
			$this->db->insert('events',$data);
			}
			elseif($param3=='manager'){
			$data=array(
				'title'=>$this->input->post('title'),
				'notice'=>$this->input->post('notice'),
				'status'=>1,
				'posted_by'=>'inventory manager',
				'user_id'=>$this->input->post('user_id'),
				'event_date'=>strtotime($this->input->post('edate')),
			);
			$this->db->insert('events',$data);
			}
		}
		if($param1=='update'){
			$check=$this->input->post('check');
			if($check==1){$state=1;}else{$state=0;}
			$data=array(
				'title'=>$this->input->post('title'),
				'notice'=>$this->input->post('notice'),
				'status'=>$state,
				'event_date'=>strtotime($this->input->post('edate')),
			);
			$this->db->where('id',$param3);
			$this->db->update('events',$data);
		}
	}
	
	//Manage descriptions (array format)
	function descriptions($p1='',$p2=''){
		if($p1=='add'){
			$name=$this->input->post('name');
			$unit=$this->input->post('unit');
			$quantity=$this->input->post('quantity');
			
			for($i=0; $i<count($name); $i++) {	
			$data =array();
					$data[$i] = array(
           				'd_name' => $name[$i], 
           				'unit' => $unit[$i],
           				'quantity' => $quantity[$i],
           			);		   
			$this->db->insert_batch('descriptions', $data);
			}	
		}
		if($p1=='update'){
			$data=array(
				'd_name'=>$this->input->post('name'),
				'unit'=>$this->input->post('unit'),
				'quantity'=>$this->input->post('quantity')
		   		);
				
			$this->db->where('description_id',$p2);
			$this->db->update('descriptions',$data);
		}
		
		
	}
	function fetchCategoryData($classId = null){
		if($classId) {
			$sql = "SELECT * FROM category WHERE category_id = ?";
			$query = $this->db->query($sql, array($classId));
			return $query->row_array();
		} 
		else {
			$sql = "SELECT * FROM category";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}
	
	function fetchDescData($classId = null){
		if($classId) {
			$where="d_name='?'";
			$this->db->distinct();
			$this->db->select('d_name');
			$this->db->from('descriptions');
			$dept = $this->db->get()->result_array();
			return $dept;
		} 
		else {
			$this->db->distinct();
			$this->db->select('d_name');
			$this->db->from('descriptions');
			$dept = $this->db->get()->result_array();
			return $dept;
		}
	}
	
	function security($p1='',$p2=''){
		if($p1=='add'){
			$decrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));
			$data=array(
				'question'=>$this->input->post('quiz'),
				'answer'=>md5($this->input->post('pass1'))
			);
			$this->db->where('id',$decrypt);
			$this->db->update('login',$data);
		}
		if($p1=='can_get_username'){
			$username=$this->input->post('username');
			$this->db->where('username', $username);
			$query=$this->db->get('login');
		
		if($query->num_rows()==1){
			return true;
		}
		else{
			return false;
			}
		}
		if($p1=='get_security_answer'){
			$q=md5($this->input->post('ans'));
			$this->db->where('answer', $q);
			$query=$this->db->get('login');
		
		if($query->num_rows()==1){
			return true;
		}
		else{
			return false;
			}
		}
	}
	
	
	/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
	
	function create_backup($param2)

	{

		$this->load->dbutil();

		

		

		$options = array(

                'format'      => 'txt',             // gzip, zip, txt

                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file

                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file

                'newline'     => "\n"               // Newline character used in backup file

              );

		

		 

		if($param2 == 'all')

		{

			$tables = array('');

			$file_name	=	'system_backup';

		}

		else 

		{

			$tables = array('tables'	=>	array($param2));

			$file_name	=	'backup_'.$param2;

		}



		$backup =& $this->dbutil->backup(array_merge($options , $tables)); 





		$this->load->helper('download');

		force_download($file_name.'.sql', $backup);

	}
	

	function restore_backup()
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/database/backup.sql');
		$this->load->dbutil();
		$prefs = array(

            'filepath'						=> 'uploads/database/backup.sql',

			'delete_after_upload'			=> TRUE,

			'delimiter'						=> ';'

        );
		$restore =& $this->dbutil->restore($prefs); 
		unlink($prefs['filepath']);

	}
	
	function add_cat(){
		$data=array(
		'c_name' => $this->input->post('name'),
		'status' => $this->input->post('status'),
		);
		
		$query=$this->db->insert('category',$data);
		if($query){
			return true;
		}
		else{
			return false;
		}
	}
	
	function history($p1='',$p2='',$p3='',$p4='',$p5=''){
		$a = $this->db->get_where('login' , array('id' => $p3))->result_array();
        foreach ($a as $row) {
            $username=$row['username'];
			$role=$row['role'];
        	}
		if($p1=='added'){
			if($p2=='supplier'){
				$data=array(
					'description'=>'<b>'.$username.'</b> added new supplier',
					'table_name'=>'supplier',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='user'){
				$data=array(
					'description'=>'<b>'.$username.'</b> added new user',
					'table_name'=>'(login/profiles)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='phrases'){
				$data=array(
					'description'=>'<b>'.$username.'</b> added a new phrase',
					'table_name'=>'(language)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='language'){
				$data=array(
					'description'=>'<b>'.$username.'</b> added a new language',
					'table_name'=>'(language)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
		}
		if($p1=='updated'){
			if($p2=='supplier'){
			$b = $this->db->get_where('supplier' , array('supplier_id' => $p4))->result_array();
			foreach ($b as $row) {
				$s_number=$row['supplier_number'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> updated supplier <b>'.$s_number.'</b>',
					'table_name'=>'supplier',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='user'){
			$b = $this->db->get_where('profiles' , array('id' => $p4))->result_array();
			foreach ($b as $row) {
				$u_user=$row['username'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> updated user <b>'.$u_user.'</b>',
					'table_name'=>'(login/profiles)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='stock'){
			$b = $this->db->get_where('stock' , array('stock_id' => $p4))->result_array();
			foreach ($b as $row) {
				$stock_name=$row['name'];
				$desc_id=$row['description_id'];
				}
			$c = $this->db->get_where('descriptions' , array('description_id' => $desc_id))->result_array();
			foreach ($c as $row) {
				$unit=$row['unit'];
				$quantity=$row['quantity'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> updated stock <b>'.$stock_name.' ('.$quantity.$unit.')</b>',
					'table_name'=>'(stock)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='damage'){
			$b = $this->db->get_where('stock' , array('stock_id' => $p4))->result_array();
			foreach ($b as $row) {
				$stock_name=$row['name'];
				$desc_id=$row['description_id'];
				}
			$c = $this->db->get_where('descriptions' , array('description_id' => $desc_id))->result_array();
			foreach ($c as $row) {
				$unit=$row['unit'];
				$quantity=$row['quantity'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> marked <b>'.$p5.'</b> of <b>'.$stock_name.' ('.$quantity.$unit.')</b> damaged',
					'table_name'=>'(stock)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='profile'){
				$data=array(
					'description'=>'<b>'.$username.'</b> updated profile.',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			
			if($p2=='activated'){
				$c = $this->db->get_where('login' , array('user_id' => $p4))->result_array();
			foreach ($c as $row) {
				$user_edited=$row['username'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> Activated User Account for <b>'.$user_edited.'</b>',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			
			if($p2=='deactivated'){
				$c = $this->db->get_where('login' , array('user_id' => $p4))->result_array();
			foreach ($c as $row) {
				$user_edited=$row['username'];
				}
				$data=array(
					'description'=>'<b>'.$username.'</b> Disabled User Account for <b>'.$user_edited.'</b>',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			
			if($p2=='profile'){
				$data=array(
					'description'=>'<b>'.$username.'</b> updated profile.',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='password'){
				$data=array(
					'description'=>'<b>'.$username.'</b> changed login password.',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='image'){
				$data=array(
					'description'=>'<b>'.$username.'</b> changed profile image.',
					'table_name'=>'(login)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='settings'){
				$data=array(
					'description'=>'<b>'.$username.'</b> updated system settings',
					'table_name'=>'(settings)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='language'){
				$data=array(
					'description'=>'<b>'.$username.'</b> updated <b>'.$p4.'</b> language phrases',
					'table_name'=>'(language)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
		}
		if($p1=='deleted'){
			if($p2=='supplier'){
				$data=array(
					'description'=>'<b>'.$username.'</b> deleted supplier <b>'.$s_number.'</b>',
					'table_name'=>'supplier',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='user'){
				$data=array(
					'description'=>'<b>'.$username.'</b> deleted user',
					'table_name'=>'(login/profiles)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
			if($p2=='stock'){
				$data=array(
					'description'=>'<b>'.$username.'</b> deleted <b>1</b> stock',
					'table_name'=>'(stock)',
					'user_id'=>$p3,
					'user_role'=>$role,
					'date_created'=>strtotime('now +1 hour'),
				);
				$this->db->insert('history_logs',$data);
			}
		}
	}
	
	
//end of class crud_model bracket
}