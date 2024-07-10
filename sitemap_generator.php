<?php 
include('config.php');
date_default_timezone_set('Asia/Jakarta');
$appendVar = fopen('sitemap.xml','w');
fwrite($appendVar,'<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
$filename = "list.txt";
$lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    $date = date('d M Y H:i:s');
    $datetime = new DateTime($date);
    $dateNow = $datetime->format('c');
    $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = str_replace(basename($actual_link),'',$actual_link);
    $loc = '
    <url>
  <loc>'.$actual_link.'?'.$get.'='.htmlspecialchars(urlencode($line)).'</loc>
  <lastmod>'.$dateNow.'</lastmod>
  <priority>1.00</priority>
</url>';
    fwrite($appendVar,$loc);
}
fwrite($appendVar,"</urlset>");