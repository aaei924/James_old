<!DOCTYPE html>
<html class="ddark">
   <head>
      <title><?php echo $title; ?> | <?php echo wiki_name;?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.ddark.kr/fa/4.7.0/css/font-awesome.min.css" type="text/css">
      <link rel="stylesheet" href="https://cdn.ddark.kr/fonts/notosanskr/notosanskr.css" type="text/css">
      <link rel="stylesheet" href="/assets/<?php echo skin;?>/bootstrap.min.css">
      <link rel="stylesheet" href="/assets/<?php echo skin;?>/ciel_wiki.css">
      <link rel="stylesheet" href="/assets/<?php echo skin;?>/wiki.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
      <script src="https://files.ddark.kr/js/jquery-3.3.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
	  <?php if(isset($s_head)) {echo $s_head;} ?>
   </head
   <body>
      <body>
         <div class="container">
         <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
               <div class="col-8 text-center"> <a class="blog-header-logo text-dark" href="/"><?php echo wiki_name;?></a> </div>
               <div class="col-4 d-flex justify-content-end align-items-center">
                  <a class="text-muted" href="#">
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3">
                        <circle cx="10.5" cy="10.5" r="7.5"></circle>
                        <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                     </svg>
                  </a>
                  <a class="btn btn-sm btn-outline-secondary" href="/A/login">로그인</a> 
               </div>
            </div>
         </header>
         <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between"> <a class="p-2 text-muted" href="/RecentChanges">최근 변경</a> <a class="p-2 text-muted" href="/RecentDiscuss">최근 토론</a> <a class="p-2 text-muted" href="#">게시판</a> <a class="p-2 text-muted" href="/a/license">라이센스</a> <a class="p-2 text-muted" href="/a/license">위키라이브</a></nav>
         </div>
