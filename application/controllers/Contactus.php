<?php
class Contactus extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Admin/Seo_Model');
	}
	
	public function index(){
		$this->data['active'] = "ContactUs";
		$id=7;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		if($_POST){
			//$capcha_site_id = "6LfZd7IUAAAAAFbESekhA3Ub-TQIZtmxZeY68qOA";
			if(!empty($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$this->data['capcha_site_key'].'&response='.$_POST['g-recaptcha-response']);
	        $responseData = json_decode($verifyResponse);
	        if($responseData->success){
	        	$this->form_validation->set_rules('fname', 'fname', 'required', array('required' => 'You must provide a %s.'));
	        	$this->form_validation->set_rules('email', 'email', 'required', array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('enquiry', 'enquiry', 'required', array('required' => 'You must provide a %s.'));
				if ($this->form_validation->run() == FALSE)
						{
							$this->data['subview'] = "public/Contactus/index";
							$this->load->view('public/_layout_main',$this->data);
						}
						else
						{
							$fname=$this->input->post('fname');
							$subject=$this->input->post('subject1');
							$email=$this->input->post('email');
							$enquiry=$this->input->post('enquiry');
						         
							     $message3="<html><body>
						             <table border='0' cellpadding='1' align='left' width='700' cellspacing='1'>
							     <tr><td align='left' colspan='2' style='font-family: tahoma,verdana; font-size:15px;'></td>
							     </tr><tr>
							     <td height='20' align='left' style='font-family:tahoma,verdana; font-size:15px;'>Name:</td>
							     <td align='left' style='font-family: tahoma,verdana; font-size:15px; padding-left:2px;'>$fname</td></tr>
						             <tr><td height='20' align='left' style='font-family:tahoma,verdana; font-size:15px;'>Subject: </td>
							     <td align='left' style='font-family: tahoma,verdana; font-size:15px; padding-left:2px;'>$subject</td>
							     </tr><tr>
						             <td height='20' align='left' style='font-family:tahoma,verdana; font-size:15px;'>Email:</td>
							     <td align='left' style='font-family: tahoma,verdana; font-size:15px; padding-left:2px;'>$email</td>
							     </tr><tr>
						             <td height='20' align='left' VALIGN='top' style='font-family:tahoma,verdana; font-size:15px;'>Message:</td>
							     <td align='left' style='font-family: tahoma,verdana; font-size:15px; padding-left:2px;'>$enquiry</td>
							     </tr></table>
							     </body>
							     </html>";

								$header3 = "From: $email \r\n"; 
								$header3.= "MIME-Version: 1.0\r\n"; 
								$header3.= "Content-type: text/html; charset=utf-8\r\n";
								//$to="programmer.ck@gmail.com"; 
								$to="info@bioassaysys.com"; 
							   	$subject ="BioAssay Contact on ".$subject; 
						        $body = $message3;
						 	   //if($fname!='' && $email!='' && $enquiry!='' && $subject!='') { 
							   //if(($email!="sample@email.tst") && ($email!="yahoo@yahoo.com") && ($email!="12832@yahoo.com")) {
						        $r =   mail($to, $subject, $message3, $header3);
						        if (!empty($r)) 
						 	    { 
							    $replymessage="<html>
								            <body>
							                        Dear $fname,<br/><br/>
							                        Thank you for your inquiry. We will contact you shortly.  <br/> <br/> 
												    Best Regards,<br/><br/>
													The BioAssay Systems Team
						                             </body></html>";
							
							    	$headers3 = "From:info@bioassaysys.com \r\n"; 
						          	$headers3 .= "Content-type: text/html\r\n";
						          //$to ="$email"; 
						          $subject = "Inquiry";
								    mail($email, $subject,$replymessage, $headers3); 
								   // $this->data['response'] = "Message sent successfully";
								    $this->session->set_flashdata('response', 'Message sent successfully');
								    redirect('/contactus');
								   
								}
			}		
	        }else{
	        	$this->data['error'] = "Robot Verification failed";
	        	}
			}
		}
		$this->data['subview'] = "public/Contactus/index";
		$this->load->view('public/_layout_main',$this->data);
	}
}