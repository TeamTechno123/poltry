<?php
class User_Model extends CI_Model{

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


  public function get_product_list($company_id){
  $query = $this->db->select('product.*, product_category.*')
  ->from('product')
  ->where('product.company_id', $company_id)
    ->join('product_category', 'product_category.product_category_id = product.product_category', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_blog_list($company_id){
  $query = $this->db->select('blog.*, blog_category.*')
  ->from('blog')
  ->where('blog.company_id', $company_id)
    ->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_blog_info($company_id , $blog_id){
  $query = $this->db->select('blog.*, blog_category.*')
  ->from('blog')
  ->where('blog.blog_id', $blog_id)
  ->where('blog.company_id', $company_id)
    ->join('blog_category', 'blog_category.blog_category_id = blog.blog_category_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_product_info($company_id, $product_id){
  $query = $this->db->select('product.*, product_category.*')
  ->from('product')
  ->where('product.product_id', $product_id)
  ->where('product.company_id', $company_id)
    ->join('product_category', 'product_category.product_category_id = product.product_category', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function business_trans_data($business_id){
    $query = $this->db->select('business_trans.*,product_category.*,product.*')
        ->from('business_trans')
        ->where('business_trans.business_id', $business_id)
        ->join('product_category', 'business_trans.product_category_id = product_category.product_category_id', 'LEFT')
        ->join('product', 'business_trans.product_id = product.product_id', 'LEFT')
        ->get();
    $result = $query->result();
    return $result;
  }

  // function check_otp($otp, $user_id){
  //   $query = $this->db->select('*')
  //       ->where('user_otp', $otp)
  //       ->where('user_id', $user_id)
  //       ->from('law_user')
  //       ->get();
  //   $result = $query->result_array();
  //   return $result;
  // }
  //
  // function check_pwd($user_id,$old_password){
  //   $query = $this->db->select('user_id')
  //       ->where('user_password', $old_password)
  //       ->where('user_id', $user_id)
  //       ->from('law_user')
  //       ->get();
  //   $result = $query->result_array();
  //   return $result;
  // }

  // public function get_count($id_type,$company_id,$key,$tbl_name){
  //   $this->db->select($id_type);
  //   if($key != ''){
  //     $this->db->where('application_status', $key);
  //   }
  //   $this->db->where('company_id', $company_id);
  //   $this->db->from($tbl_name);
  //     $query =  $this->db->get();
  //   $result = $query->num_rows();
  //   return $result;
  // }
  // public function get_count2($id_type,$key,$tbl_name){
  //   $this->db->select($id_type);
  //   if($key != ''){
  //     $this->db->where('application_status', $key);
  //   }
  //   $this->db->from($tbl_name);
  //     $query =  $this->db->get();
  //   $result = $query->num_rows();
  //   return $result;
  // }


}
?>
