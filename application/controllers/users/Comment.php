<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller
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
      $id = mysql_real_escape_string($_POST['id']);
      $content = mysql_real_escape_string($_POST['content']);
      $anonymous = mysql_real_escape_string($_POST['anonymous']);

      $data = array(
                      'article_id' => $id,
                      'content' => $content,
                      'anonymous' => ($anonymous == 0 ? 0 : 1)
                    );
      if($anonymous == 0)
      {
        $data['writer'] = $this->session->userdata("USER");
      }
      $this->db->insert("comments",$data);
      // return the data
      $html = json_encode($data);
      $array = array("html"=>$html,"js"=>'',"error"=>"");
      echo json_encode($array);
    }
  }
}
