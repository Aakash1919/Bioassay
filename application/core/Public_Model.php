<?php

class Public_Model extends CI_Model
{
    protected $_table_name = "";
    
    public function __construct()
    {
        parent::__construct();
    }
     public function Count(){
        $id = $this->session->userdata('id');
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
    }
    
    public function Get($num,$start,$order,$format){
        $id = $this->session->userdata('id');
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }

    public function Save($id,$data){
        if($id==NULL){
            $this->db->insert($this->_table_name,$data);
            $result = $this->db->insert_id();
        }else{
            $this->db->where('id',$id);
            $this->db->update($this->_table_name,$data);
            $result = $id;
        }
        return $result;
    }
    
    public function GetById($id){
        $this->db->where('id',$id);
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->result();
    }
    public function GetByProductId($id){
        $this->db->where('product_id',$id);
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->result();
    }
    public function getAll(){
    	// $this->db->where('status',1);
    	$this->db->select()->from($this->_table_name);
    	return $this->db->get()->result();
    }

    public function getsinglebyid($id){
    	$this->db->where('id',$id);
    	$this->db->select('email')->from($this->_table_name);
    	return $this->db->get()->row()->email;
    }
    public function getsingletitlebyid($id){
    	$this->db->where('id',$id);
    	$this->db->select('title')->from($this->_table_name);
    	return $this->db->get()->row()->title;
    }
    public function mailnow($to,$toname,$from,$fromname,$subject,$message,$attachment1=NULL,$attachment2=NULL){
        
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1'; 
        $config['wordwrap'] = TRUE;
        $config['mailtype']='html';     
        $this->email->initialize($config);
        $this->email->from($from, $fromname);
        $this->email->to($to);
        
        $this->email->subject($subject);
        
        $this->email->message($message);

        $result =   $this->email->send();

        if ($this->email->send(FALSE))
        {
            return 0;
        }else{
            return 1;
        }
              
    }
}

