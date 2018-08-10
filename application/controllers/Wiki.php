<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wiki extends MX_Controller {
	function __construct()
	{
        parent::__construct();
        $this->load->database();
		$this->load->library('session'); // Admin 전역에서 session 사용
		$this->load->library('namuMark');
		$this->load->driver('cache');
    }
	public function index()
	{
		// /wiki/ 로 들어왔을 경우, /w/로 보냄
		echo "<script>location.href='/w/".wiki_name.":대문';</script>";
	}

	public function view($name = false, $rev = false)
	{
		if (!$name) {
			echo "아니 왜 내용이 없어";
			exit();
		}


		$ename = urldecode($name);
		$nstemp = explode(":", $ename);
		$ns = $nstemp[0];
			
			if ($ns === '파일') {
						$ns1 = $nstemp[1];
				if (file_exists('./images/'.$ns1)) {
					$data['is_file'] = true;
					$data['file_name'] = $ns1;
				}
			}
				// 문서 보기 (page) (/w/문서명)
					$data['rev'] = $rev;
					if ($rev) {
						$rev = urldecode($rev);
						$query = $this->db->query("SELECT * FROM `revision` WHERE doc_name = \"$ename\" AND r_num = \"$rev\"");
					} else {
						$query = $this->db->query("SELECT * FROM `document` WHERE title = \"$ename\"");
					}
					$row = $query->row();
					if ($query->num_rows()>0) {
							if ($rev) {
								$data['title'] = $ename;
								$data['lmod'] = $row->date;
								$wPage = new RevisionWikiPage($ename,$rev);
							} else {
								$data['title'] = $row->title;
								$data['lmod'] = $row->last_modify;
								$wPage = new PlainWikiPage($ename);
							}
							$wEngine = new NamuMark($wPage);
							$wEngine->prefix = "/w";
							$text = $wEngine->toHtml();

							$data['text'] = $text;

						$this->load->view(skin.'/view', $data);
					} else {
						if ($rev) {
							$data['title'] =$ename;
							$data['text'] = "해당 문서가 존재하지 않습니다.<br><a href='/edit/".$name."'>새로 만들 수도 있어요!</a>";
						} else {
							$data['title'] =$ename;
							$data['text'] = "해당 문서가 존재하지 않습니다.<br><a href='/edit/".$name."'>새로 만들 수도 있어요!</a>";
						}
						$data['text'] = "해당 문서가 존재하지 않습니다.<br><a href='/edit/".$name."'>새로 만들 수도 있어요!</a>";
						$this->load->view(skin.'/view', $data);
					}
			}
	
	public function edit($name = false) {
		$ename = urldecode($name);

		$query = $this->db->query("SELECT * FROM `document` WHERE `title` = '$ename'");
		if ($query->num_rows()>0) {
			// 문서가 존재할 경우
			$row = $query->row();
			$data['text'] = $row->text;
			$data['title'] = $ename;
			$data['otitle'] = $ename;

			$text = $this->input->post("wtext");
			$desc = $this->input->post("desc");
			$iagree = $this->input->post("iagree");

			if($text && $iagree) {

				$query = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$ename' ORDER BY r_num DESC LIMIT 1");
				foreach ($query->result() as $row) {
					$revision = $row->r_num + 1;
					$old_text = $row->doc_text;
					$temp = mb_strlen($old_text, 'utf-8');
					$text1 = mb_strlen($text, 'utf-8');
					$hello = $temp - $text1;
					if (substr($hello, 0, 1) == '-') {
						$hello = '+'.abs($hello);
					} else {
						$hello = '-'.$hello;
					}
				}
				$str = strcmp($old_text, $text);
				if ($str == 0) {
					echo "<script type='text/javascript'>alert('이전 리비전과 내용이 동일합니다.');location.href='/edit/$ename';</script>";
					exit();
				} else {
					$data = array(
							'text' => $text,
					);
					$this->db->where('title', $ename);
					$this->db->update('document', $data);
					$this->db->where('title', $ename);
					$this->db->delete('back_link');
					preg_match_all('/\[\[(.*?)\]\]/',$text, $result);
					preg_match_all('/\#(.*?) (.*?)/',$text,$redirect);
					if(!empty($redirect[0][0])){
					$re_link= explode($redirect[0][0],$text);
					echo $re_link[1];
					$re_data = array(
					        'title' => $ename,
					         'link' => "#".$re_link[1]
					);
					$this->db->insert('back_link',$re_data);
					}
					$link=[];
					foreach($result[1] as $data){
						if(strpos($data, '|') !== false) {
						$data = strstr($data,'|',true);
						}
						array_push($link,$data);
					}
					$link = array_unique($link);
					foreach($link as $back){
					$back_data = array(
					         'title' => $ename,
					         'link' => $back
					);
					$this->db->insert('back_link',$back_data);
					}
					if ($this->session->userdata('username')) {
						$user = $this->session->userdata('username');
					} else {
						$user = $_SERVER['REMOTE_ADDR'];
					}
					$data = array(
							'doc_name' => $ename,
							'r_num' => $revision,
							'r_desc' => $desc,
							'doc_text' => $text,
							'change_int' => $hello,
							'user' => $user
					);

					$this->db->insert('revision', $data);
					// RecentChange 기록
					$data = array(
							'text' => $ename,
							'r_num' => $revision,
							'change_int' => $hello,
							'user' => $user
					);

					$this->db->insert('recentchange', $data);
					echo "<script type='text/javascript'>alert('수정되었습니다.');location.href='/w/$ename';</script>";
					exit();
				}
			}else {
				if(!$iagree && $text){
						echo "<script type='text/javascript'>alert('라이센스 동의하셈.');</script>";
						$data['text'] = $text;
				}
				$data['s_type'] = '';
				$this->load->view( skin.'/edit', $data);

			}


		} else {
			$data['title'] = $ename;
			$data['otitle'] = $ename;
			$text = $this->input->post("wtext");
			$desc = $this->input->post("desc");
			$iagree = $this->input->post("iagree");
			// 새문서 생성
			if($text && $iagree) {
					$text1 = mb_strlen($text, 'utf-8');
					$data = array(
							'title' => $ename,
							'text' => $text
					);

					$this->db->insert('document', $data);
					preg_match_all('/\[\[(.*?)\]\]/',$text, $result);
					preg_match_all('/\#(.*?) (.*?)/',$text,$redirect);
					if(!empty($redirect[0][0])){
					$re_link= explode($redirect[0][0],$text);
					echo $re_link[1];
					$re_data = array(
					        'title' => $ename,
					         'link' => "#".$re_link[1]
					);
					$this->db->insert('back_link',$re_data);
					}
					$link=[];
					foreach($result[1] as $data){
						if(strpos($data, '|') !== false) {
						$data = strstr($data,'|',true);
						}
						array_push($link,$data);
					}
					$link = array_unique($link);
					foreach($link as $back){
					$back_data = array(
					        'title' => $ename,
					         'link' => $back
					);
					$this->db->insert('back_link',$back_data);
					}
					if ($this->session->userdata('username')) {
						$user = $this->session->userdata('username');
					} else {
						$user = $_SERVER['REMOTE_ADDR'];
					}
					$data = array(
							'doc_name' => $ename,
							'r_num' => 1,
							'doc_text' => $text,
							'change_int' => '+'.$text1,
							'user' => $user
					);
					$this->db->insert('revision', $data);

					// Recent Change 기록
					$data = array(
							'text' => $ename,
							'r_num' => 1,
							'change_int' => '+'.$text1,
							'user' => $user
					);

					$this->db->insert('recentchange', $data);
					echo "<script type='text/javascript'>alert('문서가 등록되었습니다.');location.href='/w/$ename';</script>";
					exit();
			}else{
				$data['s_type'] = 'new';
				$this->load->view(skin.'/edit', $data);
			}
		}
	}

	public function history($name = false) {
		$ename = urldecode($name);
		$data['title'] = "' ".$ename." ' 문서 역사";
		$data['otitle'] = $ename;
		$data['query'] = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$ename' ORDER BY r_num DESC");
		$this->load->view(skin.'/history', $data);
	}

	public function raw($name = false, $rev = false) {
		$ename = urldecode($name);
		if ($rev) {
			$rev = urldecode($rev);
			$query = $this->db->query("SELECT * FROM `revision` WHERE doc_name = \"$ename\" AND r_num = \"$rev\"");
		} else {
			$query = $this->db->query("SELECT * FROM `document` WHERE title = \"$ename\"");
		}
		header("Content-Type: text/plain");
		foreach ($query->result() as $row) {
			if ($rev) {
				echo $row->doc_text;
			} else {
				echo $row->text;
			}
		}
	}

 public function delete($name = false) {
  $ename = urldecode($name);
  if (!empty($this->input->post())){
	  if ($ename == wiki_name.':대문') {
		  $data['title'] = "오류가 발생했습니다!";
		  $data['text'] = '대문은 삭제하실 수 없습니다!';
		  $this->load->view(skin.'/error', $data);
	  } else {
		  if ($this->input->post('desc')) {
			//삭제는 여기서 동작시키면 됩니다.
		  } else {
			  echo "<script type='text/javascript'>alert('문서를 삭제하는 이유를 적어주세요.');location.href='/delete/$name';</script>";
		  }

	  }
	 } else {
	      $data['title'] = "' ".$ename." ' 문서 삭제";
		  $data['otitle'] = $ename;
		  $this->load->view(skin.'/delete', $data);
	 }
 }

public function move($name = false) {
	if ($name == false) {
		$data['title'] = '문제 발생!';
		$data['text'] = '문서를 선택해주세요!';
		$this->load->view(skin.'/error', $data);
	} else {
		$etitle = urldecode($name);
		$query = $this->db->select('title')->where('title', $etitle)->get('document');
		if ($query->num_rows() > 0) {
			$data['title'] = '\''.$etitle.'\' 문서 이동';
			$data['otitle'] = $etitle;
			if ($this->input->post('move_title')) {
				$m_title = $this->input->post('move_title'); // 제목
				// ============= 이유 ====================================
				if ($this->input->post('move_desc')) {
					$m_desc = $etitle.' 에서 '.$m_title.' 으로 문서 제목 변경 / 이유:'.$this->input->post('move_desc');
				} else {
					$m_desc = $etitle.' 에서 '.$m_title.' 으로 문서 제목 변경';
				}
				// =================================================================
				if ($this->input->post('move_redirect'))
					$m_redirect = $this->input->post('move_redirect'); // 리다이렉트 여부
				// =============== 이동 처리 =====================================
				$data = array(
						'title' => $m_title
				);
				$this->db->where('title', $etitle)
						 ->update('document', $data);
				$data = array(
						'doc_name' => $m_title
				);
				$this->db->where('doc_name', $etitle)
						 ->update('revision', $data);
				// USERNAME
				if ($this->session->userdata('username')) {
					$user = $this->session->userdata('username');
				} else {
					$user = $_SERVER['REMOTE_ADDR'];
				}
				$query = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$m_title' ORDER BY r_num DESC LIMIT 1");
				foreach ($query->result() as $row) {
					$revision = $row->r_num + 1;
				} // 리비전 숫자 카운팅
				$data = array(
						'doc_name' => $m_title,
						'r_num' => $revision,
						'r_desc' => $m_desc,
						'change_int' => 0,
						'user' => $user
				);
				$this->db->insert('revision', $data);
				// ====================== 이동 처리 끝 ===============================
				// REDIRECT 처리
				if (isset($m_redirect) && $m_redirect == 'true') {
					// 문서 생성
					$data = array(
							'title' => $etitle,
							'text' => '#넘겨주기 '.$m_title
					);
					$this->db->insert('document', $data);
					// 문서 리비전 생성
					$data = array(
							'doc_name' => $etitle,
							'r_num' => 1,
							'r_desc' => $m_desc,
							'change_int' => 0,
							'user' => $user
					);
					$this->db->insert('revision', $data);
				}
				echo "<script type='text/javascript'>alert('처리되었습니다!');location.href='/w/$m_title';</script>";
			} else {
				$this->load->view(skin.'/move', $data);
			}
		} else {
			$data['title'] = '문제 발생!';
			$data['text'] = '해당 제목과 일치하는 문서가 존재하지 않습니다.';
			$this->load->view(skin.'/error', $data);
		}
	}
}

public function revert($name = false,$rev = false) {
  $ename = urldecode($name);
  $rev = urldecode($rev);
  	if(empty($rev)) {
		echo "<script type='text/javascript'>alert('리비전을 선택해주세요.');location.href='/history/$name';</script>";
		exit();
	}
  if (!empty($this->input->post())){

	  if ($this->input->post('desc')) {
		$rev = urldecode($rev);
		$query = $this->db->query("SELECT * FROM `revision` WHERE doc_name = \"$ename\" AND r_num = \"$rev\"");
		foreach ($query->result() as $row) {
		$text = $row->doc_text;
		}
		$desc = "#".$rev."판으로 되돌리기(".$this->input->post('desc').")";
				$query = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$ename' ORDER BY r_num DESC LIMIT 1");
				foreach ($query->result() as $row) {
					$revision = $row->r_num + 1;
					$old_text = $row->doc_text;
					$temp = mb_strlen($old_text, 'utf-8');
					$text1 = mb_strlen($text, 'utf-8');
					$hello = $temp - $text1;
					if (substr($hello, 0, 1) == '-') {
						$hello = '+'.abs($hello);
					} else {
						$hello = '-'.$hello;
					}
				}
				$str = strcmp($old_text, $text);
					$data = array(
							'text' => $text,
					);
					$this->db->where('title', $ename);
					$this->db->update('document', $data);
					$this->db->where('title', $ename);
					$this->db->delete('back_link');
					preg_match_all('/\[\[(.*?)\]\]/',$text, $result);
					preg_match_all('/\#(.*?) (.*?)/',$text,$redirect);
					if(!empty($redirect[0][0])){
					$re_link= explode($redirect[0][0],$text);
					echo $re_link[1];
					$re_data = array(
					        'title' => $ename,
					         'link' => "#".$re_link[1]
					);
					$this->db->insert('back_link',$re_data);
					}
					$link=[];
					foreach($result[1] as $data){
						if(strpos($data, '|') !== false) {
						$data = strstr($data,'|',true);
						}
						array_push($link,$data);
					}
					$link = array_unique($link);
					foreach($link as $back){
					$back_data = array(
					        'title' => $ename,
					         'link' => $back
					);
					$this->db->insert('back_link',$back_data);
					}
					if ($this->session->userdata('username')) {
						$user = $this->session->userdata('username');
					} else {
						$user = $_SERVER['REMOTE_ADDR'];
					}
					$data = array(
							'doc_name' => $ename,
							'r_num' => $revision,
							'r_desc' => $desc,
							'doc_text' => $text,
							'change_int' => $hello,
							'user' => $user
					);

					$this->db->insert('revision', $data);
					// RecentChange 기록
					$data = array(
							'text' => $ename,
							'r_num' => $revision,
							'change_int' => $hello,
							'user' => $user
					);

					$this->db->insert('recentchange', $data);
					echo "<script type='text/javascript'>alert('수정되었습니다.');location.href='/w/$ename';</script>";
					exit();

	  } else {
		  echo "<script type='text/javascript'>alert('문서를 되돌리는 이유를 적어주세요.');location.href='/delete/$name';</script>";
	  }

 }else{
$data['title'] = "' ".$ename." ' 문서 되돌리기";
	  $data['otitle'] = $ename;
	  $data['rev'] = $rev;
	  $this->load->view(skin."/".'revert', $data);
 }
 }
	public function diff($name = false) {
		$ename = urldecode($name);
		$data['title'] = "' ".$ename." ' 문서 리비전 비교";
		$data['otitle'] = $ename;
		$old = $this->input->get('old');
		$rev1 = $this->input->get('rev');
		$query = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$ename' AND `r_num` = '$old' LIMIT 1");
		foreach ($query->result() as $row) {
			$oldtext=$row->doc_text;
		}
		$query = $this->db->query("SELECT * FROM `revision` WHERE `doc_name` = '$ename' AND `r_num` = '$rev1' LIMIT 1");
		foreach ($query->result() as $row) {
			$revtext=$row->doc_text;
		}
		require_once './includes/Diff.php';
		$options = array(
			//'ignoreWhitespace' => true,
			//'ignoreCase' => true,
		);

		$diff = new Diff(explode("\n", $oldtext), explode("\n",$revtext), $options);
		require_once './includes/Diff/Renderer/Html/Inline.php';
		$renderer = new Diff_Renderer_Html_Inline;
		$data['diff'] = $diff->render($renderer);
		$this->load->view(skin.'/diff', $data);
	}

	public function discuss () {

	}
	public function xref($name = false){
		$data['title'] = "'".urldecode($name)."' 문서 역링크";
		$data['otitle'] = urldecode($name);
		$data['query1'] = $this->db->query("SELECT * FROM `back_link` WHERE `link` = '#".urldecode($name)."'");
		$data['query2'] = $this->db->query("SELECT * FROM `back_link` WHERE `link` = '".urldecode($name)."'");
		$this->load->view(skin.'/xref', $data);
	}
	public function random() {
		$query = $this->db->query("select * from `document` order by rand() limit 1 ;");
        $temp = $query->row()->title;
		echo '<script>window.location.href = "/w/'.$temp.'";</script>';
	}
	public function rc() {
		$data['title'] = "최근 변경내역";
		$data['query'] = $this->db->query("SELECT * FROM `recentchange` ORDER BY id DESC");
		$this->load->view(skin.'/recentchange', $data);
	}

	public function search() {
		$data['title'] = "검색";
		if ($this->input->get('q')) {
			$this->db->select('*');
			$this->db->from('document');
			$this->db->like('title', $this->input->get('q'));
			$data['query'] = $this->db->get();
		} else {
			$data['query'] = 'false';
		}
		$this->load->view(skin.'/search', $data);
	}
}

