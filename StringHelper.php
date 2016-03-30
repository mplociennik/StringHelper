<?php
/*

Klasa do wykonywania operacji na stringach.

by Cieniu

*/
class StringHelper{

/*
Usuwa polskie znaki, spacje, znaki niedozwolone w url, podwójne myślniki.
*/
public static function forUrl($string)
	{

	$pl_chars = array('ę','ó','ą','ś','ł','ż','ź','ć','ń','Ę','Ó','Ą','Ś','Ł','Ż','Ź','Ć','Ń');
	$nopl_chars = array('e','o','a','s','l','z','z','c','n','E','O','A','S','L','Z','Z','C','N');
	
	$converted_string = str_replace($pl_chars, $nopl_chars, $string);
	
	$converted_string = preg_replace('@[\s!:;_\?=\\\+\*/%&#\'\[\]\(\)\.\,]+@', '-', $converted_string);
	$converted_string = preg_replace('@[\-]{3,}+@','-', $converted_string);
	$converted_string = mb_strtolower($converted_string);
	$converted_string = trim($converted_string, '-');

	return $converted_string;
	}
	
public static function forImageName($string)
	{

	$pl_chars = array('ę','ó','ą','ś','ł','ż','ź','ć','ń','Ę','Ó','Ą','Ś','Ł','Ż','Ź','Ć','Ń');
	$nopl_chars = array('e','o','a','s','l','z','z','c','n','E','O','A','S','L','Z','Z','C','N');
	
	$converted_string = str_replace($pl_chars, $nopl_chars, $string);
	
	$converted_string = preg_replace('@[\s!:;_\?=\\\+\*/%&#\'\[\]\(\)\,]+@', '-', $converted_string);
	$converted_string = preg_replace('@[\-]{3,}+@','-', $converted_string);
	$converted_string = mb_strtolower($converted_string);
	$converted_string = trim($converted_string, '-');

	return $converted_string;
	}
	
/*
Skraca tekst i dodaje url Czytaj więcej... 
*/
public static function readMore($string, $chars="300", $url="#", $readmore="Czytaj więcej...")
	{

	
	// strip tags to avoid breaking any html
	$string = strip_tags($string);

	if (strlen($string) > $chars) {

		// truncate string
		$stringCut = substr($string, 0, $chars);

		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a class="readmore" href="'.$url.'">'.$readmore.'</a>'; 
	}
	return $string;
	}
	
public static function shortString($string, $chars="300")
	{

	
	// strip tags to avoid breaking any html
	$string = strip_tags($string);

	if (strlen($string) > $chars) {

		// truncate string
		$stringCut = substr($string, 0, $chars);

		// make sure it ends in a word so assassinate doesn't become ass...
		$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
	}
	return $string;
	}
	
public function hasHttp($url){

	if(strpos($url, "http://") !== false || strpos($url, "https://") !== false){
	return $url;
	}else {
	return "http://".$url;
	}
}	

}
