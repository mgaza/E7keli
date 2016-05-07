<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
    $this->load->database();
		$this->load->helper("url");
    $this->load->library('session');
		$this->load->model("status");
	}

  public function index($id)
  {
    $id = mysql_real_escape_string($id);
    $this->db->select("*");
    $this->db->from("articles");
    $this->db->where("id",$id);
    $this->db->limit(1);
    $result = $this->db->get();
    $array = $result->result_array();
    if(count($array[0])==0)
    {
      echo "Not Found !";
      exit(0);
    }

    $data['tags'] = $this->load->view('site/core/head/tags',"",true);
    $data['includes'] = $this->load->view('site/core/head/includes',"",true);
    $data['metadata'] = $this->load->view('site/core/head/metadata',"",true);

    $viewData['head'] = $this->load->view('site/core/head/main',$data,true);

		$navData = array();
		if($this->status->checkForLogin())
		{
			$navData['logged'] = true;
		}
    $data['navbar'] = $this->load->view("site/core/statics/navbar",$navData,true);
		$contentData['article'] = $array[0];
		$contentData['comments'] = $this->fetchComments($id);
		if($this->status->checkForLogin())
		{
			$contentData['logged'] = true;
		}
    $data['content'] = $this->load->view("site/article/article",$contentData,true);
    $data['includes'] = $this->load->view("site/core/body/includes","",true);

    $viewData['body'] = $this->load->view("site/core/body/main",$data,true);


    $this->load->view('site/main',$viewData);
  }

	private function fetchComments($id)
	{
		$this->db->select("*");
		$this->db->from("comments");
		$this->db->where('article_id',$id);
		$result = $this->db->get();
		$array = $result->result_array();
		return $array;
	}


}
