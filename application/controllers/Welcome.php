<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	private $data = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Karyawan_model','Mkaryawan');
		$this->load->model('Komputer_model','Mkomputer');
		$this->load->model('Radio_model','Mradio');
		$this->load->model('Phone_model','Mphone');
		
		
	}

	public function index()
	{
		$this->data=[
			'karyawan'=>$this->Mkaryawan->countAll(),
			'komputer'=>$this->Mkomputer->countAll(),
			'radio'=>$this->Mradio->countAll(),
			'phone'=>$this->Mphone->countAll(),
		];
		$this->data['title']='Dashboard';
		$this->data['pages'] = 'pages_admin/home';
		$this->load->view('_partials/admin', $this->data);
		
	}

	function landpage(){
		$data['pages'] = 'home';
        $this->load->view('_partials/index', $data);
		
	}
}
