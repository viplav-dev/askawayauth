<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCompanies(){
        $this->db->select('*');
        $this->db->from('companies');
        //company id not 0
        $this->db->where('company_id !=',0);
       
        $query = $this->db->get();
        return $query->result_array();
    }
  
}