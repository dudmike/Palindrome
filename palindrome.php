<?php
$input = $_GET['input'];

function palindromeReader($str)  {
	//Функция чтения элементов строки
	function strOpener($str,$i) {
		return mb_substr($str, $i, 1, 'UTF-8');
	};
	//Функция преобразования строки
	function toArr($str) {
		$lowStr = mb_strtolower($str, 'UTF-8');
		$newStr = '';
		//Преобразование строки до формата 'a-b-c'
		for($i=0; $i<mb_strlen($lowStr, 'UTF-8'); $i++) {
			if( strOpener($lowStr,$i) == ' ') {
				continue;
			} elseif($i== mb_strlen($lowStr, 'UTF-8') - 1) {
				$newStr .= strOpener($lowStr,$i);
			} else {
				$newStr .= strOpener($lowStr,$i) . '-';
			}	
		}
		$arrStr = explode('-', $newStr);
		return $arrStr;
	};

	//Функция проверки элементов массивов
	function checkArrs($arr1, $arr2) {
		$result = 1;
		for($i=0;$i<count($arr1); $i++) {
			if($arr1[$i] != $arr2[$i]) {
			 $result = 0;
			}
		}
		return $result;
	};
	//Функция поиска палиндромов
	function getPalindrome($arr) {		
		$arrInv = array_reverse($arr);
		if(checkArrs($arr, $arrInv) ) {
			$result = implode('', $arr);
			if(mb_strlen($result, 'UTF-8')>=3 ) {
				return $result;	
			}								
		}
	};
	
	//Функция сравнения строк палиндромов
	function compare($arr) {
		$res = $arr[0];
		for($i=1; $i<count($arr); $i++) {
			if(mb_strlen($res, 'UTF-8') >= mb_strlen($arr[$i], 'UTF-8') ) {
				continue;
			} else $res = $arr[$i];

		}
		return $res;
		
	};
	//Функция копирования элементов массива
	function arrCopy($arr) {
		$arrRes = array();
		for($i=0;$i<count($arr);$i++) {
			$arrRes[] = $arr[$i];
		}
		return $arrRes;
	};

	$arrStr = toArr($str);//Создание массивa из строки $str
	
	$arrStrInv = array_reverse($arrStr);
	$arrResult = array();//Массив с палиндромами
	
	$index = 1;//Индекс отсутствия полиндромов в строке
	
	//Если исходная строка является палиндромом, выводим полностью
	if(checkArrs($arrStr, $arrStrInv)) {
		return $str;
	} else { // Если строка $str не палендром то ищем самый длинный
		for($i=0; $i < count($arrStr); $i++ ) {
			$arrRl = arrCopy($arrStr);
			while(count($arrRl) > 3) {
				//$palindromeVar содержит палиндром или пустую строку
				$palindromeStr =  getPalindrome($arrRl);
				if($palindromeStr) {
					$arrResult[] = $palindromeStr;
				}
				array_pop($arrRl);
			}		
					
			array_shift($arrStr);
	
		}
		
	
		//Если нету палиндромов установить индекс
		if( count($arrResult)==0 ) {
			$index = 0;
		}
		// Если нету палиндромов выводим первый символ
		if($index == 0) { 
			return strOpener($str, 0);
		}
		
		return compare($arrResult);				

	} 
	
	
	
}

if(mb_strlen($input, 'UTF-8') >= 3 ) {
	echo palindromeReader($input);
}

?>