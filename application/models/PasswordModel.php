<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasswordModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    //get passwords from database where status is 1
    public function getPasswords($userId)
    {
        $this->db->select('passwords.pswd_id as id,passwords.pswd_name as name,passwords.pswd_username as username ,passwords.pswd_site as site,passwords.pswd_notes as notes,companies.company_name,companies.company_site, companies.company_imageurl as image, passwords.pswd_enc ');
        $this->db->from('passwords');
        $this->db->join('companies', 'companies.company_id = passwords.company_id','left');
        $this->db->where('passwords.pswd_userId', $userId);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    public function getPassword($userId,$passwordId){
        $this->db->select('passwords.pswd_id as id,passwords.pswd_name as name,passwords.pswd_username as username ,passwords.pswd_site as site,passwords.pswd_notes as notes,companies.company_name,companies.company_site, companies.company_imageurl as image, passwords.pswd_enc ');
        $this->db->from('passwords');
        $this->db->join('companies', 'companies.company_id = passwords.company_id','left');
        $this->db->where('passwords.pswd_userId', $userId);
        $this->db->where('passwords.pswd_id', $passwordId);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;

    }
    public function getUserHash($userId){

        $this->db->select('userHash');
        $this->db->from('users');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['userHash'];

    }
    //add $pswd_userId,$company_id,$pswd_username,$pswd_enc,$pswd_name,$pswd_site,$pswd_notes to passwords
    public function addPassword($pswd_userId, $company_id, $pswd_username, $pswd_enc, $pswd_name, $pswd_site, $pswd_notes)
    {
        $data = array(
            'pswd_userId' => $pswd_userId,
            'company_id' => $company_id,
            'pswd_username' => $pswd_username,
            'pswd_enc' => $pswd_enc,
            'pswd_name' => $pswd_name,
            'pswd_site' => $pswd_site,
            'pswd_notes' => $pswd_notes,
        );
        $this->db->insert('passwords', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function deletePassword($userId,$passwordId){
        $this->db->where('pswd_userId', $userId);
        $this->db->where('pswd_id', $passwordId);
        return $this->db->delete('passwords');
         

    }
}
