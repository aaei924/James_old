<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class A extends MX_Controller {
	function __construct()
	{
     parent::__construct();
     $this->load->database();
		$this->load->library('session'); // Admin 전역에서 session 사용
		$this->load->driver('cache');
    }
   
   public function index()
	{
		// /wiki/ 로 들어왔을 경우, /w/로 보냄
		echo "<script>location.href='/w/".wiki_name.":대문';</script>";
	}
	
	public function rc_json() {
		$result = array();					
		$query = $this->db->query("SELECT text, date FROM `recentchange` WHERE date IN (SELECT max(date) FROM `recentchange` GROUP BY text) ORDER BY date DESC LIMIT 7");
		foreach ($query->result() as $row) {
			$result[] = array('text'=>$row->text, 'date'=> date("H:i",strtotime($row->date)));
		}
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}
	
	public function login()
	{
		if ($this->session->userdata('username') != '') {
            $user = $this->session->userdata('username');
			echo "<script type='text/javascript'>alert('이미 로그인 되어 있는듯?');location.href='/w/사용자:$user';</script>";
		}
        $username = $this->input->post('username', true);
        $password = $this->input->post('passwd', true);
		if ($username != "" && $password != "") {
               $this->db->select('*');
               $this->db->from('users');
               $this->db->where('email',$username);
               $this->db->or_where('username',$username);
               $query = $this->db->get();
               if ($query->num_rows() > 0) {
               foreach ($query->result() as $row) {
                    if ((strtolower($row->username) == strtolower($username) || strtolower($row->email) == strtolower($username))) {
                        //일단 이메일이나 닉네임은 일치

                        if(password_verify($password, $row->password)){
                            //비밀번호도 맞음
                            $newdata = array(
								'email' => $row->email,
                                'username' => $row->username,
                              //  'nickname' => $row->nickname,
                                'password' => $row->password,
								'roles' => $row->roles
                            );

                            $this->session->set_userdata($newdata);
                            echo "<script type='text/javascript'>alert('로그인 되었습니다.');location.href='/w/';</script>";
                 
						}
                        else{
                            //login failed
                            echo "<script type='text/javascript'>alert('비밀번호가 일치하지 않습니다!');</script>";
                        }
                    } else {
                        //login failed
                        echo "<script type='text/javascript'>alert('아이디 또는 이메일이 일치하지 않습니다!');</script>";
                    }
                }
                }else{
                    //login failed
                    echo "<script type='text/javascript'>alert('로그인하지 못했습니다!');</script>";
                }

        }
		$data['title'] = "로그인";
		$this->load->view(skin."/".'login', $data);
	}
	
	public function logout() {
		if ($this->session->userdata('username') != '') {
			$this->session->sess_destroy();
			echo "<script type='text/javascript'>alert('성공적으로 로그아웃 됬습니다..');location.href='/';</script>";
		} else {
			echo "<script type='text/javascript'>alert('로그인이 되지 않은 상태입니다. 실패하였습니다.');location.href='/';</script>";
		}
	}
	public function register()
    {
		$this->load->library('form_validation');
        $email = $this->input->post('email', true);
        $nickname = $this->input->post('username', true);
        $password = $this->input->post('pass', true);
        $password2 = $this->input->post('passvf', true);



        if ($nickname != "" && $password != "" && $password2 != "" && $email != "") {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('pass', 'Password', 'required|matches[passvf]|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('passvf', 'Password Confirmation', 'required');
            $this->form_validation->set_rules('username', 'Nickname', 'required');

            if ($this->form_validation->run() == TRUE)
            {
                    $pass_enc = password_hash($password, PASSWORD_BCRYPT);
                    if( $this->db->simple_query("INSERT INTO users(email, username, password,  roles) VALUES('$email','$nickname','$pass_enc', 'default')")){
                        echo "<script>alert(\"정상적으로 가입되셨습니다\");</script>";
                        echo "<script>location.href='/a/login';</script>";

                    } else {
                        echo "<script>alert(\"실패!\");</script>";
						$data['title'] = "회원가입";
                        $this->load->view(skin."/".'register', $data);
                    }
            }
            else
            {
				$data['title'] = "회원가입";
                echo "<script>alert(\"입력정보를 확인하세요\");</script>";
                $this->load->view(skin."/".'register', $data);
            }


        } else {
			$data['title'] = "회원가입";
            $this->load->view(skin."/".'register', $data);
        }
    }

	public function license() {
		$data['title'] = "라이선스";
		$this->load->view('license', $data);
	}
 }