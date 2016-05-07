<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
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
      // do the uploading process
      $uploadedFiles = array();
      if(isset($_FILES['files']))
      {
          // upload File to Server
          $file_name = $_FILES['files']['name'];
          $file_size =$_FILES['files']['size'];
          $file_tmp =$_FILES['files']['tmp_name'];
          $file_type=$_FILES['files']['type'];
          $exts = explode(".", $file_name);
          $extention = $exts[count($exts)-1];

              $desired_dir='uploads';
              $new_file_name = "$desired_dir/".hash("md5",$file_name.time()).".".$extention;
              move_uploaded_file($file_tmp,$new_file_name);

              // upload data to server
              $default_title = $file_name;

              // insert in databse
              $data = array
                                (
                                  'name' => $default_title,
                                  'url' => $new_file_name,
                                  'removed' => 0
                                );
              $this->db->insert("upload",$data);

              // return result
              $fileProps = json_encode($data,true);
              $result = array(
                'html' => $fileProps,
                'js' => '',
                'error' => ''
              );
              echo json_encode($result,true);
      }
      else
      {
        echo "Nothing to Upload!";
      }
    }
    else
    {
      header("Location: login");
      exit(0);
    }
  }
}
