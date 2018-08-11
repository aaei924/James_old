<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
          <h1 class="title">
            <?php echo $title; ?>
          </h1>
          <table class="table">
			  <thead>
				<tr>
				  <th scope="col">판</th>
				  <th scope="col">문서</th>
				  <th scope="col">기여자</th>
				  <th scope="col">날짜</th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$i = 0; foreach ($query->result() as $row) { $i++ ?>
				<tr>
				  <td class="b"><?php echo $i ?></td>
				  <td>
						<a href="/discuss/v/<?php echo $row->id; ?>" class="text-black"><?php echo $row->title ?>( <?php echo $row->doc_name;?> )</a>
						<div class="btn-group pull-right" role="group" aria-label="content-tools">
				</div>
				  </td>
				  <td><?php echo $row->user ?></td>
				  <td><?php echo $row->date ?></td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>