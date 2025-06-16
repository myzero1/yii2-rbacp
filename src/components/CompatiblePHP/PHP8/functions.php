<?php
namespace myzero1\rbacp\components\CompatiblePHP\PHP8;

// use function \myzero1\rbacp\components\CompatiblePHP\PHP8\{strlen,trim,ltrim,rtrim,strpos,str_replace,implode,htmlspecialchars};

function strlen($string) {
    $string=(string)$string;
    return \strlen($string);
}
function trim($string, string $characters = " \n\r\t\v\0") {
    $string=(string)$string;
    return \trim($string,$characters);
}
function ltrim($string, string $characters = " \n\r\t\v\0") {
    $string=(string)$string;
    return \ltrim($string,$characters);
}
function rtrim($string, string $characters = " \n\r\t\v\0") {
    $string=(string)$string;
    return \rtrim($string,$characters);
}
function strpos( $haystack,  $needle, int $offset = 0) {
    $haystack=(string)$haystack;
    $needle=(string)$needle;
    return \strpos($haystack,$needle,$offset);
}
function str_replace( $search,$replace,$subject) {
    if (!in_array(gettype($search),['array','string '])) {
        $search=(string)$search;
    }
    if (!in_array(gettype($replace),['array','string '])) {
        $replace=(string)$replace;
    }
    if (!in_array(gettype($subject),['array','string '])) {
        $subject=(string)$subject;
    }

    return \str_replace($search,$replace,$subject);
}

function implode($separator, $array) {
    if(is_array($separator)){
        return \implode($array,$separator);
    } else {
        return \implode($separator,$array);
    }

}

function htmlspecialchars($separator, $array) {
    $separator=(string)$separator;
    return \htmlspecialchars($separator, $array);
}