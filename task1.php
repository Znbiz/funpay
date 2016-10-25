<?php
/**
 * Порядок полей не выжен. Важно, чтобы поля разделялись <br />
 * Название полей не важно. Важно, чтобы у поля с суммой вокруг значения были буквы. Иначе если будет к примеру "Сумма 2323" (от сервера пришло ровно 2323 такое может быть, проверял). То нельзя будет отличить от поля "Пароль".
 * Поле "Кошелёк" и "Код" различаются как кошелёк может быть от 10 цифр, а код до 10
 * От пунктуации тут ничего не зависит
 * @param  [string] $str строка для парсинга
 * @return [array]  массив содержащий значение полей при успешном завершении работы. В случае ошибки возращает массив с полем "error"
 */
function smsParser ($str) {
	$list = explode('<br />', $str);
	// $str=preg_replace('/[а-яА-Я]/i','a',$str);
	
	
	if(count($list) >= 3) {
		for($x=0; $x<count($list); $x++) {
			$list[$x] = preg_replace('/[а-яА-Яa-zA-Z]/i','a',$list[$x]);
			$list[$x] = utf8_decode(strrev($list[$x]));
			// Получаем сумму. 
			if(preg_match("/^([\D]+a)/i", $list[$x])){
				$result['money'] = preg_replace('/(^([\D]*))/i', '', strrev(preg_replace('/(^([\D]*))/i','',$list[$x])));
			} else {
				$val = preg_replace('/(^([\D]*))/i', '', strrev(preg_replace('/(^([\D]*))/i','',$list[$x])));
				// Получаем кошелёк и код
				if(strlen($val) >= 10) {
					$result['purse'] = $val;
				} else {
					$result['pass'] = $val;
				}
				
			}
		}
		print $result['pass'];
		print '<br/>';
		print $result['purse'];print '<br/>';
		print $result['money'];
	} else {
		$result['error'] = 'error';
		print $result['error'];
	}
	return $result;
}
smsParser('Пароль: 6257<br />Спишется 123,62рd.<br />Перевод sdafна счет 410011410095358');
?>