<?php

$contents = file_get_contents('URL');
$contents = str_replace('media:group', 'mediagroup', $contents);
$contents = str_replace('media:content', 'mediacontent', $contents);

$xml = new SimpleXMLElement($contents);
foreach($xml->channel->item as $item){

	$name = $end = end((explode('/', $item->guid)));
	if(file_exists($name)){ continue; }
	$largest = "";
	foreach($item->mediagroup->mediacontent as $content){
		print_r($content);
		if($largest == "" || $content['fileSize'] > $largest['fileSize']){
			$largest = & $content;
		}
	}


	$url = $largest['url'];
	echo "getting {$name} from {$url}\n";
	file_put_contents($name, file_get_contents( $url ));
	
}

