<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    // $this->load->model('Transaction_Model');
  }

  public function index(){
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('User/login');
    } else{
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $login = $this->User_Model->check_login($email, $password);
      // print_r($login);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'User');
      } else{
        // echo 'null not';
        $this->session->set_userdata('pol_user_id', $login[0]['user_id']);
        $this->session->set_userdata('pol_company_id', $login[0]['company_id']);
        $this->session->set_userdata('pol_roll_id', $login[0]['roll_id']);
        header('location:'.base_url().'User/dashboard');
      }
    }
  }

  public function dashboard(){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/dashboard');
    $this->load->view('Include/footer');
  }

  public function company_information_list(){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }

    $data['company_list'] = $this->User_Model->get_list($pol_company_id,'company_id','ASC','company');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/company_information_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit Company...
  public function edit_company($company_id){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $up_data = array(
        'company_name' => $this->input->post('company_name'),
        'company_address' => $this->input->post('company_address'),
        'company_city' => $this->input->post('company_city'),
        'company_state' => $this->input->post('company_state'),
        'company_district' => $this->input->post('company_district'),
        'company_statecode' => $this->input->post('company_statecode'),
        'company_mob1' => $this->input->post('company_mob1'),
        'company_mob2' => $this->input->post('company_mob2'),
        'company_email' => $this->input->post('company_email'),
        'company_website' => $this->input->post('company_website'),
        'company_pan_no' => $this->input->post('company_pan_no'),
        'company_gst_no' => $this->input->post('company_gst_no'),
        'company_lic1' => $this->input->post('company_lic1'),
        'company_lic2' => $this->input->post('company_lic2'),
        'company_start_date' => $this->input->post('company_start_date'),
        'company_end_date' => $this->input->post('company_end_date'),
      );
      $this->User_Model->update_info('company_id', $company_id, 'company', $up_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/company_information_list');
    }
    $company_info = $this->User_Model->get_info('company_id', $company_id, 'company');
    if($company_info){
      foreach($company_info as $info){
        $data['update'] = 'update';
        $data['company_id'] = $info->company_id;
        $data['company_name'] = $info->company_name;
        $data['company_address'] = $info->company_address;
        $data['company_city'] = $info->company_city;
        $data['company_state'] = $info->company_state;
        $data['company_district'] = $info->company_district;
        $data['company_statecode'] = $info->company_statecode;
        $data['company_mob1'] = $info->company_mob1;
        $data['company_mob2'] = $info->company_mob2;
        $data['company_email'] = $info->company_email;
        $data['company_website'] = $info->company_website;
        $data['company_pan_no'] = $info->company_pan_no;
        $data['company_gst_no'] = $info->company_gst_no;
        $data['company_lic1'] = $info->company_lic1;
        $data['company_lic2'] = $info->company_lic2;
        $data['company_start_date'] = $info->company_start_date;
        $data['company_end_date'] = $info->company_end_date;
      }
      $this->load->view('Include/head', $data);
      $this->load->view('Include/navbar', $data);
      $this->load->view('User/company_information', $data);
      $this->load->view('Include/footer', $data);
    }
  }

  public function user_information(){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $pol_company_id,
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_addedby' => $pol_user_id,
      );
      $this->User_Model->save_data('user', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/user_information_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/user_information');
    $this->load->view('Include/footer');
  }
  public function user_information_list(){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['user_list'] = $this->User_Model->user_list($pol_company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_information_list',$data);
    $this->load->view('Include/footer',$data);
  }

  public function edit_user($user_id){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_addedby' => $pol_user_id,
      );
      $this->User_Model->update_info('user_id', $user_id, 'user', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/user_information_list');
    }

    $user_info = $this->User_Model->get_info('user_id', $user_id, 'user');
    if($user_info == ''){ header('location:'.base_url().'User/user_information_list'); }
    foreach($user_info as $info){
      $data['update'] = 'update';
      $data['user_name'] = $info->user_name;
      $data['user_mobile'] = $info->user_mobile;
      $data['user_city'] = $info->user_city;
      $data['user_password'] = $info->user_password;
    }
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_information',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_user($user_id){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('user_id', $user_id, 'user');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/user_information_list');
  }

  public function business_category(){
    $pol_user_id = $this->session->userdata('pol_user_id');
    $pol_company_id = $this->session->userdata('pol_company_id');
    $pol_roll_id = $this->session->userdata('pol_roll_id');
    if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('business_category_name', 'Business Category Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $pol_company_id,
        'business_category_name' => $this->input->post('business_category_name'),
        'business_category_addedby' => $pol_user_id,
      );
      $this->User_Model->save_data('business_category', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/business_category_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/business_category');
    $this->load->view('Include/footer');
  }

public function business_category_list(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['bc_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
    $this->load->view('User/business_category_list',$data);
    $this->load->view('Include/footer',$data);
}

public function edit_business_category($business_category_id){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->form_validation->set_rules('business_category_name', 'Business Category Name', 'trim|required');
  if ($this->form_validation->run() != FALSE) {
    $update_data = array(
      'company_id' => $pol_company_id,
      'business_category_name' => $this->input->post('business_category_name'),
      'business_category_addedby' => $pol_user_id,
    );
    $this->User_Model->update_info('business_category_id', $business_category_id, 'business_category', $update_data);
    $this->session->set_flashdata('update_success','success');
    header('location:'.base_url().'User/business_category_list');
  }

  $business_category_info = $this->User_Model->get_info('business_category_id', $business_category_id, 'business_category');
  if($business_category_info == ''){ header('location:'.base_url().'User/user_information_list'); }
  foreach($business_category_info as $info_b){
    $data['update'] = 'update';
    $data['business_category_name'] = $info_b->business_category_name;
  }
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
  $this->load->view('User/business_category',$data);
  $this->load->view('Include/footer',$data);
}

public function delete_business_category($business_category_id){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->User_Model->delete_info('business_category_id', $business_category_id, 'business_category');
  $this->session->set_flashdata('delete_success','success');
  header('location:'.base_url().'User/business_category_list');
}

// public function product_information(){
//       $this->load->view('Include/head');
//       $this->load->view('Include/navbar');
//       $this->load->view('User/product_information');
//       $this->load->view('Include/footer');
// }
// public function product_information_list(){
//   $this->load->view('Include/head');
//   $this->load->view('Include/navbar');
//  $this->load->view('User/product_information_list');
//  $this->load->view('Include/footer');
// }

public function product_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
  $data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
  $this->form_validation->set_rules('product_name', 'product Name', 'trim|required');
  if ($this->form_validation->run() != FALSE) {
    $save_data = array(
      'company_id' => $pol_company_id,
      'product_type' => $this->input->post('business_type'),
      'product_category' => $this->input->post('product_category_id'),
      'product_name' => $this->input->post('product_name'),
      'product_addedby' => $pol_user_id,
    );
    $product_id=$this->User_Model->save_data('product', $save_data);

    if(isset($_FILES['package_img']['name'])){
       $time = time();
       $image_name = 'product_'.$product_id.'_'.$time;
       $config['upload_path'] = 'assets/images/product/';
       $config['allowed_types'] = 'png|jpg';
       $config['file_name'] = $image_name;
       $filename = $_FILES['package_img']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       // $this->load->library('upload', $config);
       $this->upload->initialize($config);
       if ($this->upload->do_upload('package_img')){
         $up_image = array(
           'product_logo' => $image_name.'.'.$ext,
         );
         $this->User_Model->update_info('product_id', $product_id, 'product', $up_image);
       }
       else{
      echo   $error = $this->upload->display_errors();
         $this->session->set_flashdata('status',$this->upload->display_errors());


       }
     }
    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'User/product_information_list');
  }
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
  $this->load->view('User/product_information',$data);
  $this->load->view('Include/footer',$data);
}

public function product_information_list(){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$data['product_list'] = $this->User_Model->get_product_list($pol_company_id);
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
  $this->load->view('User/product_information_list',$data);
  $this->load->view('Include/footer',$data);
}

public function edit_product($product_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->form_validation->set_rules('product_name', 'Business Category Name', 'trim|required');
$data['product_list'] = $this->User_Model->get_product_list($pol_company_id);
$data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
$data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
if ($this->form_validation->run() != FALSE) {
  $update_data = array(
    'company_id' => $pol_company_id,
    'product_type' => $this->input->post('business_type'),
    'product_category' => $this->input->post('product_category_id'),
    // 'business_category_name' => $this->input->post('business_category_name'),
    'product_name' => $this->input->post('product_name'),
    'product_addedby' => $pol_user_id,
  );
  $this->User_Model->update_info('product_id', $product_id, 'product', $update_data);
  if(isset($_FILES['package_img']['name'])){
     $time = time();
     $image_name = 'product_'.$product_id.'_'.$time;
     $config['upload_path'] = 'assets/images/product/';
     $config['allowed_types'] = 'png|jpg';
     $config['file_name'] = $image_name;
     $filename = $_FILES['package_img']['name'];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     // $this->load->library('upload', $config);
     $this->upload->initialize($config);
     if ($this->upload->do_upload('package_img')){
       $up_image = array(
         'product_logo' => $image_name.'.'.$ext,
       );
       $this->User_Model->update_info('product_id', $product_id, 'product', $up_image);
     }
     else{
    echo   $error = $this->upload->display_errors();
       $this->session->set_flashdata('status',$this->upload->display_errors());
     }
   }
  $this->session->set_flashdata('update_success','success');


  header('location:'.base_url().'User/product_information_list');
}

// $product_info = $this->User_Model->get_info('product_id', $product_id, 'product');
// $data['product_list'] = $this->User_Model->get_product_list($pol_company_id);
$product_info = $this->User_Model->get_product_info($pol_company_id, $product_id);

if($product_info == ''){ header('location:'.base_url().'User/user_information_list'); }
foreach($product_info as $info_b){
  $data['update'] = 'update';
  $data['product_name'] = $info_b->product_name;
  $data['product_category_id'] = $info_b->product_category;
  $data['product_category_name'] = $info_b->product_category_name;
  $data['business_type'] = $info_b->product_type;
  // $data['business_category_name'] = $info_b->business_category_name;
  $data['product_status'] = $info_b->product_status;
}
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
$this->load->view('User/product_information',$data);
$this->load->view('Include/footer',$data);
}

public function delete_product($product_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->User_Model->delete_info('product_id', $product_id, 'product');
$this->session->set_flashdata('delete_success','success');
header('location:'.base_url().'User/product_information_list');
}

// public function product_category(){
//       $this->load->view('Include/head');
//       $this->load->view('Include/navbar');
//       $this->load->view('User/product_category');
//       $this->load->view('Include/footer');
// }
// public function product_category_list(){
//   $this->load->view('Include/head');
//   $this->load->view('Include/navbar');
//  $this->load->view('User/product_category_list');
//  $this->load->view('Include/footer');
// }

public function product_category(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->form_validation->set_rules('product_category_name', 'product Category Name', 'trim|required');
  $data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
  if ($this->form_validation->run() != FALSE) {
    $save_data = array(
      'company_id' => $pol_company_id,
      'product_category_type' => $this->input->post('product_category_type'),
      'product_category_name' => $this->input->post('product_category_name'),
      'product_category_addedby' => $pol_user_id,
    );
    $product_category_id=$this->User_Model->save_data('product_category', $save_data);
    if(isset($_FILES['package_img']['name'])){
       $time = time();
       $image_name = 'product_'.$product_category_id.'_'.$time;
       $config['upload_path'] = 'assets/images/product/';
       $config['allowed_types'] = 'png|jpg';
       $config['file_name'] = $image_name;
       $filename = $_FILES['package_img']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       // $this->load->library('upload', $config);
       $this->upload->initialize($config);
       if ($this->upload->do_upload('package_img')){
         $up_image = array(
           'product_category_logo' => $image_name.'.'.$ext,
         );
         $this->User_Model->update_info('product_category_id', $product_category_id, 'product_category', $up_image);
       }
       else{
      echo   $error = $this->upload->display_errors();
         $this->session->set_flashdata('status',$this->upload->display_errors());
       }
     }
    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'User/product_category_list');
  }
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
  $this->load->view('User/product_category',$data);
  $this->load->view('Include/footer',$data);
}

public function product_category_list(){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
  $this->load->view('User/product_category_list',$data);
  $this->load->view('Include/footer',$data);
}

public function edit_product_category($product_category_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->form_validation->set_rules('product_category_name', 'Business Category Name', 'trim|required');
// $data['product_category_list'] = $this->User_Model->get_product_category_list($pol_company_id);
$data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
$data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
if ($this->form_validation->run() != FALSE) {
  $update_data = array(
    'company_id' => $pol_company_id,
    'product_category_type' => $this->input->post('product_category_type'),
    'product_category_name' => $this->input->post('product_category_name'),
    'product_category_addedby' => $pol_user_id,
  );
  $this->User_Model->update_info('product_category_id', $product_category_id, 'product_category', $update_data);
  if(isset($_FILES['package_img']['name'])){
     $time = time();
     $image_name = 'product_category_'.$product_category_id.'_'.$time;
     $config['upload_path'] = 'assets/images/product/';
     $config['allowed_types'] = 'png|jpg';
     $config['file_name'] = $image_name;
     $filename = $_FILES['package_img']['name'];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     // $this->load->library('upload', $config);
     $this->upload->initialize($config);
     if ($this->upload->do_upload('package_img')){
       $up_image = array(
         'product_category_logo' => $image_name.'.'.$ext,
       );
       $this->User_Model->update_info('product_category_id', $product_category_id, 'product_category', $up_image);
     }
     else{
    echo   $error = $this->upload->display_errors();
       $this->session->set_flashdata('status',$this->upload->display_errors());
     }
   }
  $this->session->set_flashdata('update_success','success');


  header('location:'.base_url().'User/product_category_list');
}

$product_category_info = $this->User_Model->get_info('product_category_id', $product_category_id, 'product_category');
if($product_category_info == ''){ header('location:'.base_url().'User/user_information_list'); }
foreach($product_category_info as $info_b){
  $data['update'] = 'update';
  $data['product_category_name'] = $info_b->product_category_name;
  $data['product_category_type'] = $info_b->product_category_type;
  $data['product_category_status'] = $info_b->product_category_status;
}
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
$this->load->view('User/product_category',$data);
$this->load->view('Include/footer',$data);
}

public function delete_product_category($product_category_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->User_Model->delete_info('product_category_id', $product_category_id, 'product_category');
$this->session->set_flashdata('delete_success','success');
header('location:'.base_url().'User/product_category_list');
}

// public function advertise_information_list(){
//       $this->load->view('Include/head');
//       $this->load->view('Include/navbar');
//       $this->load->view('User/advertise_information_list');
//       $this->load->view('Include/footer');
// }
// public function advertise_information(){
//   $this->load->view('Include/head');
//   $this->load->view('Include/navbar');
//  $this->load->view('User/advertise_information');
//  $this->load->view('Include/footer');
// }

public function advertise_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->form_validation->set_rules('advertisement_name', 'Advertisement Name', 'trim|required');
  if ($this->form_validation->run() != FALSE) {
    $save_data = array(
      'company_id' => $pol_company_id,
      'advertisement_name' => $this->input->post('advertisement_name'),
      'advertisement_details' => $this->input->post('advertisement_details'),
      'advertisement_sdate' => $this->input->post('advertisement_sdate'),
      'advertisement_edate' => $this->input->post('advertisement_edate'),
      'advertisement_addedby' => $pol_user_id,
    );
    $advertisement_id=$this->User_Model->save_data('advertisement', $save_data);
    if(isset($_FILES['package_img']['name'])){
       $time = time();
       $image_name = 'product_'.$advertisement_id.'_'.$time;
       $config['upload_path'] = 'assets/images/product/';
       $config['allowed_types'] = 'png|jpg';
       $config['file_name'] = $image_name;
       $filename = $_FILES['package_img']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       // $this->load->library('upload', $config);
       $this->upload->initialize($config);
       if ($this->upload->do_upload('package_img')){
         $up_image = array(
           'advertisement_logo' => $image_name.'.'.$ext,
         );
         $this->User_Model->update_info('advertisement_id', $advertisement_id, 'advertisement', $up_image);
       }
       else{
      echo   $error = $this->upload->display_errors();
         $this->session->set_flashdata('status',$this->upload->display_errors());
       }
     }
    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'User/advertise_information_list');
  }
  $this->load->view('Include/head');
  $this->load->view('Include/navbar');
  $this->load->view('User/advertise_information');
  $this->load->view('Include/footer');
}

public function advertise_information_list(){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$data['adv_list'] = $this->User_Model->get_list($pol_company_id,'advertisement_id','ASC','advertisement');
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
  $this->load->view('User/advertise_information_list',$data);
  $this->load->view('Include/footer',$data);
}

public function edit_advertise_information($advertisement_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->form_validation->set_rules('advertisement_name', 'Advertisement Name', 'trim|required');
$data['adv_list'] = $this->User_Model->get_list($pol_company_id,'advertisement_id','ASC','advertisement');
if ($this->form_validation->run() != FALSE) {
  $update_data = array(
    'company_id' => $pol_company_id,
    'advertisement_name' => $this->input->post('advertisement_name'),
    'advertisement_details' => $this->input->post('advertisement_details'),
    'advertisement_sdate' => $this->input->post('advertisement_sdate'),
    'advertisement_edate' => $this->input->post('advertisement_edate'),
    'advertisement_addedby' => $pol_user_id,
  );
  $this->User_Model->update_info('advertisement_id', $advertisement_id, 'advertisement', $update_data);
  if(isset($_FILES['package_img']['name'])){
     $time = time();
     $image_name = 'advertise_information_'.$advertisement_id.'_'.$time;
     $config['upload_path'] = 'assets/images/product/';
     $config['allowed_types'] = 'png|jpg';
     $config['file_name'] = $image_name;
     $filename = $_FILES['package_img']['name'];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     // $this->load->library('upload', $config);
     $this->upload->initialize($config);
     if ($this->upload->do_upload('package_img')){
       $up_image = array(
         'advertisement_logo' => $image_name.'.'.$ext,
       );
       $this->User_Model->update_info('advertisement_id', $advertisement_id, 'advertisement', $up_image);
     }
     else{
    echo   $error = $this->upload->display_errors();
       $this->session->set_flashdata('status',$this->upload->display_errors());
     }
   }
  $this->session->set_flashdata('update_success','success');
  header('location:'.base_url().'User/advertise_information_list');
}

$advertise_information_info = $this->User_Model->get_info('advertisement_id', $advertisement_id, 'advertisement');
if($advertise_information_info == ''){ header('location:'.base_url().'User/user_information_list'); }
foreach($advertise_information_info as $info_b){
  $data['update'] = 'update';
  $data['advertisement_name'] = $info_b->advertisement_name;
  $data['advertisement_details'] = $info_b->advertisement_details;
  $data['advertisement_sdate'] = $info_b->advertisement_sdate;
  $data['advertisement_edate'] = $info_b->advertisement_edate;
  $data['advertisement_status'] = $info_b->advertisement_status;

}
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
$this->load->view('User/advertise_information',$data);
$this->load->view('Include/footer',$data);
}

public function delete_advertise_information($advertisement_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->User_Model->delete_info('advertisement_id', $advertisement_id, 'advertisement');
$this->session->set_flashdata('delete_success','success');
header('location:'.base_url().'User/advertise_information_list');
}

// public function blog_info_list(){
//       $this->load->view('Include/head');
//       $this->load->view('Include/navbar');
//       $this->load->view('User/blog_info_list');
//       $this->load->view('Include/footer');
// }
// public function blog_info(){
//   $this->load->view('Include/head');
//   $this->load->view('Include/navbar');
//  $this->load->view('User/blog_info');
//  $this->load->view('Include/footer');
// }

public function blog_info(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->form_validation->set_rules('blog_info_name', 'Blog Title', 'trim|required');
  $data['blogc_list'] = $this->User_Model->get_list2('blog_category_id','ASC','blog_category');
  if ($this->form_validation->run() != FALSE) {
    $save_data = array(
      'company_id' => $pol_company_id,
      'blog_category_id' => $this->input->post('blog_category_id'),
      'blog_info_name' => $this->input->post('blog_info_name'),
      'blog_details' => $this->input->post('blog_details'),
      'blog_status' => $this->input->post('blog_status'),
      'blog_addedby' => $pol_user_id,
    );
    $advertisement_id=$this->User_Model->save_data('blog', $save_data);

    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'User/blog_info_list');
  }
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
  $this->load->view('User/blog_info',$data);
  $this->load->view('Include/footer',$data);
}

public function blog_info_list(){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$data['blog_list'] = $this->User_Model->get_blog_list($pol_company_id,'blog_id','ASC','blog');
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
  $this->load->view('User/blog_info_list',$data);
  $this->load->view('Include/footer',$data);
}

public function edit_blog_info($blog_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->form_validation->set_rules('blog_info_name', 'Blog Title Name', 'trim|required');
$data['blog_list'] = $this->User_Model->get_blog_list($pol_company_id,'blog_id','ASC','blog');
$data['blogc_list'] = $this->User_Model->get_list2('blog_category_id','ASC','blog_category');
if ($this->form_validation->run() != FALSE) {
  $update_data = array(
    'company_id' => $pol_company_id,
    'blog_category_id' => $this->input->post('blog_category_id'),
    'blog_info_name' => $this->input->post('blog_info_name'),
    'blog_details' => $this->input->post('blog_details'),
    'blog_status' => $this->input->post('blog_status'),
    'blog_addedby' => $pol_user_id,
  );
  $this->User_Model->update_info('blog_id', $blog_id, 'blog', $update_data);

  $this->session->set_flashdata('update_success','success');
  header('location:'.base_url().'User/blog_info_list');
}

$blog_info = $this->User_Model->get_blog_info($pol_company_id, $blog_id);
if($blog_info == ''){ header('location:'.base_url().'User/blog_info_list'); }
foreach($blog_info as $info_b){
  $data['update'] = 'update';
  $data['blog_category_id'] = $info_b->blog_category_id;
  $data['blog_category_name'] = $info_b->blog_category_name;
  $data['blog_info_name'] = $info_b->blog_info_name;
  $data['blog_details'] = $info_b->blog_details;
  $data['blog_status'] = $info_b->blog_status;
}
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
$this->load->view('User/blog_info',$data);
$this->load->view('Include/footer',$data);
}

public function delete_blog_info($blog_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->User_Model->delete_info('blog_id', $blog_id, 'blog');
$this->session->set_flashdata('delete_success','success');
header('location:'.base_url().'User/blog_info_list');
}

// public function business_listing_list(){
//       $this->load->view('Include/head');
//       $this->load->view('Include/navbar');
//       $this->load->view('User/business_listing_list');
//       $this->load->view('Include/footer');
// }
// public function business_listing_info(){
//   $this->load->view('Include/head');
//   $this->load->view('Include/navbar');
//  $this->load->view('User/business_listing_info');
//  $this->load->view('Include/footer');
// }

public function business_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $this->form_validation->set_rules('business_name', 'Advertisement Name', 'trim|required');
  $data['product_list'] = $this->User_Model->get_list($pol_company_id,'product_id','ASC','product');
  $data['business_list'] = $this->User_Model->get_list($pol_company_id,'business_id','ASC','business');
  $data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
  $data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
  if ($this->form_validation->run() != FALSE) {
    $business_status=$this->input->post('business_status');
    if(!isset($business_status)){ $business_status = 'active'; }
    $save_data = array(
      'company_id' => $pol_company_id,
      'business_category_id' => $this->input->post('business_category_id'),
      'business_name' => $this->input->post('business_name'),
      'business_address' => $this->input->post('business_address'),
      'business_mobile1' => $this->input->post('business_mobile1'),
      'business_mobile2' => $this->input->post('business_mobile2'),
      'business_email' => $this->input->post('business_email'),
      'business_website' => $this->input->post('business_website'),
      'working_hours' => $this->input->post('working_hours'),
      'working_days' => $this->input->post('working_days'),
      'business_status' => $business_status,
      'business_addedby' => $pol_user_id,
    );
    $business_id=$this->User_Model->save_data('business', $save_data);
    foreach($_POST['input'] as $user)
    {
      $user['business_id'] = $business_id;
      $this->db->insert('business_trans', $user);
    }
    if(isset($_FILES['package_img']['name'])){
       $time = time();
       $image_name = 'product_'.$business_id.'_'.$time;
       $config['upload_path'] = 'assets/images/product/';
       $config['allowed_types'] = 'png|jpg';
       $config['file_name'] = $image_name;
       $filename = $_FILES['package_img']['name'];
       $ext = pathinfo($filename, PATHINFO_EXTENSION);
       // $this->load->library('upload', $config);
       $this->upload->initialize($config);
       if ($this->upload->do_upload('package_img')){
         $up_image = array(
           'business_logo' => $image_name.'.'.$ext,
         );
         $this->User_Model->update_info('business_id', $business_id, 'business', $up_image);
       }
       else{
      echo   $error = $this->upload->display_errors();
         $this->session->set_flashdata('status',$this->upload->display_errors());
       }
     }
    $this->session->set_flashdata('save_success','success');
    header('location:'.base_url().'User/business_information_list');
  }
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
  $this->load->view('User/business_information',$data);
  $this->load->view('Include/footer',$data);
}

public function business_information_list(){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$data['business_list'] = $this->User_Model->get_list($pol_company_id,'business_id','ASC','business');
// $data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
$data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
  $this->load->view('User/business_information_list',$data);
  $this->load->view('Include/footer',$data);
}

public function edit_business_information($business_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->form_validation->set_rules('business_name', 'Advertisement Name', 'trim|required');
$data['business_list'] = $this->User_Model->get_list($pol_company_id,'business_id','ASC','business');
$data['business_trans_data'] = $this->User_Model->business_trans_data($business_id);
$data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
$data['product_list'] = $this->User_Model->get_list($pol_company_id,'product_id','ASC','product');
// $data['business_list'] = $this->User_Model->get_list($pol_company_id,'business_id','ASC','business');
// $data['b_category_list'] = $this->User_Model->get_list($pol_company_id,'business_category_id','ASC','business_category');
$data['p_category_list'] = $this->User_Model->get_list($pol_company_id,'product_category_id','ASC','product_category');
if ($this->form_validation->run() != FALSE) {
  $business_status=$this->input->post('business_status');
  if(!isset($business_status)){ $business_status = 'active'; }
  $update_data = array(
    'business_category_id' => $this->input->post('business_category_id'),
    'business_name' => $this->input->post('business_name'),
    'business_address' => $this->input->post('business_address'),
    'business_mobile1' => $this->input->post('business_mobile1'),
    'business_mobile2' => $this->input->post('business_mobile2'),
    'business_email' => $this->input->post('business_email'),
    'business_website' => $this->input->post('business_website'),
    'working_hours' => $this->input->post('working_hours'),
    'working_days' => $this->input->post('working_days'),
    'business_status' => $business_status,
    'business_addedby' => $pol_user_id,
  );
  $this->User_Model->update_info('business_id', $business_id, 'business', $update_data);
  foreach($_POST['input'] as $user)
        {
          if(isset($user['business_trans_id'])){
            $business_trans_id = $user['business_trans_id'];
            if(!isset($user['business_type'])){
              $this->User_Model->delete_info('business_trans_id', $business_trans_id, 'business_trans');
            }else{
                $this->User_Model->update_info('business_trans_id', $business_trans_id, 'business_trans', $user);
            }
          }
          else{
            $user['business_id'] = $business_id;
            $this->db->insert('business_trans', $user);
          }
        }
  if(isset($_FILES['package_img']['name'])){
     $time = time();
     $image_name = 'business_information_'.$business_id.'_'.$time;
     $config['upload_path'] = 'assets/images/product/';
     $config['allowed_types'] = 'png|jpg';
     $config['file_name'] = $image_name;
     $filename = $_FILES['package_img']['name'];
     $ext = pathinfo($filename, PATHINFO_EXTENSION);
     // $this->load->library('upload', $config);
     $this->upload->initialize($config);
     if ($this->upload->do_upload('package_img')){
       $up_image = array(
         'business_logo' => $image_name.'.'.$ext,
       );
       $this->User_Model->update_info('business_id', $business_id, 'business', $up_image);
     }
     else{
    echo   $error = $this->upload->display_errors();
       $this->session->set_flashdata('status',$this->upload->display_errors());
     }
   }
  $this->session->set_flashdata('update_success','success');
  header('location:'.base_url().'User/business_information_list');
}

$business_information_info = $this->User_Model->get_info('business_id', $business_id, 'business');
if($business_information_info == ''){ header('location:'.base_url().'User/user_information_list'); }
foreach($business_information_info as $info_b){
  $data['update'] = 'update';
  $data['business_category_id'] = $info_b->business_category_id;
  $data['business_name'] = $info_b->business_name;
  $data['business_address'] = $info_b->business_address;
  $data['business_mobile1'] = $info_b->business_mobile1;
  $data['business_mobile2'] = $info_b->business_mobile2;
  $data['business_email'] = $info_b->business_email;
  $data['business_website'] = $info_b->business_website;
  $data['working_hours'] = $info_b->working_hours;
  $data['working_days'] = $info_b->working_days;
  $data['business_status'] = $info_b->business_status;
}
$this->load->view('Include/head',$data);
$this->load->view('Include/navbar',$data);
$this->load->view('User/business_information',$data);
$this->load->view('Include/footer',$data);
}

public function delete_business_information($business_id){
$pol_user_id = $this->session->userdata('pol_user_id');
$pol_company_id = $this->session->userdata('pol_company_id');
$pol_roll_id = $this->session->userdata('pol_roll_id');
if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
$this->User_Model->delete_info('business_id', $business_id, 'business');
$this->session->set_flashdata('delete_success','success');
header('location:'.base_url().'User/business_information_list');
}

public function logout(){
  $this->session->sess_destroy();
  header('location:'.base_url().'User/login');
}

public function check_duplication(){
  $column_name = $this->input->post('column_name');
  $column_val = $this->input->post('column_val');
  $table_name = $this->input->post('table_name');
  $company_id = '';
  $cnt = $this->User_Model->check_dupli_num($company_id,$column_val,$column_name,$table_name);
  echo $cnt;
}


}
?>
