<?php
function getURL ( $URL )
{
    $userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:43.0) Gecko/20100101 Firefox/43.0 SeaMonkey/2.40' ;

    $wwwURL    = explode( '/', $URL ) ;
    $wwwURL    = array_slice( $wwwURL, 0, 3 ) ;
    $wwwURL    = implode( '/', $wwwURL ) ;

// få fat i kildekoden til siden
    $ch = curl_init($URL);

    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_REFERER, $wwwURL);
    curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//     curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

    $wwwHTML = curl_exec($ch);
    $wwwInfo = curl_getinfo($ch) ;

    curl_close($ch);

// hiv kildekoden ind 
    $dom = new DOMDocument();
    $dom->loadHTML($wwwHTML);
if ( ! $dom ) {
    echo 'Error while parsing the HTML document';
    exit; }

    $xml = simplexml_import_dom($dom) ;
if ( ! $xml ) {
    echo 'Error while parsing the DOM document';
    exit; }

return $xml; }
?>
