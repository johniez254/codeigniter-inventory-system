<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends CI_Controller {

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
    }
	
	function check_session(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
	}
	
	function suppliers($p1='',$p2=''){
		//$this->check_session();
		if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get('supplier' )->result_array();
			$data['pdf_name']	=	'supplier';
			$this->load->view('pdfreports',$data);
		}
		if($p1=='excel'){
			date_default_timezone_set('Africa/nairobi');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Suppliers');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Registered Suppliers');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Supplier Number');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Supplier Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Phone');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Supplier Address');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Supplier Email');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Date Registered');


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data
		$sql = "SELECT supplier_number,supplier_name,supplier_phone,supplier_address,supplier_email,date_added from supplier";        
		$rs = $this->db->query($sql);
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $filename='Supplier_list-'.date('d/m/y').'.xls'; //save our workbook as this file name
				ob_end_clean();
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
				exit();
				ob_end_clean();

		}
	}

function descriptions($p1='',$p2=''){
		//$this->check_session();
		if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['des']	=	$this->db->get('descriptions' )->result_array();
			$data['pdf_name']	=	'descriptions';
			$this->load->view('pdfreports',$data);
		}
		if($p1=='excel'){
		date_default_timezone_set('Africa/nairobi');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Descriptions');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Stock Descriptions');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Description Measurement');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Description Unit');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Description Measurement');


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:C1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data
		$sql = "SELECT d_name,unit,quantity from descriptions";        
		$rs = $this->db->query($sql);
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $filename='Description_list-'.date('d/m/y').'.xls'; //save our workbook as this file name
				ob_end_clean();
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
				exit();
				ob_end_clean();

		}
}

function stock($p1='',$p2=''){
	//$this->check_session();
	if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get('stock' )->result_array();
			$data['pdf_name']	=	'stock';
			$this->load->view('pdfreports',$data);
		}
}

function sales($p1='',$p2=''){
	//$this->check_session();
	if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get('orders' )->result_array();
			$data['pdf_name']	=	'sales';
			$this->load->view('pdfreports',$data);
		}
}

function purchase_outstandings($p1='',$p2=''){
	//$this->check_session();
	if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get_where('purchases', array('due>='=>'1'))->result_array();
			$data['pdf_name']	=	'purchase_outstandings';
			$this->load->view('pdfreports',$data);
		}
}

function sales_outstandings($p1='',$p2=''){
	//$this->check_session();
	if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get_where('orders', array('due>='=>'1'))->result_array();
			$data['pdf_name']	=	'sales_outstandings';
			$this->load->view('pdfreports',$data);
		}
	if($p1=='excel'){
		date_default_timezone_set('Africa/nairobi');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Suppliers');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Sales Outstandings');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Customer Name');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Sales Number');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Sales Date');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Total Amount');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Total Paid');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Balance');


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:F1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data
		$sql = "SELECT customer_name,order_no,order_date,grand_total,paid,due from orders where due>='1'";        
		$rs = $this->db->query($sql);
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $filename='Sales_outstandings-'.date('d/m/y').'.xls'; //save our workbook as this file name
				ob_end_clean();
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
				exit();
				ob_end_clean();
	}
}

function users($p1='',$p2=''){
	$this->check_session();
	if($p1=='pdf'){
			$this->load->helper('pdf_helper');
			$data['sup']	=	$this->db->get('profiles')->result_array();
			$data['pdf_name']	=	'users';
			$this->load->view('pdfreports',$data);
		}
	if($p1=='excel'){
			date_default_timezone_set('Africa/nairobi');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Users');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Registered Users');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Full names');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Username');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Phone Number');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('E2', 'IDNO');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Date Registered');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Role');


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:G1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data
		$sql = "SELECT fullnames,username,phone,address,idno,datereg,role from profiles";        
		$rs = $this->db->query($sql);
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $filename='Users-'.date('d/m/y').'.xls'; //save our workbook as this file name
				ob_end_clean();
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
				exit();
				ob_end_clean();
	}
}
	
//end of class bracket		
}
