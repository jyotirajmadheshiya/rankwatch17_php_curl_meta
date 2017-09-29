<?php

$web_address = $_POST["webaddress"]; 
$html_response = curl_request($web_address); 

// Starting of Parsing 
$doc = new DOMDocument(); 
@$doc->loadHTML($html_response); 

$metas = $doc->getElementsByTagName('meta');
$description = "Not found for the URL: ".$web_address;
$keywords = "Not found for the URL: ".$web_address;
$title = "Not found for the URL: ".$web_address;
for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if ($meta->getAttribute('name') == 'description')
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')
        $keywords = $meta->getAttribute('content');
}

@$doc->loadHTML($html); // Loading HTML Source in docs
$nodes = $doc->getElementsByTagName('title'); // getting the attributes of Title Tags 

//Putting Details into a variable
$title = $nodes->item(0)->nodeValue; // Getting title 
?>
<div class="row">
    <div class="col-md-12">
        <h4>Meta Description: </h4><p><?php echo $description; ?></p>
    </div>
    <div class="col-md-12">
        <h4>Meta Keywords: </h4><p><?php echo $keywords; ?></p>
    </div>
    <div class="col-md-12">
        <h4>Title tag: </h4><p><?php echo $title; ?></p>
    </div>
</div>   
