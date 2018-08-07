<?php defined('BASEPATH') OR exit('No direct script access allowed');
	private function tocInsert(&$arr, $text, $level, $path = '') {
		if(empty($arr[0])) {
			$arr[0] = array('name' => $text, 'level' => $level, 'childNodes' => array());
			return $path.'1';
		}

		$last = count($arr)-1;
		$readableId = $last+1;
		if($arr[0]['level'] >= $level) {
			$arr[] = array('name' => $text, 'level' => $level, 'childNodes' => array());
			return $path.($readableId+1);
		}
		
		return $this->tocInsert($arr[$last]['childNodes'], $text, $level, $path.$readableId.'.');
	}
function parser_convert($text){
	
	preg_match('/^(=+)(.*?)(=+)[ ]*$/', $text, $match);					
	
	$i = strlen($match[1]);


	$result .= '<h'.$i.' id="s-'.$id.'"><a name="s-'.$id.'" href="#toc">'.$id.'</a>. '.$march[2].'</h'.$i.'>';

	return $match[2]; //== 이걸 새서 보내주는거?== 문단 == 이게 한 문단이야 저렇게 나옴 === 문단 === 이건? 그건 하위 문단  id 는 뭘 출력해줘야함 번호 = 문단 = (1.  ㅁㄴㅇㅁㅇ) == 문단 == (1-2. ㅁㄴㅇㅁㄴㅇ) 아 ㅇㅋ 1-2는 어떻게 하지 ㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋㅋ
}