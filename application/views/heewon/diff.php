<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
          <h1 class="title">
            <?php echo $title; ?>
            <div class="btn-group pull-right" role="group" aria-label="content-tools">
                  <a href="/edit/<?php echo $otitle; ?>" class="bbtn btn-sm btn-outline-secondary">편집</a>
            </div>
          </h1>
		  <?php echo $diff; ?>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>