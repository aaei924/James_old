        <div class="col-md-3">
            <div class="card rc-card">
                <div class="card-body rc-card-top">
                  <h4 class="card-title">최근 변경됨</h4>
                </div>
                <ul class="list-group list-group-flush recentchange rc-card-content">
                </ul>
                <div class="card-body rc-card-bottom">
                  <a href="/RecentChanges" class="btn btn-secondary btn-xs pull-right text-white">더보기</a>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-div">
      <footer class="footer-wrapper">
     		<p class="ddark-license">이 위키의 모든 내용은 <a href="<?php echo license_url; ?>"><?php echo license; ?></a> 라이선스가 적용됩니다. 기여하신 후에는 <b>기여를 취소하실 수 없습니다.</b></p>
        <p class="m-0">Copyright &copy; 2015-<?php echo date('Y'); ?> 도다 All rights reserved.<br>해당 스킨의 저작권은 도다에게 있습니다. 무단 사용을 금지합니다.</p>
      </footer>
  </div>
  <script src="https://cdn.ddark.kr/js/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.ddark.kr/js/popper.js/dist/umd/popper.min.js"></script>
  <script src="https://cdn.ddark.kr/bootstrap/bootstrap.min.js"></script>
  <script async  src="/assets/<?php echo skin;?>/pjax.js"></script>
  <script async  src="/assets/<?php echo skin;?>/ddark.js"></script>
  <script async src="/assets/<?php echo skin;?>/discuss.js"></script>
  <?php if(isset($s_foot)) {echo $s_foot;} ?>
</body>

</html>
