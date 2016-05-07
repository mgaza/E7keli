<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
    $this->load->database();
    $this->load->model("status");
    $this->load->library('session');
	}

	public function index()
	{
    if($this->checkPost())
    {
      $this->submit();
    }
    else
    {
      if($this->status->checkForLogin())
      {
        header("Location: profile");
        exit(0);
      }
      else
      {
        $data['tags'] = $this->load->view('site/core/head/tags',"",true);
    		$data['includes'] = $this->load->view('site/core/head/includes',"",true);
    		$data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

    		$viewData['head'] = $this->load->view('site/core/head/main',$data,true);

    		$data['navbar'] = $this->load->view("site/core/statics/navbar","",true);
        $data['content'] = $this->load->view("site/users/signup","",true);
    		$data['includes'] = $this->load->view("site/core/body/includes","",true);

    		$viewData['body'] = $this->load->view("site/core/body/main",$data,true);


    		$this->load->view('site/main',$viewData);
      }

    }

	}

  public function submit()
  {
    $name = mysql_real_escape_string($_POST['username']);
    $pass = mysql_real_escape_string($_POST['password']);
    $email = mysql_real_escape_string($_POST['email']);
    $data = array(
              'name' => $name,
              'email' => $email,
              'password' => hash("md5",$pass)
            );
    $this->db->insert("users",$data);
    // init a session
    $newdata = array(
                   'USER'  => $name,
                   'EMAIL'     => $email,
                   'LOGGED' => TRUE
               );

    $this->session->set_userdata($newdata);
		// redirect to write
		header("Location: write");
		exit(0);
  }

  private function checkPost()
  {
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']))
    {
      return true;
    }
    return false;
  }
}
