<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function __construct() {
		parent::__construct();
    }
	
	public function index()
	{
		
		$this->load->view('search');
	}
	public function articlesearch() 
	{
		$postJson = json_decode($this->input->raw_input_stream,true);
		$data = array(
			'key' => $postJson['key'],
		);
		$res = json_request('https://www.vfanghao.com/api/view/articlesearch',$data,1);
		header('Content-Type:application/json');//这个类型声明非常关键
		exit(json_encode($res));
	}
}
