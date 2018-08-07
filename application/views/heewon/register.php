<?php $this->load->view(skin."/".'_head'); ?>
        <article class="col-md-9 bg-white">
			<h1>회원가입</h1>
			<form method="post">
			  <input type="hidden" id="<?= $this->security->get_csrf_token_name() ?>" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
			  <div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label text-center">이메일</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" name="email" placeholder="이메일...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label text-center">사용자 이름 </label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="username" placeholder="사용자 이름...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label text-center">비밀번호</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="pass" placeholder="비밀번호...">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label text-center">비밀번호 재확인</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="passvf" placeholder="비밀번호 재확인...">
				</div>
			  </div>
			  <div class="form-group row">
				<div class="col-sm-12">
				  <button type="submit" class="btn btn-primary btn-lg text-white btn-block">회원가입</button>
				</div>
			  </div>
			</form>
        </article>
<?php $this->load->view(skin."/".'_bottom'); ?>