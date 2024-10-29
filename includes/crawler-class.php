<?php
/*
 * @credits: http://www.cult-f.net/detect-crawlers-with-php/
 * 
 *  */
function crawlerDetect($USER_AGENT) {
$crawlers_agents = 'Google|GoogleBot|Googlebot|msnbot|facebookexternalhit|FacebookExternalHit|Rambler|Yahoo|AbachoBOT|accoona|AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
$crawlers = explode('|', $crawlers_agents);
foreach($crawlers as $crawler) {
if ( strpos($USER_AGENT, $crawler) !== false)

return $crawler;
}
return false;
}
// example

$crawler = crawlerDetect($user_agent);
