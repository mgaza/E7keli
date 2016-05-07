<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller
{
  public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
    $this->load->database();
    $this->load->model("status");
    $this->load->library('session');
	}

  public function index($uprate,$id)
  {
    if($this->status->checkForLogin())
    {
      // we gonna rate the article
      if($uprate == 1)
      {
        $query = "UPDATE `articles` SET `up_rate`=`up_rate`+1 WHERE id=".(mysql_real_escape_string($id));
        $result = $this->db->query($query);
        $this->db->select("*");
        $this->db->from("articles");
        $this->db->where("id",$id);
        $result = $this->db->get();
        $array = $result->result_array();
        $returned = array("html"=>$array[0]['up_rate'],"js"=>"","error"=>"");
        echo json_encode($returned);
      }
      else
      {
        $query = "UPDATE `articles` SET `down_rate`=`down_rate`+1 WHERE id=".(mysql_real_escape_string($id));
        $result = $this->db->query($query);
        $result = $this->db->query($query);
        $this->db->select("*");
        $this->db->from("articles");
        $this->db->where("id",$id);
        $result = $this->db->get();
        $array = $result->result_array();
        $returned = array("html"=>$array[0]['down_rate'],"js"=>"","error"=>"");
        echo json_encode($returned);
      }

    }
    else
    {
      $result = array("html"=>"","js"=>"","error");
      echo json_encode($result);
    }
  }
}
