<?php

/*

  Static functions for operations on strings.

  by Cieniu

 */

class StringHelper {

    static $plChars = ['ę','ó','ą','ś','ł','ż','ź','ć','ń','Ę','Ó','Ą','Ś','Ł','Ż'
                    ,'Ź','Ć','Ń'];

    static $noPlChars = ['e','o','a','s','l','z','z','c','n','E','O','A','S','L','Z'
                    ,'Z','C','N'];
    /*
      Removes polish characters, spaces, characters not allowed in the url and double dashes.
     */
    public static function forUrl($string) {
        $converted_string = str_replace(self::$plChars, self::$noPlChars, $string);
        $converted_string = preg_replace('@[\s!:;_\?=\\\+\*/%&#\'\[\]\(\)\.\,]+@', '-', $converted_string);
        $converted_string = preg_replace('@[\-]{3,}+@', '-', $converted_string);
        $converted_string = mb_strtolower($converted_string);
        $converted_string = trim($converted_string, '-');

        return $converted_string;
    }

    public static function forImageName($string) {

        $converted_string = str_replace(self::$pl_chars, self::$nopl_chars, $string);
        $converted_string = preg_replace('@[\s!:;_\?=\\\+\*/%&#\'\[\]\(\)\,]+@', '-', $converted_string);
        $converted_string = preg_replace('@[\-]{3,}+@', '-', $converted_string);
        $converted_string = mb_strtolower($converted_string);
        $converted_string = trim($converted_string, '-');

        return $converted_string;
    }

    /*
      Shorten the text and add "Read more" url.
     */

    public static function readMore($string, $chars = "300", $url = "#", $readmore = "Read more...") {
        $string = strip_tags($string);
        if (strlen($string) > $chars) {
            $stringCut = substr($string, 0, $chars);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a class="readmore" href="' . $url . '">' . $readmore . '</a>';
        }
        return $string;
    }

    public static function shortString($string, $chars = "300") {
        $string = strip_tags($string);
        if (strlen($string) > $chars) {
            $stringCut = substr($string, 0, $chars);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
        }
        return $string;
    }

    /*
    * Detect http in url and return working url.
    */
    public function hasHttp($url) {
        if (strpos($url, "http://") !== false || strpos($url, "https://") !== false) {
            return $url;
        } else {
            return "http://" . $url;
        }
    }

}

echo StringHelper::forUrl('zażółćgęśląjaźń---ąęąąśąćóóąąłęłął');