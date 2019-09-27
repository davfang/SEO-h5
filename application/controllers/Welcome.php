<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('pagination');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$url = "https://www.vfanghao.com/api/view/category";
		$menuList = https_request($url);
		$data['menuList'] = $menuList['data'];

		
		$category_id = $this->input->get('category_id')?$this->input->get('category_id'):9999;
		$data['category_id'] = $category_id;
		
		$pageId = $this->input->get('page')?$this->input->get('page'):1;
		$url = 'https://www.vfanghao.com/api/view/category/list?category_id='.$category_id.'&page='.$pageId.'&requireAd=0';
		$contentList =  https_request($url);
		$data['contentList'] = $contentList['data'];


		$config['base_url']  = $category_id != '9999'?site_url('?category_id='.$category_id):site_url();
		// $config['full_tag_open'] = '<div class="page" style="max-width:1200px;margin:15px auto;text-align:center;width:100%;box-sizing:border-box;">';
		// $config['full_tag_close'] = '</div>';

		$config['first_link'] = '首页';
		$config['last_link'] = '末页';
		$config['full_tag_open'] = '<ul class="pagination">';  
        $config['full_tag_close'] = '</ul>';  
        $config['first_tag_open'] = '<li>';  
        $config['first_tag_close'] = '</li>';  
        $config['prev_tag_open'] = '<li>';  
        $config['prev_tag_close'] = '</li>';  
        $config['next_tag_open'] = '<li>';  
        $config['next_tag_close'] = '</li>';  
        $config['cur_tag_open'] = '<li class="active"><a>';  
        $config['cur_tag_close'] = '</a></li>';  
        $config['last_tag_open'] = '<li>';  
        $config['last_tag_close'] = '</li>';  
        $config['num_tag_open'] = '<li>';  
		$config['num_tag_close'] = '</li>';  
		
		$config['num_links']=2;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $contentList['count'];
		$config['query_string_segment'] = 'page';
		$config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['page'] = $this->pagination->create_links();




		$this->load->view('welcome_message',$data);
	}
}
