<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
          <h1 class="title">
		    <div class="ddark-title-sec">
            <?php echo $title; ?> <?php if ($rev) { ?><small>( <?php echo $rev; ?>번째 판 )</small><?php } ?>
			</div>
			<section class="ddark-btn">
				<div class="btn-group pull-right" role="group" aria-label="content-tools">
					  <a href="/xref/<?php echo urlencode($title); ?>" class="btn btn-white tools-btn">역링크</a>
					  <a href="/discuss/d/<?php echo urlencode($title); ?>" class="btn btn-white tools-btn">토론</a>
					  <a href="/history/<?php echo urlencode($title); ?>" class="btn btn-white tools-btn">역사</a>
					  <a href="/edit/<?php echo urlencode($title); ?>" class="btn btn-white tools-btn">편집</a>
					  <button type="button" class="btn btn-white tools-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
					  <div class="dropdown-menu dropdown-menu-right" role="menu">
						<a href="/move/<?php echo urlencode($title); ?>" class="dropdown-item"><i class="fa fa-arrow-circle-right"></i> 문서 이동</a> 
						<a href="/delete/<?php echo urlencode($title); ?>" class="dropdown-item"><i class="fa fa-times"></i> 삭제</a> 
					  </div>
				</div>
			</section>
          </h1>
		  <?php if ($this->input->get('redir')) { ?>
		  <div class="alert alert-secondary">
			'<a href="/w/<?php echo urlencode($this->input->get('redir')).'?noredir=1'; ?>"><?php echo $this->input->get('redir'); ?></a>' 에서 넘어옴
		  </div>
		  <?php } ?>
		  <?php if (isset($is_file) && $is_file == true) {?>
			<img src="/images/<?php echo $file_name; ?>"><hr>
		  <?php } ?>
          <?php print_r ($text); ?>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>