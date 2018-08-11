<?php $this->load->view(skin."/".'_head'); ?>
       
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
<div class="col-md-6 px-0"> 
<h1 class="display-6">알림</h1> <p class="lead my-3">매우 쓰레기요...</p></p> <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p> </div> </div>
<main role="main" class="container">
 <div class="row">
        <article class="col-md-7 blog-main">
<div class="blog-post">
          <h1 class="blog-post-title">
            <?php echo $title; ?> <?php if ($rev) { ?><small>( <?php echo $rev; ?>번째 판 )</small><?php } ?>
            <div class="btn-group pull-right" role="group" aria-label="content-tools">
            <a href="/edit/<?php echo urlencode($title); ?>" class="btn btn-sm btn-outline-secondary">편집</a>
            <a href="/discuss/d/<?php echo urlencode($title); ?>" class="btn btn-sm btn-outline-secondary">토론</a>
				  <a href="/history/<?php echo urlencode($title); ?>" class="btn btn-sm btn-outline-secondary">역사</a>
				 <a href="/xref/<?php echo urlencode($title); ?>" class="btn btn-sm btn-outline-secondary">역링크</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="/delete/<?php echo urlencode($title); ?>" class="dropdown-item btn btn-sm btn-outline-secondary">삭제</a> 
                </div>
            </div>
          </h1>
          <h4><?php if ($redir) {echo $redir."에서 넘어옴";}?></h4>
          <?php print_r ($text); ?>
</div>
        </article>

<?php $this->load->view(skin."/".'_bottom'); ?>