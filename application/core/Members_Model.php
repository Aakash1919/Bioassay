<?php

class Members_Model extends CI_Model
{
    protected $_table_name = "";
    
    public function __construct()
    {
        parent::__construct();
    }
    public function Count(){
        $id = $this->session->userdata('id');
        $this->db->where('userid',$id);
        $this->db->select()->from($this->_table_name);
        return $this->db->get()->num_rows();
    }
    
    public function Get($num,$start,$order,$format){
        $id = $this->session->userdata('id');
        $this->db->where('userid',$id);
        $this->db->select()->from($this->_table_name)->limit($num,$start)->order_by($order,$format);
        return $this->db->get()->result();
    }
    public function Save($id,$data){
        if($id==NULL){
            $this->db->insert($this->_table_name,$data);
            $result = $this->db->insert_id();
        }else{
            $this->db->where('person_id',$id);
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
    public function Delete($id){
        $this->db->where("id",$id);
        $this->db->delete($this->_table_name);
        return 1;
    }

    public function UploadID($userfile)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '1024';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( !$this->upload->do_upload($userfile))
        {
            $error = array('error' => $this->upload->display_errors());
            $data['response'] = $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
            $this->resizesmall($data['upload_data']['full_path'],$filename);
            $this->resizemed($data['upload_data']['full_path'],$filename);
            $data['filename']= $filename;
            $data['thumb'] = $data['upload_data']['raw_name'].'_thumb'.$data['upload_data']['file_ext'];
            $data['response'] = 'Success';
            $in = array(
                
                'date'=>time(),
                'user_id'=>$this->session->userdata('id'),
                'type'=>'image',
                'filename'=>$data['filename'],
                'thumbnail_small'=>'small/'.$data['thumb'],
                'thumbnail_medium'=>'medium/'.$data['thumb'],
                'status'=>'Active'
            );
            $this->db->insert('media',$in);
            $id = $this->db->insert_id();
            $data['id'] = $id;
        }
        return $id;
    }
    public function resizesmall($path,$file){
        $config['image_library']='gd2';
        $config['source_image']=$path;
        $config['create_thumb']=TRUE;
        $config['maintain_ratio']=TRUE;
        $config['width']='100';
        $config['height']='100';
        $config['new_image']='./uploads/small/'.$file;
        $this->load->library('image_lib',$config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
    }
    public function resizemed($path,$file){
        $config['image_library']='gd2';
        $config['source_image']=$path;
        $config['create_thumb']=TRUE;
        $config['maintain_ratio']=TRUE;
        $config['width']='300';
        $config['height']='300';
        $config['new_image']='./uploads/medium/'.$file;
        $this->load->library('image_lib',$config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        
    }
}

