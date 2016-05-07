<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
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
      header("Location: write");
			exit(0);
    }
    else
    {
			if($this->checkForPost())
			{
				$email = mysql_real_escape_string($_POST['email']);
				$pass = mysql_real_escape_string($_POST['password']);
				$this->db->select("*");
				$this->db->from("users");
				$this->db->where("email",$email);
				$this->db->where("password",hash("md5",$pass));
				$this->db->limit(1);
				$result = $this->db->get();
				$result = $result->result_array();

				if(count($result) >= 1)
				{
					// start session
					// init a session
			    $newdata = array(
			                   'USER'  => $result[0]['name'],
			                   'EMAIL'     => $result[0]['email'],
			                   'LOGGED' => TRUE
			               );

			    $this->session->set_userdata($newdata);
					// redirect to write
					header("Location: write");
					exit(0);

				}
				else
				{
					// error
					$data['tags'] = $this->load->view('site/core/head/tags',"",true);
		  		$data['includes'] = $this->load->view('site/core/head/includes',"",true);
		  		$data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

		  		$viewData['head'] = $this->load->view('site/core/head/main',$data,true);

		  		$data['navbar'] = $this->load->view("site/core/statics/navbar","",true);
					$msgData['msg'] = "لقد قمت بإدخال معلومات خاطئة ، حاول مرة أخرى !";
					$msg['msg'] = $this->load->view("site/core/statics/error",$msgData,true);
		      $data['content'] = $this->load->view("site/users/login",$msg,true);
		  		$data['includes'] = $this->load->view("site/core/body/includes","",true);

		  		$viewData['body'] = $this->load->view("site/core/body/main",$data,true);


		  		$this->load->view('site/main',$viewData);
				}
			}
			else
			{
				$data['tags'] = $this->load->view('site/core/head/tags',"",true);
	  		$data['includes'] = $this->load->view('site/core/head/includes',"",true);
	  		$data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

	  		$viewData['head'] = $this->load->view('site/core/head/main',$data,true);

	  		$data['navbar'] = $this->load->view("site/core/statics/navbar","",true);
	      $data['content'] = $this->load->view("site/users/login","",true);
	  		$data['includes'] = $this->load->view("site/core/body/includes","",true);

	  		$viewData['body'] = $this->load->view("site/core/body/main",$data,true);


	  		$this->load->view('site/main',$viewData);
			}
    }

	}

	public function logout()
	{
		$this->status->logout();
		header("Location: index");
		exit(0);
	}

	private function checkForPost()
	{
		if(isset($_POST['email']) && isset($_POST['password']))
			return true;
		return false;
	}
}
