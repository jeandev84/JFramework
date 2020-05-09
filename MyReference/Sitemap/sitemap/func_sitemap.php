<?php 
header("Content-Type: application/xml; charset=utf-8"); 
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' .PHP_EOL; 
 
function urlElement($url) {
echo '<url>'.PHP_EOL; 
echo '<loc>'.$url.'</loc>'. PHP_EOL; 
echo '<changefreq>weekly</changefreq>'.PHP_EOL; 
echo '</url>'.PHP_EOL;
} 
 
urlElement('http://www.afterhoursprogramming.com/services/default-text-generator/'); 
urlElement('http://www.afterhoursprogramming.com/tests/practice/'); 
urlElement('http://www.afterhoursprogramming.com/tests/practice/HTML/'); 
echo '</urlset>'; 
?>