<?php

define('DS', DIRECTORY_SEPARATOR);

$look = array (
    'figure' => 'hr-145-31.hd-180-1.ch-210-62.lg-285-64.sh-290-62',
    'size' => 'b',
    'direction' => '2',
    'head_direction' => '2',
    'gesture' => ''
);


if (!is_dir($map = './avatars')) {
    if (!mkdir($map, 0, true)) {
        exit('Can\'t make the folder chmod this folder');
    }
}

foreach ($look as $k => $v) {
    if (!empty($part = filter_input(INPUT_GET, $k))) {
        $look[$k] = $part;
    }
}

$image_path = $map . DS . md5(implode($look)) . '.png';

if (!file_exists($image_path)) {
    $fp = fopen($image_path, 'w+');

    $ch = curl_init('https://www.habbo.com/habbo-imaging/avatarimage?' . http_build_query($look));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_FILE, $fp);         
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    curl_exec($ch);

    curl_close($ch);                              
    fclose($fp);  
}

$im = imagecreatefrompng($image_path);
imagesavealpha($im, true); 

header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>