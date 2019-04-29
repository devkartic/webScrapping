<?php
include 'simple_html_dom.php';
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, 'https://www.prothomalo.com/');
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);
curl_close($curl);

//echo $response;

$html = new simple_html_dom();
$homepage = file_get_contents('http://www.example.com/');


$html->load($response);

foreach ($html->find('h2[class=title_holder]') as $key => $link){
    echo $link->plaintext.'<br/>';
}
echo '<h3>Total Title : '.($key+1).'</h3>';