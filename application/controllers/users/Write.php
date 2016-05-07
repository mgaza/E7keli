<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller
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
    if($this->status->checkForLogin())
    {
      if($this->checkForPostData())
      {
        $title = isset($_POST['title']) ? mysql_real_escape_string($_POST['title']) : "";
        $content = isset($_POST['content']) ? mysql_real_escape_string($_POST['content']) : "";
        $img = isset($_POST['img']) ? mysql_real_escape_string($_POST['img']) : "";
        $anonymous = isset($_POST['anonymous']) ? $_POST['anonymous'] : "off";
				$data = array(
                        'title' => $title,
                        'content' => $content,
                        'img' => $img,
                        'anonymous' => (strcmp($anonymous,"on")==0 ? 1 : 0)
                      );
				if(strcmp($anonymous,"off")==0)
				{
					$data['username'] = $this->session->userdata("USER");
				}

        $this->db->insert("articles",$data);

        $data['tags'] = $this->load->view('site/core/head/tags',"",true);
        $data['includes'] = $this->load->view('site/core/head/includes',"",true);
        $data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

        $viewData['head'] = $this->load->view('site/core/head/main',$data,true);

				$navData['logged'] = true;
        $data['navbar'] = $this->load->view("site/core/statics/navbar",$navData,true);
				$link['link'] = 'article/'.$this->getLastId();
        $msg['msg'] = $this->load->view("site/core/statics/models",$link,true);
        $data['content'] = $this->load->view("site/users/write",$msg,true);
        $data['includes'] = $this->load->view("site/core/body/includes","",true);

        $viewData['body'] = $this->load->view("site/core/body/main",$data,true);


        $this->load->view('site/main',$viewData);
      }
      else
      {
        $data['tags'] = $this->load->view('site/core/head/tags',"",true);
        $data['includes'] = $this->load->view('site/core/head/includes',"",true);
        $data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

        $viewData['head'] = $this->load->view('site/core/head/main',$data,true);

				$navData['logged'] = true;
        $data['navbar'] = $this->load->view("site/core/statics/navbar",$navData,true);
        $data['content'] = $this->load->view("site/users/write","",true);
        $data['includes'] = $this->load->view("site/core/body/includes","",true);

        $viewData['body'] = $this->load->view("site/core/body/main",$data,true);


        $this->load->view('site/main',$viewData);
      }
    }
    else
    {
      header("Location: login");
      exit(0);
    }
  }

  private function checkForPostData()
  {
    if(isset($_POST['title']) && isset($_POST['content']))
    {
      return true;
    }
    return false;
  }

	private function getLastId()
	{
		$this->db->select("id")->from("articles")->limit(1)->order_by("id desc");
		$result = $this->db->get();
		$result = $result->result_array();
		return $result[0]['id'];
	}
}
