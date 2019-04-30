<?php

function getMatchedListNumber($content, $tag='a'){
    $pattern = "/<$tag ?.*>(.*)<\/$tag>/";;
    preg_match($pattern, $content, $matches);
    return $matches;
}

$content = '<div class="results">
                <a href="#">I love BD</a>
                <div>Kartic Gharami</div>
                <a href="#">I love BD</a>
            </div>';

$result = getMatchedListNumber($content);

echo '<pre>';
print_r($result);