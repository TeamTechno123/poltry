<?php
class Transaction_Model extends CI_Model{

  function check_login($email, $password){
    $query = $this->db->select('*')
      ->where('user_email', $email)
      ->where('user_password', $password)
      ->from('user')
      ->get();
    $result = $query->result_array();
    return $result;
  }

  public function save_data($tbl_name, $data){
    $this->db->insert($tbl_name, $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function get_list($company_id,$id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->where('company_id', $company_id)
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_list2($id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_info($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_info_arr($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result_array();
    return $result;
  }

  public function update_info($id_type, $id, $tbl_name, $data){
    $this->db->where($id_type, $id)
    ->update($tbl_name, $data);
  }

  public function delete_info($id_type, $id, $tbl_name){
    $this->db->where($id_type, $id)
    ->delete($tbl_name);
  }

  public function check_duplication($company_id,$value,$field_name,$table_name){
    $query = $this->db->select($field_name)
      // ->where('company_id', $company_id)
      ->where($field_name,$value)
      ->from($table_name)
      ->get();
    $result = $query->num_rows();
    return $result;
  }

  public function user_list($company_id){
    $query = $this->db->select('*')
      ->where('is_admin', 0)
      ->where('company_id',$company_id)
      ->from('user')
      ->get();
    $result = $query->result();
    return $result;
  }

  public function check_dupli_num($company_id,$value,$field_name,$table_name){
    $this->db->select($field_name);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    $this->db->where($field_name,$value);
    $this->db->from($table_name);
    $query = $this->db->get();
    $num = $query->num_rows();
    return $num;
  }

  public function get_support_list($company_id){
  $query = $this->db->select('support.*, app_user.*')
  ->from('support')
  ->where('support.company_id', $company_id)
    ->join('app_user', 'app_user.app_user_id = support.app_user_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_post_list($company_id){
  $query = $this->db->select('post.*, app_user.*')
  ->from('post')
  ->where('post.company_id', $company_id)
    ->join('app_user', 'app_user.app_user_id = post.app_user_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_question_list($company_id){
  $query = $this->db->select('question.*, app_user.*')
  ->from('question')
  ->where('question.company_id', $company_id)
    ->join('app_user', 'app_user.app_user_id = question.app_user_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }



}
?>
