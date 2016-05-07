<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
	{
		parent::__construct();
    $this->load->database();
    $this->load->helper("url");
    $this->load->library('session');

    // model
    $this->load->model("status");
	}

  public function index()
  {
    if($this->status->checkForLogin())
    {
      if($this->status->checkForUpdate())
      {
        // save data
        $array = array();
        if(!isset($_POST['email']))
        {
          return;
        }

        if(isset($_POST['username']))
        {
          $array['name'] = mysql_real_escape_string($_POST['username']);
          $this->session->set_userdata("USER",$array['name']);
        }

        if(isset($_POST['password2']) && isset($_POST['password1']))
        {
          $this->db->select("*");
          $this->db->from("users");
          $this->db->where("password",hash("md5",$_POST['password1']));
          $this->db->where("email",$_POST['email']);
          $result = $this->db->get();
          $array = $result->result_array();
          if(count($array)==1)
          {
            $array['password'] = hash("md5",$_POST['password2']);
          }
        }

        $this->db->where("email",$_POST['email']);
        $this->db->update("users",$array);
        header("Refresh:0");
        exit(0);

      }
      else
      {
        // show profile
        $data['tags'] = $this->load->view('site/core/head/tags',"",true);
    		$data['includes'] = $this->load->view('site/core/head/includes',"",true);
    		$data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

    		$viewData['head'] = $this->load->view('site/core/head/main',$data,true);

        $navData['logged'] = true;
    		$data['navbar'] = $this->load->view("site/core/statics/navbar",$navData,true);
        $profileData['mail'] = $this->session->userdata("EMAIL");
        $profileData['username'] = $this->session->userdata("USER");

        $data['content'] = $this->load->view("site/users/profile",$profileData,true);
    		$data['includes'] = $this->load->view("site/core/body/includes","",true);

    		$viewData['body'] = $this->load->view("site/core/body/main",$data,true);


    		$this->load->view('site/main',$viewData);
      }
    }
    else
    {
      // return to login
      header("Location: login");
      exit(0);
    }
  }
}
