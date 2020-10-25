<?php

class User extends Public_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Member/Auth_Model');
		$this->load->helper('captcha');
		
	}

	public function login(){
		$this->data['active'] = "Login";

		if($_POST){
			$this->form_validation->set_rules('email', 'Email', 'required', array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('pswd', 'Password', 'required', array('required' => 'You must provide a %s.'));
			$email = $this->input->post('email');
			$password =  base64_encode($this->input->post('pswd'));
			$InactiveUser = $this->User_Model->CheckUserStatus($email,$password);
			if ($this->form_validation->run() == FALSE)
			{
				$this->data['subview'] = "members/User/login";
				$this->load->view('public/_layout_main',$this->data);
			}elseif(isset($InactiveUser) && $InactiveUser!=false){
				$to=$email;
				$subject = "Account Registration | BioAssay Systems";
				$message="<html><body>
				<table border='0' cellpadding='4' align='left' width='400' cellspacing='4'>
				<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Dear User,</td></tr>
				<tr><td><p>Your account is Inactive.<br /><br />
				Please <a href='".base_url()."user/verify?id=".base64_encode($InactiveUser)."'>Click Here</a> to activate your account.</p></td></tr>
				<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Thanks!</td></tr>
				<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Your BioAssay Systems Team</td></tr>
				</table>
				</body>
				</html>"; 
				$headers = 'From: webmaster@bioassaysys.com' . "\r\n" ;
				$headers .= "Content-type: text/html\r\n".'Reply-To: webmaster@bioassaysys.com.' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			    	$this->data['response'] = "Your account is inactive and an email has been sent again to activate your account. Please Activate your account and try again later";
					$this->data['subview'] = "members/User/login";
					$this->load->view('public/_layout_main',$this->data);
			}
			else
			{
				$result = $this->User_Model->login($email,$password);
				if(!empty($result)){
					$fromcart = $this->input->post('fromcart');
					if(!empty($fromcart)){
						redirect('/checkout/checkout');
					}else{
						redirect(base_url());
					}
				}else{
					$this->data['response'] = "Wrong username or password!";
					$this->data['subview'] = "members/User/login";
					$this->load->view('public/_layout_main',$this->data);
				}    
			}
			
		}else{
			$this->data['subview'] = "members/User/login";
			$this->load->view('public/_layout_main',$this->data);
		}
		
	}
	public function register(){
		$this->data['active'] = "Register";
		$vals = array(
			'img_path'      => './theme/captcha/',
			'img_url'       => base_url().'theme/captcha/',
			'font_path'     => './theme/fonts/tahoma_2.ttf',
			'img_width'     => '150',
			'img_height'    => 40,
			'expiration'    => 7200,
			'word_length'   => 6,
			'font_size'     => 20,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		);

		$this->data['countryvalue']=array("US","AL","DZ","AS","AO","AI","AG","AR","AM","AW","AU","AT","AZ","BS","BH","BD","BB","BY","BE","BZ","BJ","BM","BT",
			"BO","BL","BA","BW","BR","VG","BN","BG","BF","BI","KH","CM","CA","CV","KY","TD","CL","CN","CO","CG","CK","CR","HR","CB","CY","CZ","DK",
			"DJ","DM","DO","EC","EG","SV","EE","ET","FJ","FI","FR","GF","PF","GA","GM","GE","DE","GH","GI","GR","GD","GP","GU","GT","GN","GW","GY",
			"HT","HN","HK","HU","IS","IN","ID","IE","IL","IT","CI","JM","JP","JO","KZ","KE","KI","XK","XE","KW","KG","LA","LV","LB","LS","LT","LU","MK","MG",
			"MW","MY","MV","ML","MT","MH","MQ","MR","MU","MX","MD","MN","MS","MA","MZ","NP","NL","NC","NZ","NI","NE","NG","MP","NO","OM","PK",
			"PW","PA","PG","PY","PE","PH","PL","XP","PT","PR","QA","RE","RO","XC","RU","RW","XS","SA","SN","CS","SC","SG","SK","SI","SB","ZA","KR",
			"ES","LK","NT","VI","EU","VI","KN","LC","MB","VI","VC","SR","SZ","SE","CH","SY","TJ","TW","TZ","TH","XN","TG","TO","VG","TT","XA","TN",
			"TR","TM","TC","TV","UG","UA","VC","AE","GB","UY","VI","UZ","VU","VE","VN","VG","WF","WS","XY","YE","ZM","ZW");

		$this->data['countryname']=array("United States","Albania","Algeria","American Samoa",
			"Angola","Anguilla","Antigua","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan",
			"Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia",
			"Bonaire","Bosnia Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi",
			"Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Chad","Chile","China","Colombia","Congo",
			"Cook Islands","Costa Rica","Croatia","Curacao","Cyprus","Czech Republic",
			"Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Estonia","Ethiopia","Fiji","Finland",
			"France","French Guiana","French Polynesia",
			"Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Grenada","Guadeloupe",
			"Guam","Guatemala","Guinea","Guinea Bissau","Guyana",
			"Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Ireland (Republic of)","Israel","Italy","Ivory Coast",
			"Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo",
			"Kosrae Island","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Lithuania","Luxembourg",
			"Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta",
			"Marshall Islands","Martinique","Mauritania","Mauritius","Mexico","Moldova","Mongolia","Montserrat","Morocco","Mozambique",
			"Nepal","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Northern Mariana Islands","Norway",
			"Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Ponape","Portugal","Puerto Rico",
			"Qatar","Reunion","Romania","Rota","Russia","Rwanda","Saipan","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Singapore",
			"Slovakia","Slovenia","Solomon Islands","South Africa","South Korea","Spain","Sri Lanka","St. Barthelemy","St. Croix","St. Eustatius",
			"St. John","St. Kitts and Nevis","St. Lucia","St. Maarten","St. Thomas","St. Vincent and the Grenadines",
			"Suriname","Swaziland","Sweden","Switzerland","Syria","Tadjikistan","Taiwan","Tanzania","Thailand","Tinian","Togo","Tonga","Tortola",
			"Trinidad and Tobago","Truk","Tunisia","Turkey","Turkmenistan","Turks and Caicos","Tuvalu","Uganda","Ukraine","Union Island",
			"United Arab Emirates","United Kingdom","Uruguay","US Virgin Islands","Uzbekistan","Vanuatu","Venezuela","Vietnam",
			"Virgin Gorda","Wallis and Futuna","Western Samoa","Yap","Yemen","Zambia","Zimbabwe");

		if($_POST){
		
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', 
				array(
					'required' => 'You must provide a %s.',
					'valid_email'=>'You must provide valid %s',
					'is_unique' => '%s is already taken')
			);
			$this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', 
				array(
					'required' => 'You must provide a %s.',
					'matches'=>'%s should match exactly Password')
			);
			$this->form_validation->set_rules('fname', 'First Name', 'required', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('lname', 'Last Name', 'required', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('bphone', 'Phone Number', 'required|numeric', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('bcompany', 'Company Name', 'required', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('baddr1', 'Address', 'required', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('bcity', 'City Name', 'required', 
				array(
					'required' => '%s is required.')
			);

			$this->form_validation->set_rules('bstate', 'State Name', 'required', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('bzip', 'Zip Code', 'required|numeric', 
				array(
					'required' => '%s is required.')
			);
			$this->form_validation->set_rules('bcountry', 'Country', 'required', 
				array(
					'required' => '%s is required.')
			);
			$capcha_site_key = $this->data['capcha_site_key'];
			if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$capcha_site_key.'&response='.$_POST['g-recaptcha-response']);
	        $responseData = json_decode($verifyResponse);
	        if($responseData->success){
			
			if($this->form_validation->run()== TRUE){

				$data = array(
					'title'=>$this->input->post('title'),
					'full_name'=>$this->input->post('fname').' '.$this->input->post('lname'),
					'last_name'=>$this->input->post('lname'),
					'first_name'=>$this->input->post('fname'),
					'tel'=>$this->input->post('bphone'),
					'fax'=>$this->input->post('bfax'),
					'email'=>trim($this->input->post('email')),
					'company'=>$this->input->post('bcompany'),
					'address_1'=>$this->input->post('baddr1'),
					'address_2'=>$this->input->post('baddr2'),
					'city'=>$this->input->post('bcity'),
					'state'=>$this->input->post('bstate'),
					'zip'=>$this->input->post('bzip'),
					'country'=>$this->input->post('bcountry'),
					'passwd'=>base64_encode($this->input->post('password')),
					'on_email_list'=>$this->input->post('inlist'),
					'tax_exempt'=>$this->input->post('tax_exempt'),
					'AuthorizeProfileID'=>null,
					'AuthorizeProfilePaymentID'=>null,
					'mod_date'=>date('Y-m-d',time()),
					'status'=>'Inactive'
				);
				$personID = $this->User_Model->save(null,$data);
				if(!empty($personID))
				{
					$ccnum = $this->input->post('cccardno');
					if(!empty($ccnum)){
						$ccnum = $this->ccMasking($this->input->post('cccardno'));
					}else{
						$ccnum = "";
					}
					$dataExtra = array(
						'person_id'=>$personID,
						'billing_name'=>$this->input->post('battn'),
						'billing_co_name'=>$this->input->post('bcompany'),
						'billing_address_1'=>$this->input->post('baddr1'),
						'billing_address_2'=>$this->input->post('baddr2'),
						'billing_city'=>$this->input->post('bcity'),
						'billing_state'=>$this->input->post('bstate'),
						'billing_zip'=>$this->input->post('bzip'),
						'billing_country'=>$this->input->post('bcountry'),
						'billing_tel'=>$this->input->post('bphone'),
						'billing_fax'=>$this->input->post('bfax'),
						'shipping_name'=>$this->input->post('sattn'),
						'shipping_co_name'=>$this->input->post('scompany'),
						'shipping_address_1'=>$this->input->post('saddr1'),
						'shipping_address_2'=>$this->input->post('saddr2'),
						'shipping_city'=>$this->input->post('scity'),
						'shipping_state'=>$this->input->post('sstate'),
						'shipping_zip'=>$this->input->post('szip'),
						'shipping_country'=>$this->input->post('scountry'),
						'shipping_tel'=>$this->input->post('sphone'),
						'shipping_email'=>$this->input->post('semail'),
						'mod_date'=>date('Y-m-d',time())
					);
					$result = $this->BSDetail_Model->save(null,$dataExtra);
					if(!empty($result)){
						$email = trim($this->input->post('email'));
						$creditcart = trim($this->input->post('cccardno'));
						$expyear = $this->input->post('expyear');
						$expMonth = $this->input->post('exmonth');
						$expire_date = $expyear."-".$expMonth;
						$cvv = trim($this->input->post('cvv'));
						$firstname = trim($this->input->post('fname'));
						$lastname = trim($this->input->post('lname'));
						$company = trim($this->input->post('bcompany'));
						$address = trim($this->input->post('baddr1'));
						$city = trim($this->input->post('bcity'));
						$state = trim($this->input->post('bstate'));
						$zip = trim($this->input->post('bzip'));
						$country = trim($this->input->post('bcountry'));
						$phone = trim($this->input->post('bphone'));
						$fax = trim($this->input->post('bfax'));
						$sfirstname = trim($this->input->post('fname'));
						$slastname = trim($this->input->post('lname'));
						$scompany = trim($this->input->post('scompany'));
						$saddress = trim($this->input->post('saddress'));
						$scity = trim($this->input->post('scity'));
						$sstate = trim($this->input->post('sstate'));
						$szip = trim($this->input->post('szip'));
						$scountry = trim($this->input->post('scountry'));
						$sphone = trim($this->input->post('sphone'));
						$sfax = trim($this->input->post('sfax'));
						if(!empty($creditcart) && !empty($expyear) && !empty($expMonth) && !empty($cvv)){
							
						$responseData = $this->Auth_Model->createCustomerProfile($email,$creditcart,$expire_date,$cvv,$firstname,$lastname,$company,$address,$city,$state,$zip,$country,$phone,$fax,$sfirstname,$slastname,$scompany,$saddress,$scity,$sstate,$szip,$scountry,$sphone,$sfax);
						$AuthorizeprofileID =$responseData['profileID'];
						$AuthorizePaymentID = $responseData['paymentprofileID'];
						$this->data['response']=$responseData['response'];
						$msg = "Response: ".json_encode($responseData);
						$UpdateData = array('AuthorizeProfilePaymentID'=>$AuthorizePaymentID,'AuthorizeProfileID'=>$AuthorizeprofileID);
						$this->User_Model->save($personID,$UpdateData);
						}else{
							$this->data['response'] = "User registered successfully";
						}
						
						$to=$email;
						$passwrd = $this->input->post('password');
						$subject = "Account Registration | BioAssay Systems";
						$message="<html><body>
						<table border='0' cellpadding='4' align='left' width='400' cellspacing='4'>
						<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Dear ".$firstname." ".$lastname.",</td></tr>
						<tr><td><p>Your account ".$personID." has been successfully created at ".base_url().". <br /><br />
						Registered Email: ".$email."<br />
						Please <a href='".base_url()."user/verify?id=".base64_encode($personID)."'>Click Here</a> to activate your account.</p></td></tr>
						<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Thanks!</td></tr>
						<tr><td align='left' style='font-family: tahoma,verdana; font-size:14px; padding-left:2px;'>Your BioAssay Systems Team</td></tr>
						</table>
						</body>
						</html>"; 
						$headers = 'From: webmaster@bioassaysys.com' . "\r\n" ;
						$headers .= "Content-type: text/html\r\n".'Reply-To: webmaster@bioassaysys.com.' . "\r\n" .'X-Mailer: PHP/' . phpversion();
						mail($to, $subject, $message, $headers);

						//$this->data['response'] = "Thanks for registering with BioAssay";
						$this->data['subview'] = "members/User/thanks";
						$this->load->view('public/_layout_main',$this->data);
					}else{
						$this->data['response'] = "Robot Verification failed";
						$this->data['subview'] = "members/User/register";
						$this->load->view('public/_layout_main',$this->data);
					}
				}
					}else{
						$this->data['response'] = "Unable to register, Please try again later";
						$this->data['subview'] = "members/User/register";
						$this->load->view('public/_layout_main',$this->data);
					}
				}
			}else{
				$this->data['response'] = "Robot Verification failed";
				$this->data['subview'] = "members/User/register";
			    $this->load->view('public/_layout_main',$this->data);
			}
			
		}else{
			$this->data['subview'] = "members/User/register";
			$this->load->view('public/_layout_main',$this->data);
		}

		
	}
	public function verify(){
		$id = base64_decode($_GET['id']);
		if(!empty($id)){
			$this->User_Model->activate($id);
		}
		$this->data['active'] = "Account Verified";
		$this->data['subview'] = "members/User/verify";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/user/login');
	}
	public function setNewpassword()
	{
		if($_GET['request']){
			$personId = base64_decode($_GET['request']);
			$result = $this->User_Model->CheckPersonID($personId);
			if(!empty($result)){
				$this->data['personID'] = $personId;
				$this->data['active'] = "Forgot";
				$this->data['subview'] = "members/User/changepassword";
				$this->load->view('public/_layout_main',$this->data);
			}else{
				$this->data['response'] = "Sorry, Due to some technical difficulties we are unable to update your password.";
				
				$this->load->view('public/_layout_main',$this->data);	
			}
		}
	}
	public function forgot(){
		$this->data['active'] = "Forgot";
		$postData = $this->input->post();
		if($postData){
			$email = $this->input->post('email');
			$result = $this->User_Model->forgot($email);
			if(!empty($result))
			{
				foreach ($result as $r) {
					$personID  = $r->person_id;
					$email = $r->email;
					$password = base64_decode($r->passwd);
				} 
				$to = $email;
				$subject = 'Reset Your Password | BioAssay Systems';
				//$message = 'Your current password is: '.$password;
				
				$message = "Please click on the link to set new password: <a href='".base_url()."user/setNewPassword?request=".base64_encode($personID)."'>Click Here</a>";
				$headers = 'From: webmaster@bioassaysys.com' . "\r\n" ;
				$headers .= "Content-type: text/html\r\n".'Reply-To: webmaster@bioassaysys.com.' . "\r\n" .'X-Mailer: PHP/' . phpversion();
				$resultMail = mail($to, $subject, $message, $headers);
				if(!empty($resultMail)){
					$this->data['response'] = "Please check your email to reset your password.";
					$this->data['responseGreen'] = 1;
				}else{
					$this->data['response'] = "Due to some technical issue email cannot be sent. Please try again later";

				}
			}else{
				$this->data['response'] = "Sorry this email is not registered with our system.";
			}
		}
		$this->data['subview'] = "members/User/forgot";
		$this->load->view('public/_layout_main',$this->data);
	}

	public function profile(){
		$this->data['active'] = "Profile";
		$personID = $this->session->userdata('person_id');
		if(isset($personID)) {
			$this->data['personIDA'] = $personID;
			$this->data['GetAllUserDetails'] = $this->User_Model->GetAllUserDetailsByID($personID);
		}
		$this->data['subview'] = "members/User/profile";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function profileEdit(){
		$this->data['active'] = "Profile-Edit";
		$personID = $this->session->userdata('person_id');
		if(isset($personID)) {
			$this->data['personIDA'] = $personID;
			$this->data['GetAllUserDetails'] = $this->User_Model->GetAllUserDetailsByID($personID);
		}
		if($this->input->post()){
			$emailCh = $this->input->post('email');
			$personID = $this->input->post('personID');
			$emailCheck = $this->User_Model->EmailCheck($emailCh,$personID);
			if($emailCheck==false){
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', 
			array(
				'required' => 'You must provide a %s.',
				'valid_email'=>'You must provide valid %s',
				'is_unique' => '%s is already taken')
		);
			}
			
		$this->form_validation->set_rules('fname', 'First Name', 'required', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('lname', 'Last Name', 'required', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('bphone', 'Phone Number', 'required|numeric', 
			array(
				'required' => '%s is required.')
		);
		// $this->form_validation->set_rules('fax', 'Fax Number', 'numeric', 
		// 	array(
		// 		'numeric' => '%s shoul be numeric.')
		// );
		$this->form_validation->set_rules('bcompany', 'Company Name', 'required', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('baddr1', 'Address', 'required', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('bcity', 'City Name', 'required', 
			array(
				'required' => '%s is required.')
		);

		$this->form_validation->set_rules('bstate', 'State Name', 'required', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('bzip', 'Zip Code', 'required|numeric', 
			array(
				'required' => '%s is required.')
		);
		$this->form_validation->set_rules('bcountry', 'Country', 'required', 
			array(
				'required' => '%s is required.')
		);


		if($this->form_validation->run()== TRUE){
			
			$data = array(
				'title'=>$this->input->post('title'),
				'full_name'=>$this->input->post('fname').' '.$this->input->post('lname'),
				'last_name'=>$this->input->post('lname'),
				'first_name'=>$this->input->post('fname'),
				'tel'=>$this->input->post('bphone'),
				'fax'=>$this->input->post('bfax'),
				'email'=>trim($this->input->post('email')),
				'company'=>$this->input->post('bcompany'),
				'address_1'=>$this->input->post('baddr1'),
				'address_2'=>$this->input->post('baddr2'),
				'city'=>$this->input->post('bcity'),
				'state'=>$this->input->post('bstate'),
				'zip'=>$this->input->post('bzip'),
				'country'=>$this->input->post('bcountry'),
				'on_email_list'=>$this->input->post('inlist'),
				'tax_exempt'=>$this->input->post('tax_exempt'),
				'mod_date'=>date('Y-m-d',time()),
				'status'=>'Inactive'
			);
			$personID = $this->User_Model->save($personID,$data);
			if(!empty($personID))
			{
				$dataExtra = array(
					'person_id'=>$personID,
					'billing_name'=>$this->input->post('battn'),
					'billing_co_name'=>$this->input->post('bcompany'),
					'billing_address_1'=>$this->input->post('baddr1'),
					'billing_address_2'=>$this->input->post('baddr2'),
					'billing_city'=>$this->input->post('bcity'),
					'billing_state'=>$this->input->post('bstate'),
					'billing_zip'=>$this->input->post('bzip'),
					'billing_country'=>$this->input->post('bcountry'),
					'billing_tel'=>$this->input->post('bphone'),
					'billing_fax'=>$this->input->post('bfax'),
					'shipping_name'=>$this->input->post('sattn'),
					'shipping_co_name'=>$this->input->post('scompany'),
					'shipping_address_1'=>$this->input->post('saddr1'),
					'shipping_address_2'=>$this->input->post('saddr2'),
					'shipping_city'=>$this->input->post('scity'),
					'shipping_state'=>$this->input->post('sstate'),
					'shipping_zip'=>$this->input->post('szip'),
					'shipping_country'=>$this->input->post('scountry'),
					'shipping_tel'=>$this->input->post('sphone'),
					'shipping_email'=>$this->input->post('semail'),
					'mod_date'=>date('Y-m-d',time())
				);
				$result = $this->BSDetail_Model->save($personID,$dataExtra);
				if(!empty($result)){
					$email = trim($this->input->post('email'));
					$creditcart = trim($this->input->post('cccardno'));
					$expyear = $this->input->post('expyear');
					$expMonth = $this->input->post('exmonth');
					$expire_date = $expyear."-".$expMonth;
					$cvv = trim($this->input->post('cvv'));
					$firstname = trim($this->input->post('fname'));
					$lastname = trim($this->input->post('lname'));
					$company = trim($this->input->post('bcompany'));
					$address = trim($this->input->post('baddr1'));
					$city = trim($this->input->post('bcity'));
					$state = trim($this->input->post('bstate'));
					$zip = trim($this->input->post('bzip'));
					$country = trim($this->input->post('bcountry'));
					$phone = trim($this->input->post('bphone'));
					$fax = trim($this->input->post('bfax'));
					$sfirstname = trim($this->input->post('fname'));
					$slastname = trim($this->input->post('lname'));
					$scompany = trim($this->input->post('scompany'));
					$saddress = trim($this->input->post('saddress'));
					$scity = trim($this->input->post('scity'));
					$sstate = trim($this->input->post('sstate'));
					$szip = trim($this->input->post('szip'));
					$scountry = trim($this->input->post('scountry'));
					$sphone = trim($this->input->post('sphone'));
					$sfax = trim($this->input->post('sfax'));
					if(!empty($creditcart) && !empty($expyear) && !empty($expMonth) && !empty($cvv)){
						
					$responseData = $this->Auth_Model->createCustomerProfile($email,$creditcart,$expire_date,$cvv,$firstname,$lastname,$company,$address,$city,$state,$zip,$country,$phone,$fax,$sfirstname,$slastname,$scompany,$saddress,$scity,$sstate,$szip,$scountry,$sphone,$sfax);
					$AuthorizeprofileID =$responseData['profileID'];
					$AuthorizePaymentID = $responseData['paymentprofileID'];
					$response = array('Response'=>0,'Message'=>$responseData['response']);
					$this->session->set_flashdata('response',$response);
					$UpdateData = array('AuthorizeProfilePaymentID'=>$AuthorizePaymentID,'AuthorizeProfileID'=>$AuthorizeprofileID);
					$this->User_Model->save($personID,$UpdateData);
					}else{

						$response = array('Response'=>0,'Message'=>"Profile Updated successfully");
						$this->session->set_flashdata('response',$response);
					}
				}

			}
		}else{
						$response = array('Response'=>0,'Message'=>validation_errors());
						$this->session->set_flashdata('response',$response);
	
		}
		redirect('/user/profileEdit');
		}
		$this->data['subview'] = "members/User/EditProfile";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function changepassword(){
		$this->data['active'] = "forgot";
		$personID = $this->session->userdata('person_id');
		if(isset($personID)) {
			$this->data['personID']=$personID;
		}
		if($this->input->post())
		{
		
			$this->form_validation->set_rules('passwrd', 'Password', 'required');
			$this->form_validation->set_rules('passwrd1', 'Password Confirmation', 'required|matches[passwrd]');
			if($this->form_validation->run() == FALSE){
				$this->data['response'] = validation_errors();
				$this->data['personID']=base64_decode($this->input->post('request'));
			}else{
				$personID=base64_decode($this->input->post('request'));
				$data = array('passwd'=>base64_encode($this->input->post('passwrd')));
				$result = $this->User_Model->save($personID,$data);
				if(!empty($result)){
					$this->data['subview'] = "members/User/changeThankyou";
					$this->load->view('public/_layout_main',$this->data);			
				}
			}
		}
		$this->data['subview'] = "members/User/changepassword";
		$this->load->view('public/_layout_main',$this->data);
	}
	public function userInactive()
	{
		$currentDate = date('Y-m-d',time());
		$returnID = $this->User_Model->checkInactiveAccounts($currentDate);
		if(!empty($returnID)){
			print_r($returnID);
			foreach($returnID as $rid=>$rvalue){
				$personID = $rvalue['person_id'];
				$res = $this->User_Model->DeleteUserInactiveOne($personID);
				if($res==true){
					$this->User_Model->DeleteUserInactiveTwo($personID);
		
				}
			}
		}
	}
	public function ccMasking($number, $maskingCharacter = 'X') {
    return substr($number, 0, 4) . str_repeat($maskingCharacter, strlen($number) - 8) . substr($number, -4);
	}

	public function export(){
		// if(!empty($result)){
		// 				$email = trim($this->input->post('email'));
		// 				$creditcart = trim($this->input->post('cccardno'));
		// 				$expyear = $this->input->post('expyear');
		// 				$expMonth = $this->input->post('exmonth');
		// 				$expire_date = $expyear."-".$expMonth;
		// 				$cvv = trim($this->input->post('cvv'));
		// 				$firstname = trim($this->input->post('fname'));
		// 				$lastname = trim($this->input->post('lname'));
		// 				$company = trim($this->input->post('bcompany'));
		// 				$address = trim($this->input->post('baddr1'));
		// 				$city = trim($this->input->post('bcity'));
		// 				$state = trim($this->input->post('bstate'));
		// 				$zip = trim($this->input->post('bzip'));
		// 				$country = trim($this->input->post('bcountry'));
		// 				$phone = trim($this->input->post('bphone'));
		// 				$fax = trim($this->input->post('bfax'));
		// 				$sfirstname = trim($this->input->post('fname'));
		// 				$slastname = trim($this->input->post('lname'));
		// 				$scompany = trim($this->input->post('scompany'));
		// 				$saddress = trim($this->input->post('saddress'));
		// 				$scity = trim($this->input->post('scity'));
		// 				$sstate = trim($this->input->post('sstate'));
		// 				$szip = trim($this->input->post('szip'));
		// 				$scountry = trim($this->input->post('scountry'));
		// 				$sphone = trim($this->input->post('sphone'));
		// 				$sfax = trim($this->input->post('sfax'));
		// 				if(!empty($creditcart) && !empty($expyear) && !empty($expMonth) && !empty($cvv)){
							
		// 				$responseData = $this->Auth_Model->createCustomerProfile($email,$creditcart,$expire_date,$cvv,$firstname,$lastname,$company,$address,$city,$state,$zip,$country,$phone,$fax,$sfirstname,$slastname,$scompany,$saddress,$scity,$sstate,$szip,$scountry,$sphone,$sfax);
		// 				$AuthorizeprofileID =$responseData['profileID'];
		// 				$AuthorizePaymentID = $responseData['paymentprofileID'];
		// 				$this->data['response']=$responseData['response'];
						
		// 				$UpdateData = array('AuthorizeProfilePaymentID'=>$AuthorizePaymentID,'AuthorizeProfileID'=>$AuthorizeprofileID);
		// 				$this->User_Model->save($personID,$UpdateData);
		// 				}
						
						
		// 			}
	}
}