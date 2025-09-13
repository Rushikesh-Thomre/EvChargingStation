<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class superadmin extends CI_Controller {

	public function dashboard(){
		$this->load->view('Superadmin/dashboard');
	}
	
	public function managestations(){
		$this->load->view('Superadmin/managestations');
	}
	public function chargerstatus(){
		$this->load->view('Superadmin/chargerstatus');
	}
public function softwareupdates(){
		$this->load->view('Superadmin/softwareupdates');
	}
	public function usermanagement(){
		$this->load->view('Superadmin/usermanagement');
	}
		public function authentication(){
		$this->load->view('Superadmin/authentication');
	}
	public function userdata(){
		$this->load->view('Superadmin/userdata');
	}
	public function realtimesessions(){
		$this->load->view('Superadmin/realtimesessions');
	}
		public function sessionhistory(){
		$this->load->view('Superadmin/sessionhistory');
	}
	public function powerusage(){
		$this->load->view('Superadmin/powerusage');
	}
	public function loadsharing(){
		$this->load->view('Superadmin/loadsharing');
	}
	public function systemalert(){
		$this->load->view('Superadmin/systemalert');
	}
	public function PaymentProcessing(){
		$this->load->view('Superadmin/PaymentProcessing');
	}
	public function revenuereport(){
		$this->load->view('Superadmin/revenuereport');
	}
	public function report(){
		$this->load->view('Superadmin/report');
	}
	public function generalsettings(){
		$this->load->view('Superadmin/generalsettings');
	}
	public function monetizationsettings(){
		$this->load->view('Superadmin/monetizationsettings');
	}
	public function login(){
		$this->load->view('Superadmin/login');
	}
}