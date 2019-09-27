<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
	public function __construct() {
		parent::__construct();
    }
	
	public function index()
	{
		$id = $this->input->get('id');
        $url = 'https://www.vfanghao.com/api/view/detail?view_id='.$id;
        $detail =  https_request($url);
		$data['detail'] = $detail['data'];
		$data['detail']['publish_time'] = date("Y-m-d", $data['detail']['publish_time']/1000+3600*8);
		$this->load->view('detail',$data);
	}
}
