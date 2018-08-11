<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
          <h1 class="title">
            <?php echo $otitle; ?> <small>( 문서 삭제 )</small>
            <div class="btn-group pull-right" role="group" aria-label="content-tools">
                  <a href="/w/<?php echo urlencode($otitle); ?>" class="btn btn-sm btn-outline-secondary">돌아가기</a> 
            </div>
          </h1>
		  <form method="post">
			  <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
			  <div class="py-1">
			  <label>삭제 이유 : </label>
			  <input type="text" name="desc" class="form-control">
			  </div>
			  <button type="submit" class="btn btn-secondary btn-lg pull-right"><i class="fa fa-thumbs-up"></i> 전송!</button>
		  </form>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>