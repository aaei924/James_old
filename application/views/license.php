<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
          <h1 class="title">라이선스</h1>
		  <h2>DDark Wiki Engine <small>v<?php echo dwe_ver; ?></small></h2>
		  <div class="p-1">DDark Wiki Engine 의 메인 개발자들을 소개합니다.</div>
		  <ul class="mb-1">
			<li>정도현 (도다) - <span class="badge badge-secondary text-white p-1">프로젝트 담당자</span> <span class="badge badge-danger p-1">개발자</span></li>
			<li>강희원 (Heewon) - <span class="badge badge-danger p-1">개발자</span></li>
		  </ul>
	      <hr>
		  <h2>'<?php echo skin; ?>' 스킨 정보</h2>
		  <?php $this->load->view(skin."/".'_info'); ?>
		  <table class="wiki-table text-center">
			<tbody>
				<tr><td colspan="2"><p>'<?php echo skin; ?>' 스킨</p></td></tr>
				<tr><td><p>버전</p></td><td><?php echo dws_ver; ?></td></tr>
				<tr><td><p>개발자</p></td><td><?php if (dws_developer_url) { echo '<a href="'.dws_developer_url.'">'.dws_developer.'</a>'; } else { echo dws_developer; } ?></td></tr>
				<tr><td><p>관련 주소</p></td><td><a href="<?php echo dws_url; ?>"><?php echo dws_url; ?></a></td></tr>
				<?php if (dws_license) {?><tr><td><p>라이선스</p></td><td><?php if (dws_license_url) { echo '<a href="'.dws_license_url.'">'.dws_license.'</a>'; } else { echo dws_license; } ?></td></tr><?php } ?>
			</tbody>
		 </table>
		  <?php $this->load->view(skin."/".'license'); ?>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>