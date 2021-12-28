<?php
/**
 * @package Last.fm 3×3 Album Art Image Grid for WordPress
 * @version 1.0.1
 */
 
/*
Plugin Name: Last.fm 3×3 Album Art Image Grid for WordPress
Plugin URI: https://collinsasse.com/wordpress-plugins/last-fm-3x3-album-art-image-grid-for-wordpress/
Description: Create a 3x3 grid of album art from your Last.fm recent artists.
Author: Collin Sasse
Version: 1.0.1
Requires at least: 5.2
Update URI: https://collinsasse.com/wordpress-plugins/last-fm-3x3-album-art-image-grid-for-wordpress/
Author URI: https://collinsasse.com/wordpress-plugins/last-fm-3x3-album-art-image-grid-for-wordpress/
*/

function cs_lastfm_3x3_grid( $atts = [], $content = null ) { 
$atts = array_change_key_case( (array) $atts, CASE_LOWER );

$LastFM_Username = $atts['username'];
$LastFM_API_Key = $atts['key'];
$imagesize = $atts['size'];
$period = $atts['period'];

$url = "http://ws.audioscrobbler.com/2.0/?method=user.gettopalbums&user=$LastFM_Username&api_key=$LastFM_API_Key&format=json&period=$period&limit=9";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($curl);
curl_close($curl);
$datain = json_decode($resp, true);

if ($imagesize == "small") {
$image0 = $datain['topalbums']['album']['0']['image']['1']['#text'];
$image1 = $datain['topalbums']['album']['1']['image']['1']['#text'];
$image2 = $datain['topalbums']['album']['2']['image']['1']['#text'];
$image3 = $datain['topalbums']['album']['3']['image']['1']['#text'];
$image4 = $datain['topalbums']['album']['4']['image']['1']['#text'];
$image5 = $datain['topalbums']['album']['5']['image']['1']['#text'];
$image6 = $datain['topalbums']['album']['6']['image']['1']['#text'];
$image7 = $datain['topalbums']['album']['7']['image']['1']['#text'];
$image8 = $datain['topalbums']['album']['8']['image']['1']['#text'];
}

if ($imagesize == "medium") {
$image0 = $datain['topalbums']['album']['0']['image']['2']['#text'];
$image1 = $datain['topalbums']['album']['1']['image']['2']['#text'];
$image2 = $datain['topalbums']['album']['2']['image']['2']['#text'];
$image3 = $datain['topalbums']['album']['3']['image']['2']['#text'];
$image4 = $datain['topalbums']['album']['4']['image']['2']['#text'];
$image5 = $datain['topalbums']['album']['5']['image']['2']['#text'];
$image6 = $datain['topalbums']['album']['6']['image']['2']['#text'];
$image7 = $datain['topalbums']['album']['7']['image']['2']['#text'];
$image8 = $datain['topalbums']['album']['8']['image']['2']['#text'];
}

if ($imagesize == "large") {
$image0 = $datain['topalbums']['album']['0']['image']['3']['#text'];
$image1 = $datain['topalbums']['album']['1']['image']['3']['#text'];
$image2 = $datain['topalbums']['album']['2']['image']['3']['#text'];
$image3 = $datain['topalbums']['album']['3']['image']['3']['#text'];
$image4 = $datain['topalbums']['album']['4']['image']['3']['#text'];
$image5 = $datain['topalbums']['album']['5']['image']['3']['#text'];
$image6 = $datain['topalbums']['album']['6']['image']['3']['#text'];
$image7 = $datain['topalbums']['album']['7']['image']['3']['#text'];
$image8 = $datain['topalbums']['album']['8']['image']['3']['#text'];
}

return "<br><img src='$image0'/><img src='$image1'/><img src='$image2'/><br><img src='$image3'/><img src='$image4'/><img src='$image5'/><br><img src='$image6'/><img src='$image7'/><img src='$image8'/><br>";

}
 
add_shortcode('show_lastfm_3x3_grid', 'cs_lastfm_3x3_grid');
