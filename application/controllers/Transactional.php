<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactional extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // $this->load->model('Transaction_Model');
    $this->load->model('Transaction_Model');
  }

  // public function support_information(){
  //       $this->load->view('Include/head');
  //       $this->load->view('Include/navbar');
  //       $this->load->view('User/support_information');
  //       $this->load->view('Include/footer');
  // }

  public function support_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['support_list'] = $this->Transaction_Model->get_support_list($pol_company_id);
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
    $this->load->view('User/support_information',$data);
    $this->load->view('Include/footer',$data);
  }

  // public function post_information(){
  //       $this->load->view('Include/head');
  //       $this->load->view('Include/navbar');
  //       $this->load->view('User/post_information');
  //       $this->load->view('Include/footer');
  // }

  public function post_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['post_list'] = $this->Transaction_Model->get_post_list($pol_company_id);
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
    $this->load->view('User/post_information',$data);
    $this->load->view('Include/footer',$data);
  }

  // public function question_information(){
  //       $this->load->view('Include/head');
  //       $this->load->view('Include/navbar');
  //       $this->load->view('User/question_information');
  //       $this->load->view('Include/footer');
  // }

  public function question_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['question_list'] = $this->Transaction_Model->get_question_list($pol_company_id);
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
    $this->load->view('User/question_information',$data);
    $this->load->view('Include/footer',$data);
  }

  // public function app_user_information(){
  //       $this->load->view('Include/head');
  //       $this->load->view('Include/navbar');
  //       $this->load->view('User/app_user_information');
  //       $this->load->view('Include/footer');
  // }

  public function app_user_information(){
  $pol_user_id = $this->session->userdata('pol_user_id');
  $pol_company_id = $this->session->userdata('pol_company_id');
  $pol_roll_id = $this->session->userdata('pol_roll_id');
  if($pol_user_id == '' && $pol_company_id == ''){ header('location:'.base_url().'User'); }
  $data['app_user_list'] = $this->Transaction_Model->get_list($pol_company_id,'app_user_id','ASC','app_user');
  $this->load->view('Include/head',$data);
  $this->load->view('Include/navbar',$data);
    $this->load->view('User/app_user_information',$data);
    $this->load->view('Include/footer',$data);
  }

  public function change_query_status(){
    $support_id = $this->input->post('support_id');
    $data['support_reply'] = $this->input->post('reply');
    $data['support_status'] = $this->input->post('support_status');
    $this->Transaction_Model->update_info('support_id', $support_id, 'support', $data);
    if($message_id){
      echo 'success';
    } else{
      echo 'error';
    }
  }

  public function change_post_status(){
    $post_id = $this->input->post('post_id');
    $data['post_status'] = $this->input->post('post_status');
    $this->Transaction_Model->update_info('post_id', $post_id, 'post', $data);
    if($message_id){
      echo 'success';
    } else{
      echo 'error';
    }
  }

  public function change_question_status(){
    $question_id = $this->input->post('question_id');
    $data['question_status'] = $this->input->post('question_status');
    $this->Transaction_Model->update_info('question_id', $question_id, 'question', $data);
    if($message_id){
      echo 'success';
    } else{
      echo 'error';
    }
  }

  public function change_app_user_status(){
    $app_user_id = $this->input->post('app_user_id');
    $data['app_user_status'] = $this->input->post('app_user_status');
    $this->Transaction_Model->update_info('app_user_id', $app_user_id, 'app_user', $data);
    if($message_id){
      echo 'success';
    } else{
      echo 'error';
    }
  }



}
