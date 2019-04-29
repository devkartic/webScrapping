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
$urlC = array();

foreach ($html->find('a[class=link_overlay]') as $key => $link){
    $url[] = $urlP.'/'.$link->href;
}

foreach ($url as $key => $urlC){
    $curlC = curl_init();
    curl_setopt($curlC, CURLOPT_URL, $urlC);
    curl_setopt($curlC, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curlC, CURLOPT_RETURNTRANSFER, 1);

    $responseC = curl_exec($curlC);
    curl_close($curlC);
    $html->load($responseC);
//    $title[] = $html->find('h1[class=title]');
    foreach ($html->find('h1') as $lin){
        $title[] = $lin->plaintext;
    }
//    break;
}
echo '<pre>';
print_r($title);
//echo '<h3>Total Title : '.($key+1).'</h3>';
