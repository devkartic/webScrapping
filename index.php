<?php
include 'simple_html_dom.php';
$curlP = curl_init();
$urlP = 'https://www.prothomalo.com/';
curl_setopt($curlP, CURLOPT_URL, $urlP);
curl_setopt($curlP, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curlP, CURLOPT_RETURNTRANSFER, 1);

$responseP = curl_exec($curlP);
curl_close($curlP);

//echo $response;
$html = new simple_html_dom();

$html->load($responseP);
$title = array();
$url = array();

foreach ($html->find('a[class=link_overlay]') as $key => $link){
    $url[] = $urlP.'/'.$link->href;
}


foreach ($url as $key => $lin){
    $childHtml = file_get_contents($lin);
    $title[] = getMatchedListNumber($childHtml, 'h1');
    if($key>3) break;
}

echo '<pre>';
print_r($title);




function getMatchedListNumber($content, $tag='h1'){
    $pattern = "/<$tag ?.*>(.*)<\/$tag>/";;
    preg_match($pattern, $content, $matches);
    return $matches[0];
}


