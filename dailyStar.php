<?php

function getMatchedListNumber($content, $text){
    $pattern = "/<li ?.*>(.*)<\/li>/";
    preg_match_all($pattern, $content, $matches);
    $find = false;
    foreach ($matches[1] as $key=>$match) {
        if($match == $text){
            $find = $key+1;
            break;
        }
    }
    return $find;
}

$content = '<div class="results">
    <ul>
        <li>Result 1</li>
        <li>Result 2</li>
        <li>Result 3</li>
        <li>Result 4</li>
        <li>Result 5</li>
        <li>Result 6</li>
        <li>Result 7</li>
    </ul>';

$text = "Result 4";
echo getMatchedListNumber($content, $text);