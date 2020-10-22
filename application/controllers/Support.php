<?php
class Support extends Public_Controller{

public function __construct(){
parent::__construct();
$this->load->model('Admin/Seo_Model');
$this->load->model('Public/Products_Model');
}

public function index(){
$this->data['active'] = "Support";
$id=5;
$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
$this->data['subview'] = "public/Support/index";
$this->load->view('public/_layout_main',$this->data);
}
public function get_ajax()
{
if($_POST['pid'])
		{ 
		$pid=$_POST['pid'];
		$fetch = $this->Products_Model->select_citation_details($pid);
		foreach ($fetch as $f) {
			$cit_data = $this->Products_Model->getcitbyid($pid);
			?>
			
			<span class="textbold_orange"><?php echo $f['name'];?>, catalog #: <?php echo $f['catalog_num'];?></span><br><span class="bodytext">
				<?php if(!empty($cit_data)){
					foreach ($cit_data as $citt) {

	                }
	                for($q=1; $q<=50; $q++){
	                  $cit = "cit".$q;

	                  if(!empty($citt->$cit)){
	                    echo "<ol>";
	                    echo $citt->$cit;
	                    echo "</ol>";
	                    echo '<br></span><br>';

	                  }
	                } 

					?>
					<!-- <ol>
						<?php echo $f['citations'];?><br>
					</ol><br></span><br> -->
					<p class="bodytext">Return to<a href="#"> top of page </a></p><br>

				<?php }else {?>
					<ol>
						<br />
						<b> Currently no citations for this product.</b>
						<br>
					</ol><br></span><br>
		<?php
		}
	}}
}
public function product_citations(){
		$this->data['active'] = "Support";
		$id=5;
		$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
		$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
		$this->data['ct1'] = $this->Products_Model->Getctone();
		$this->data['ct2'] = $this->Products_Model->Getcttwo();
		$this->data['ct3'] = $this->Products_Model->Getctthree();
		$this->data['subview'] = "public/Support/product_citations";
		$this->load->view('public/_layout_main',$this->data);
}

public function general_questions(){
$this->data['active'] = "Support";
$id=5;
$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
//$this->data['FAQ'] = $this->Products_Model->GetFAQ(2);
$this->data['subview'] = "public/Support/general_questions";
$this->load->view('public/_layout_main',$this->data);
}

public function troubleshooting(){
$this->data['active'] = "Support";
$id=5;
$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
$this->data['subview'] = "public/Support/troubleshooting";
$this->load->view('public/_layout_main',$this->data);
}

public function training_videos(){
$this->data['active'] = "Support";
$id=5;
$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
$this->data['subview'] = "public/Support/training_videos";
$this->load->view('public/_layout_main',$this->data);
}

public function news(){
$this->data['active'] = "Support";
$id=5;
$this->data['keywords'] = $this->Seo_Model->GetProperty('Title',$id);
$this->data['description'] = $this->Seo_Model->GetProperty('Description',$id);
$this->data['subview'] = "public/Support/news";
$this->load->view('public/_layout_main',$this->data);
}
public function NLprocess(){

// Hello! welcome to the settings page.
// Here's your two steps guide:

// FIRST: 
// Instead of newsletter@test.com put the email address of the mailing list,
// (the same that SendBlaster uses in Manage Subscriptions Section)
// ... please pay attention to the  ' ' apostrophes, they must remain around the email address.

$emailmanager = 'subscribe@bioassaysys.com';
//$emailmanager = 'programmer.aakash@gmail.com';
// SECOND:
// save this file, and close it. Thank you!


error_reporting(0);

$email = trim($_POST['email']);
$Ok = ereg("^([a-zA-Z0-9_\.-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$", $email);
if ($Ok) {
	mail($emailmanager,'Subscribe','','From: '.$email);

	if(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$UNameFrm))
	{
	?>
<script language = 'javascript'>
	alert('Thank you, your address was added to our Mailing List');
	history.go(-1);
	</script>
<?
	exit();
	}
} 

else {
	if(!ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",$UNameFrm))
	{
	?>
<script language = 'javascript'>
	alert('Sorry, please provide a valid Email address.');
	history.go(-1);
	</script>
<?
	exit();
	}
}
}
public function sendSupportMessage(){
	
       
if($this->input->post()){
if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
	 $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$this->data['capcha_site_key'].'&response='.$_POST['g-recaptcha-response']);
	        $responseData = json_decode($verifyResponse);
	        if($responseData->success){

	        	$fname=$_POST['fname'];
$subject=$_POST['subject2'];
$email=$_POST['email'];
$enquiry=$_POST['enquiry'];


$message1="<html><body>
      <table border='0' cellpadding='1' align='left' width='700' cellspacing='1'>
  <tr><td align='left' colspan='2' style='font-family: tahoma,verdana; font-size:12px;'></td>
  </tr><tr><td height='20' align='left' style='font-family:tahoma,verdana; font-size:12px;'>Name:</td>
  <td align='left' style='font-family: tahoma,verdana; font-size:12px; padding-left:2px;'>$fname</td> </tr>
      <tr><td height='20' align='left' style='font-family:tahoma,verdana; font-size:12px;'>Subject: </td>
  <td align='left' style='font-family: tahoma,verdana; font-size:12px; padding-left:2px;'>$subject</td>
  </tr><tr><td height='20' align='left' style='font-family:tahoma,verdana; font-size:12px;'>Email:</td>
  <td align='left' style='font-family: tahoma,verdana; font-size:12px; padding-left:2px;'>$email</td>
  </tr><tr><td height='20' align='left' VALIGN='top' style='font-family:tahoma,verdana; font-size:12px;'>Message:</td>
  <td align='left' style='font-family: tahoma,verdana; font-size:12px; padding-left:2px;'>$enquiry</td>
  </tr></table></body></html>";

$header1 = "From: $email \r\n"; 
$header1.= "MIME-Version: 1.0\r\n"; 
$header1.= "Content-type: text/html; charset=utf-8\r\n";
//$to = 'programmer.ck@gmail.com';
$to="info@bioassaysys.com"; 
$subject ="BioAssay Contact on ".$subject; 
   $body = $message1;
   if($fname!='' && $email!='' && $enquiry!='' && $subject!='') { 
if(($email!="sample@email.tst") && ($email!="yahoo@yahoo.com") && ($email!="12832@yahoo.com")) {
   if (mail($to, $subject, $message1, $header1)) 
    { 
$replymessage="<html>
            <body>
                    Dear $fname,<br/><br/>
                    Thank you for your inquiry. We will contact you shortly.  <br/> <br/> 
				    Best Regards,<br/><br/>
					The BioAssay Systems Team
                     </body></html>";

$headers1 = "From:info@bioassaysys.com \r\n"; 
  $headers1 .= "Content-type: text/html\r\n";
  $to ="$email"; 
  $subject = "Inquiry";
mail($to, $subject,$replymessage, $headers1); 
    ?>
   <script language="javascript" type="text/javascript">
   //   alert('Thank You For Contacting !');
window.location='/support/index?msg'; 
</script>
   <?php 
    } 
}
  else
{
?>
 <script language="javascript" type="text/javascript">
//  alert('Message Sending Failed !');
  window.location='/support/index?ms'; 
</script>
<?php 
}
 }  else { ?>
<script language="javascript" type="text/javascript">
//  alert('Message Sending Failed !');
  window.location='/support/index?ms'; 
</script>
<?php }



	        }
}else{?>

<script language="javascript" type="text/javascript">
//  alert('Message Sending Failed !');
  window.location='/support/index?msc'; 
</script>
<?php
}
}
}
}