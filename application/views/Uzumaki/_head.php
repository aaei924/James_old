<!DOCTYPE html>
<html class="ddark">

<head>
  <title><?php echo $title; ?> | <?php echo wiki_name;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.ddark.kr/fa/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="/assets/<?php echo skin;?>/aa.min.css" type="text/css">
  <link rel="stylesheet" href="/assets/<?php echo skin;?>/custom.css" type="text/css">
  <link rel="stylesheet" href="/assets/<?php echo skin;?>/responsive.css" type="text/css">
  <link rel="stylesheet" href="/assets/<?php echo skin;?>/wiki.css" type="text/css">
  <link rel="stylesheet" href="https://cdn.ddark.kr/fonts/notosanskr/notosanskr.css" type="text/css">
  <?php if(isset($s_head)) {echo $s_head;} ?>
</head>

<body>
  <nav class="navbar navbar-expand-md bg-secondary navbar-dark">
    <div class="container padding-0">
      <a class="navbar-brand" href="/w/<?php echo urlencode(wiki_name.':대문'); ?>"><i class="fa fa-pencil"></i> <b><?php echo wiki_name;?></b></a>
      
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/RecentChanges"><i class="fa fa-refresh"></i><span class="hidden"> 최근 변경</span></a>
          </li>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <i class="fa fa-cog"></i><span class="hidden"> 기능</span>
			</a>
			<div class="dropdown-menu">
			  <a class="dropdown-item" href="#">Action</a>
			  <a class="dropdown-item" href="#">Another action</a>
			  <div class="dropdown-divider"></div>
			  <a class="dropdown-item" href="/a/license"><i class="fa fa-tag"></i> 라이선스</a>
			</div>
		  </li>
        </ul>
        <div class="navbar-user no-pc">
          <div class="btn-group" role="group">
				<button type="button" class="btn btn-secondary dropdown-toggle login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <span class="fa fa-user-circle"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-login">
				  <?php if (!$this->session->userdata('username')) { ?>
				  <a class="dropdown-item" href="/a/login">로그인</a>
				  <a class="dropdown-item" href="/a/register">회원가입</a>
				<?php } else { ?>
				  <a class="dropdown-item" href="/w/사용자:<?php echo $this->session->userdata('username') ?>"><?php echo $this->session->userdata('username') ?> 님</a>
				  <span class="dropdown-divider"></span>
				  <a class="dropdown-item" href="/a/logout">로그아웃</a>
				<?php } ?>
				</div>
			  </div>
        </div>
        <form method="get" action="/search/" class="form-inline navbar-form search-box-parent">
            <div class="input-group">
              <div class="input-group-append">
                <a href="/random" class="btn btn-nav-search btn-random"><i class="fa fa-random"></i></a>
              </div>
              <input type="text" name="q" class="form-control nav-search" placeholder="<?php echo wiki_name;?> 검색">
              <div class="input-group-append">
                <button type="submit" class="btn btn-nav-search"><i class="fa fa-search"></i></button>
              </div>
              <div class="input-group-append">
                <button type="submit" class="btn btn-nav-search"><i class="fa fa-eye"></i></button>
              </div>
            </div>
          </form>
          <div class="navbar-user no-mb">
			<div class="btn-group" role="group">
				<button type="button" class="btn btn-secondary dropdown-toggle login" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <span class="fa fa-user-circle"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-login">
				<?php if (!$this->session->userdata('username')) { ?>
				  <a class="dropdown-item" href="/a/login">로그인</a>
				  <a class="dropdown-item" href="/a/register">회원가입</a>
				<?php } else { ?>
				  <a class="dropdown-item" href="/w/사용자:<?php echo $this->session->userdata('username') ?>"><?php echo $this->session->userdata('username') ?> 님</a>
				  <span class="dropdown-divider"></span>
				  <a class="dropdown-item" href="/a/logout">로그아웃</a>
				<?php } ?>
				</div>
			 </div>
           </div>
    </div>
  </nav>
  <div class="wiki-div">
    <div class="wiki-wrapper">
      <div class="row">