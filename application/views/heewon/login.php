<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
			<h1>로그인</h1>
			<form method="post">
			  <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
			  <div class="form-group">
				<label for="exampleInputEmail1">이메일 / 사용자 이름</label>
				<input type="text" class="form-control" name="username" placeholder="Username / E-Mail">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">비밀번호</label>
				<input type="password" class="form-control" name="passwd" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-primary btn-block btn-lg text-white">로그인</button>
				<a href="/A/register" class="btn btn-secondary btn-block btn-lg text-white">회원가입</a></a>
			</form>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>