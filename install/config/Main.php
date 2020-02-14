<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

public function __construct(){
		parent:: __construct();
		$this->load->model('Crud_model','crud');
	}
	//load index
	public function index()
	{
		$this->load->dbutil();
			if ($this->dbutil->database_exists('%DATABASE%'))
				{
					$this->login('view');
				}
			else{
					redirect(base_url() . 'install/index.php?o=require', 'refresh');
			}
	}
	//load login
	public function login($p1=''){
		if($p1=='view'){
		$this->load->view('login');
		}
		//validate
		if($p1=='validate'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username','Username','required|trim|callback_validate_credentials');
			$this->form_validation->set_rules('password','Password','required|md5|trim');
			
			if($this->form_validation->run()){
			
			$credential=array(
			'username' =>$this->input->post('username')		
			);
			
			//$this->crud->checkLogin($credential);
			$this->crud->can_do_login();
			
		  $query = $this->db->get_where('login', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			
			$usertype=$row->role;
			$account_status=$row->login_status;
			
			//check first if account is disabled
			if($account_status!='disabled'){
			
			if($usertype=='admin'){
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->id);
            $this->session->set_userdata('username', $row->username);
            $this->session->set_userdata('role', 'admin');
			
			$x=$this->session->userdata('username');			
			$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> '.get_phrase('welcome').' '.$x.' !!!</h4> '.get_phrase('you_have_successfully_loggedin').'');
			redirect(base_url() . 'admin/dashboard', 'refresh');
			
			//$this->load->view('backend/admin/dashboard');
			}
			elseif($usertype=='sales person'){
				$this->session->set_userdata('user_login', '1');
				$this->session->set_userdata('login_user_id', $row->id);
				$this->session->set_userdata('username', $row->username);
				$this->session->set_userdata('role', 'user');
				
				//initialize
				$x=$this->session->userdata('username');
				$uid=$this->session->userdata('login_user_id');
				$quiz=$this->db->get_where('login' , array('id'=>$uid))->row()->question;
				
				if($quiz!='1'){			
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Pick from where you left off.');				
				redirect(base_url() . 'user/dashboard', 'refresh');
				}else{
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Set Your Security Question.');				
				redirect(base_url() . 'user/security_question/security', 'refresh');
				}
				
				}
				
				elseif($usertype=='inventory manager'){
				$this->session->set_userdata('inventory_login', '1');
				$this->session->set_userdata('login_user_id', $row->id);
				$this->session->set_userdata('username', $row->username);
				$this->session->set_userdata('role', 'inventory manager');
				
				//initialize
				$x=$this->session->userdata('username');
				$uid=$this->session->userdata('login_user_id');
				$quiz=$this->db->get_where('login' , array('id'=>$uid))->row()->question;
				
				if($quiz!='1'){			
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Pick from where you left off.');				
				redirect(base_url() . 'manager/dashboard', 'refresh');
				}else{
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Set Your Security Question.');				
				redirect(base_url() . 'manager/security_question/security', 'refresh');
				}
				
				}
				
				elseif($usertype=='sales manager'){
				$this->session->set_userdata('sales_login', '1');
				$this->session->set_userdata('login_user_id', $row->id);
				$this->session->set_userdata('username', $row->username);
				$this->session->set_userdata('role', 'sales manager');
				
				//initialize
				$x=$this->session->userdata('username');
				$uid=$this->session->userdata('login_user_id');
				$quiz=$this->db->get_where('login' , array('id'=>$uid))->row()->question;
				
				if($quiz!='1'){			
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Pick from where you left off.');				
				redirect(base_url() . 'salesManager/dashboard', 'refresh');
				}else{
				$this->session->set_flashdata('alert_message', '<h4><i class="fa fa-check"></i> Welcome '.$x.' !!!</h4> Set Your Security Question.');				
				redirect(base_url() . 'salesManager/security_question/security', 'refresh');
				}
				
				}
				
				else{
					//incase no account is loaded
				}
			}
			else{
				
				$data['username']=$this->input->post('username');
				$this->account('disabled',$data);
			
				}
            
        }
			
		}
		
		else{
			$this->index();
		}
		}
	}
	
	
	//validate login if user is available
	public function validate_credentials(){
		$credential=$this->input->post('username');
		if(!$this->crud-> checkLogin($credential)){
		$this->form_validation->set_message('validate_credentials', '<i class="fa fa-info-circle"></i> This User does not exist!');
		return false;
			
		}
		elseif($this->crud->can_do_login()){
			
		return true;
			
		}
		else{
			$this->form_validation->set_message('validate_credentials', '<i class="fa fa-info-circle"></i> Incorrect Username/Password!');
			return false;
		}
	}
	
	//logoutfunction
	function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('flash_message', 'You have logged_out');
        redirect(base_url(), 'refresh');
    }
	
	function send_mail(){
		$this->load->view('mails');
			}
			
	//forgot_password
	function forgot_password($p1='',$p2=''){
		if($p1=='forgot'){
			$this->load->view('forgot_password');
		}
		if($p1=='change_password'){
			$username=$this->input->post('username');
			$this->form_validation->set_rules('username','username','required|trim');
			$this->form_validation->set_rules('password','password','required|trim|min_length[5]|differs[username]',
			array('required'=>'Please Input Your password.',
					'differs'=>'Input a unique password not matching Your username!',
					'min_length'=>'Input Atleast <b>Five(5)</b> Characters!',
					));
			$this->form_validation->set_rules('cpassword','Confirm password','required|trim|matches[password]',
			array('required'=>'Confirm Your password.',
					'matches'=>'The Passwords do not match!'
				));
			if($this->form_validation->run()==FALSE){
				$data['username']=$username;
				$this->load->view('changepass',$data);
			}else{
				$this->crud->change_login_credentials();
				$this->load->view('success');
			}
		}
		if($p1=='validate'){
			$this->form_validation->set_rules('username','username','required|trim|callback_validate_username',
			array('required'=>'Please Input Your Username.'));
			if($this->form_validation->run()==FALSE){
				$this->forgot_password('forgot','refresh');
			}else{
			$credential=array(
			'username' =>$this->input->post('username')		
			);
		$this->crud->security('can_get_username');
		$query = $this->db->get_where('login', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			$data['question']=$row->question;
			$data['username']=$row->username;
			$this->load->view('question',$data);
		}
			}
		}
		if($p1=='confirm_answer'){
			$credential=array(
			'username' =>$this->input->post('username')		
			);
		$this->form_validation->set_rules('ans','Answer','required|trim|callback_validate_answer',
			array('required'=>'The answer is Required'));
			if($this->form_validation->run()==FALSE){
			$query = $this->db->get_where('login', $credential);
				if ($query->num_rows() > 0) {
					$row = $query->row();
					$data['question']=$row->question;
					$data['username']=$row->username;
					$this->load->view('question',$data);
				}
			}else{
			$credential=array(
			'username' =>$this->input->post('username')		
			);
		$this->crud->security('get_security_answer');
		$query = $this->db->get_where('login', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
			//$data['question']=$row->question;
			$data['username']=$row->username;
			$this->load->view('changepass',$data);
		}
			}
			
		}
	}
	
	function validate_username(){
		if($this->crud->security('can_get_username')){
			
		return true;
			
		}
		else{
			$this->form_validation->set_message('validate_username', 'This User does not exist!');
			return false;
		}
	}
	
	function validate_answer(){
		if($this->crud->security('get_security_answer')){
			
		return true;
			
		}
		else{
			$this->form_validation->set_message('validate_answer', 'Your answer is incorrect!');
			return false;
		}
	}
	
	//forgot_password
	function account($p1='',$p2=''){
		if($p1=='disabled'){
			$this->load->view('disabled_account',$p2);
		}
	}


function sendMail()
{
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.gmail.com',
  //'smtp_port' => 587,
  'smtp_port' => 587,
  'smtp_user' => 'johnsonmatoke@gmail.com', // change it to yours
  'smtp_pass' => '29845991', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

$message=$this->input->post('message');

        $this->load->library('email');
		$this->load->initialize($config);
      $this->email->set_newline("\r\n");
      $this->email->from('johnsonmatoke@gmail.com'); // change it to yours
      $this->email->to('stevenyabayo@gmail.com');// change it to yours
      $this->email->subject('Resume from johnson');
      $this->email->message($message);
	  $result=$this->email->send();
      if($result)
     {
      echo 'Email sent.';
	  echo $this->email->print_debugger();
     }
     else
    {
     show_error($this->email->print_debugger());
    }

}
	
//closing bracket down here
}


