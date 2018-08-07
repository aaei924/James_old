$(function() {
	function RecentCard() {
			var $ddarkRecentCard = $(".ddark .rc-card .list-group");
			$.ajax({
				url: "/a/rc_json",
				dataType: "json"
			}).done(function (doc) {
				$ddarkRecentCard.empty();
				[].map.call(doc, function (val) {
					$ddarkRecentCard.append(
						'<li class="list-group-item"><a href="/w/' + encodeURI(val.text) + '">' + val.text +
							"<span class='pull-right'>[" + val.date + "]</span></a></li>"
					);
				});
				setTimeout(5000);
			});
	}
	RecentCard();
	$(document).on('click', 'a', function(e){ // pjax라는 클래스를 가진 앵커태그가 클릭되면,
	$.pjax({
			url: $(this).attr('href'), // 앵커태그가 이동할 주소 추출
			fragment: 'article', // 위 주소를 받아와서 추출할 DOM
			container: 'article' // 위에서 추출한 DOM 내용을 넣을 대상
		});
		$('.dropdown-menu.show').removeClass('show');
		return false;
	});
});