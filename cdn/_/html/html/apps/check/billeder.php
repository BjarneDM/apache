<?php

/*
 *  du skal have disse linier i din httpd.conf

# tjek adgang til billeder
RewriteCond "%{REQUEST_URI}" "\.(jpg|jpeg)$"
RewriteRule "^/(.*)"  "${ROOT}/cdn/html/html/apps/check/billeder.php?billede=$1" [L]

 *  det gør det muligt at lave adgangs-tjek på billeder 
 *  på basis af en blacklisting af domæner
 */

error_reporting(0) ;
// Report all PHP errors 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$blacklist = [] ;
$blacklist[ 'sub_domain.domain.tld'] = 'folder' ; // primære sub_domian
$blacklist[       'test.domain.tld'] = 'server' ;

if ( in_array( $_SERVER['HTTP_HOST'] , array_keys( $blacklist ) ) )
{
    require_once( 'includes/setSessionStart.incl' ) ;
    require_once( 'includes/modIncludePath.incl' ) ;
    switch ( $blacklist[ $_SERVER['HTTP_HOST'] ] )
    {
        case 'folder' :
            //  https://sub_domain.domain.tld/thisDomain/
            $thisDomain = explode( '/' , $_SERVER['SCRIPT_URI'] )[3] ;
            break ;
        case 'server' :
            $thisDomain = $_SERVER['sub_domain'] ;
            break ;
    }
    require_once( 'includes/no_hacking.incl' ) ;
}

$imgFile   = [] ;
$imgFile[] = $_SERVER['docroot'] ;
$imgFile[] = $_SERVER['sub_domain'] ;
$imgFile[] = 'html' ;
$imgFile[] = $_GET['billede'] ;

$image = new Imagick( implode( DIRECTORY_SEPARATOR , $imgFile ) ) ;
// echo '<pre>' . 
//     print_r( $_GET , true ) . 
//     print_r( $_SERVER, true ) . 
//     print_r( $imgFile , true ) . 
//     print_r( $image->getImageProperties() , true ) . 
//     '</pre>' ;

header('Content-type: image/jpeg') ;
echo $image;
?>
