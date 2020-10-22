<?php
class User_Model extends Members_Model{

	protected $_table_name = "users";

	public function __construct(){
		parent::__construct();
	}

	public function login($email,$password){
		$this->db->where('email',$email);
		$this->db->where('passwd',$password);
		$this->db->where('status','Active');
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows == 1){
			$this->db->where('email',$email);
			$this->db->where('passwd',$password);
			$this->db->where('status','Active');
			$this->db->select()->from($this->_table_name);
			$result = $this->db->get()->result();
			foreach ($result as $r) {
				$person_id = $r->person_id;
				$fullname = $r->full_name;
				$email = $r->email;
				$status = $r->status;
			}
			$userSession = array(
									'person_id' =>$person_id,
									'fullname'=>$fullname,
									'email'=>$email,
									'status'=>$status,
							        'logged_in' => TRUE
							);
			$this->session->set_userdata($userSession);
			return true;
		}else{
			return false;
		}

	}
	public function CheckUserStatus($email,$password){
		$this->db->where('email',$email);
		$this->db->where('passwd',$password);
		$this->db->where('status','Inactive');
		$this->db->select()->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows == 1){
			$this->db->where('email',$email);
			$this->db->where('passwd',$password);
			$this->db->where('status','Inactive');
			$this->db->select()->from($this->_table_name);
			return $this->db->get()->row()->person_id;
		}else{
			return false;
		}
	}
	public function activate($id){
		$data = array('status'=>'Active');
		$this->db->where('person_id',$id);
		$this->db->update($this->_table_name,$data);
		return true;

	}
	public function checkAuthProfilePaymentID($personID){
		$this->db->where('person_id',$personID);
		$this->db->select()->from($this->_table_name);
		$rows= $this->db->get()->num_rows();
		if($rows > 0){
			$this->db->where('person_id',$personID);
			$this->db->select()->from($this->_table_name);
	    	return $this->db->get()->row()->AuthorizeProfilePaymentID;
		}else{
			return false;
		}
		
	}
		public function lastfourdigit($personID){
		$this->db->where('person_id',$personID);
		$this->db->select()->from($this->_table_name);
		$rows= $this->db->get()->num_rows();
		if($rows > 0){
			$this->db->where('person_id',$personID);
			$this->db->select()->from($this->_table_name);
	    	return $this->db->get()->row()->cc_four;
		}else{
			return false;
		}
		
	}
	public function checkAuthProfileID($personID){
		$this->db->where('person_id',$personID);
		$this->db->select()->from($this->_table_name);
		$rows= $this->db->get()->num_rows();
		if($rows>0){
			$this->db->where('person_id',$personID);
			$this->db->select()->from($this->_table_name);
		return $this->db->get()->row()->AuthorizeProfileID;
		}else{
			return false;
		}

	}
	public function GetAllUserDetailsByID($personID)
	{
		$this->db->where('users.person_id',$personID);
		$this->db->select()->from($this->_table_name);
		$this->db->join('user_meta','users.person_id=user_meta.person_id');
		$rows= $this->db->get()->num_rows();
		if($rows==1)
		{
		$this->db->where('users.person_id',$personID);
		$this->db->select()->from($this->_table_name);
		$this->db->join('user_meta','users.person_id=user_meta.person_id');
		return $this->db->get()->result();
		}else{
			return false;
		}
	}
	public function forgot($email){
		$this->db->where('email',$email);
		$this->db->select('person_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows==1)
		{
		$this->db->where('email',$email);
		$this->db->select()->from($this->_table_name);
		return $this->db->get()->result();
		}else{
			return false;
		}

	}
	    public function Count(){
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
    }
    public function CheckPersonID($personID){
		$this->db->where('person_id',$personID);
		$this->db->select('person_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows==1)
		{
		return true;
		}else{
			return false;
		}
	}
    public function Get($num,$start,$order,$format){
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
	}
	public function checkInactiveAccounts($currentDate){
		$this->db->where("DATEDIFF('$currentDate', mod_date) >=", 1);
		$this->db->where('status','Inactive');
		$this->db->select('person_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows>0){
		$this->db->where("DATEDIFF('$currentDate', mod_date) >=", 1);
		$this->db->where('status','Inactive');
		$this->db->select('person_id')->from($this->_table_name);
		return $this->db->get()->result_array();
		}else{
			return false;
		}
	}
	public function DeleteUserInactiveOne($id){
		$this->db->where("person_id",$id);
        $this->db->delete($this->_table_name);
        return true;
	}
	public function DeleteUserInactiveTwo($id){
		$this->db->where("person_id",$id);
        $this->db->delete('user_meta');
        return true;
	}
	public function EmailCheck($email,$personID){
		$this->db->where("person_id",$personID);
		$this->db->where("email",$email);
		$this->db->select('person_id')->from($this->_table_name);
		$rows = $this->db->get()->num_rows();
		if($rows==1){
			return true;
		}else{
			return false;
		}
		
        
	}
}