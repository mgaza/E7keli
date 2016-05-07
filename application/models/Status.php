<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

  }

  public function checkForLogin()
  {
    $data = $this->session->all_userdata();
    if(count($data)==0)
      return false;

    if(!$this->session->userdata("LOGGED"))
      return false;

    return true;
  }

  public function logout()
  {
    $this->session->unset_userdata('EMAIL');
    $this->session->unset_userdata('USER');
    $this->session->unset_userdata('LOGGED');
  }

  public function checkForUpdate()
  {
    if(isset($_POST['username']) || isset($_POST['password']) || isset($_POST['password2']) || isset($_POST['email']))
      return true;
    return false;
  }
}
