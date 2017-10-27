<?php

function markText($keyword, $string) {
    $pattern = preg_quote($keyword);
    return preg_replace("/($pattern)/i", '<mark>$1</mark>', $string);
}

?>