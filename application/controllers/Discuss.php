<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discuss extends MX_Controller {
	function __construct()
	{
     parent::__construct();
     $this->load->database();
		$this->load->library('session'); // Admin 전역에서 session 사용
		$this->load->driver('cache');
    }

	public function index() {
		$data['title'] = '문제 발생!';
		$data['text'] = '정상적인 접근 경로가 아닙니다.';
		$this->load->view(skin.'/error', $data);
	}
	public function d($title = false) {
		$title = urldecode($title);
		if ($this->input->post('title', true) && $this->input->post('text', true)) {
			$ptitle = $this->input->post('title', true);
			$ptext = $this->input->post('text', true);
			$user = '';
			if(!$this->session->userdata('username')){
				$user = $_SERVER['REMOTE_ADDR'];
			}else{
				$user = $this->session->userdata('username');
			}

			$this->db->simple_query("INSERT INTO discuss_list(doc_name, title, user, acl, status) VALUES('$title','$ptitle','$user', 'default', 'active')");
			echo '꺄우우 POST값들어온거에요';
		}
		$data['title'] = '토론';
		$data['otitle'] = $title;
			$data['query_active'] = $this->db->select('*')->where('status', 'active')->where('doc_name', $title)->get('discuss_list');
			$data['query_close'] = $this->db->select('*')->where('status', 'close')->where('doc_name', $title)->get('discuss_list');
			$this->load->view(skin.'/discuss_list', $data);
	}


	public function v($id = false) {
		if ($this->input->post('text', true)) {
			$ptext = $this->input->post('text', true);

			$user = '';
			if(!$this->session->userdata('username')){
				$user = $_SERVER['REMOTE_ADDR'];
			}else{
				$user = $this->session->userdata('username');
			}

			$aaa = $this->db->select('*')->where('discuss_id', $id)->order_by('v_id', 'desc')->limit(1)->get('discuss_content');
			if($aaa->num_rows() > 0){
				foreach ($aaa->result() as $row) { // 7 5.1.2.3.4.7.6			
					$num = $row->v_id + 1;
					$this->db->simple_query("INSERT INTO discuss_content(v_id, type, discuss_id, text, status, user) 
					VALUES('$num','', '$id','$ptext', 'default', '$user')");
				}
			} else {
					$this->db->simple_query("INSERT INTO discuss_content(v_id, type, discuss_id, text, status, user) 
					VALUES('1','', '$id','$ptext', 'default', '$user')");
			}
		}


		$data['title'] = '토론';
		$query = $this->db->select('*')->where('id', $id)->limit(1)->get('discuss_list');
		foreach ($query->result() as $row) {
			$data['otitle'] = $row->doc_name;
			$data['dis_title'] = $row->title;
		}
		$id = urldecode($id);
		$data['oid'] = $id;
			$data['query'] = $this->db->select('*')->where('discuss_id', $id)->limit(10, 0)->get('discuss_content');
			$this->load->view(skin.'/discuss_view', $data);



		
	}


	public function load($id = false, $page = false) {
		if ($page) {
			$page = $page ? intval($page) : 1;
			$offset = ($page - 1)  * 10;
			$data['query'] = $this->db->select('*')->where('discuss_id', $id)->limit(10, $offset)->get('discuss_content');
			$this->load->view(skin.'/discuss_block', $data);
		}
	}
}