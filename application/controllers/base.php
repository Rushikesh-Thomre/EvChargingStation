<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class base extends CI_Controller {

	public function base(){
		$this->load->view('base/base');
	}

}