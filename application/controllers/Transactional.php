<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactional extends CI_Controller{

  public function support_information(){
        $this->load->view('Include/head');
        $this->load->view('Include/navbar');
        $this->load->view('User/support_information');
        $this->load->view('Include/footer');
  }

  public function post_information(){
        $this->load->view('Include/head');
        $this->load->view('Include/navbar');
        $this->load->view('User/post_information');
        $this->load->view('Include/footer');
  }

  public function question_information(){
        $this->load->view('Include/head');
        $this->load->view('Include/navbar');
        $this->load->view('User/question_information');
        $this->load->view('Include/footer');
  }

  public function app_user_information(){
        $this->load->view('Include/head');
        $this->load->view('Include/navbar');
        $this->load->view('User/app_user_information');
        $this->load->view('Include/footer');
  }



}
