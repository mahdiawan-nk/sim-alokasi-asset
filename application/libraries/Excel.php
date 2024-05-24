<?php 


if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH.'third_party/PHPExcel/PHPExcel.php';

class Excel extends PHPExcel{

	public function __construct()
	{
		parent::__construct();
	}
}


/* End of file Excel.php and path \application\libraries\Excel.php */
