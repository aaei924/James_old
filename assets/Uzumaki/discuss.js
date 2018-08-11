$(document).ready(function(){
      $(window).scroll(function(){ //스크롤 이벤트


           var scrollHeight=$(window).scrollTop()+$(window).height(); 
           var documentHeight=$(document).height(); //$(document).height()는 스크롤의 전체 길이를 뜻합니다.
		   var count = 0;
   
           if(scrollHeight==documentHeight)
           {
                loadDiscuss(count);
				count++;
           }
     });
 });
function loadDiscuss(page){
    $.ajax({
		type: 'GET',
		data: "page="+page,
		success: function(html){
			$('.dwe-discuss').append(html);
		}
    });
}