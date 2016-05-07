<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
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
		$contentData['articles'] = $this->fetch_last_articles();
		$data['content'] = $this->load->view("site/home/home",$contentData,true);
		$data['includes'] = $this->load->view("site/core/body/includes","",true);

		$viewData['body'] = $this->load->view("site/core/body/main",$data,true);


		$this->load->view('site/main',$viewData);
	}

	private function fetch_last_articles()
	{
		$this->db->select("*");
		$this->db->from("articles");
		$this->db->order_by("id desc");
		$result = $this->db->get();
		$array = $result->result_array();
		return $array;
	}
}
