<?php

function getTitle($url)
{
    // get html via url
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.71 Safari/537.36");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    curl_close($ch);

    // get title
    preg_match('/(?<=<title>).+(?=<\/title>)/iU', $html, $match);
    $title = empty($match[0]) ? 'Untitled' : $match[0];
    $title = trim($title);

    // convert title to utf-8 character encoding
    if ($title != 'Untitled') {
        preg_match('/(?<=charset\=).+(?=\")/iU', $html, $match);
        if (!empty($match[0])) {
            $charset = str_replace('"', '', $match[0]);
            $charset = str_replace("'", '', $charset);
            $charset = strtolower( trim($charset) );
            if ($charset != 'utf-8') {
                $title = iconv($charset, 'utf-8', $title);
            }
        }
    }

    return $title;
}


echo getTitle('');