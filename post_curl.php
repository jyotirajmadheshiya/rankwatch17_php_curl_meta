<!DOCTYPE html>
<html lang="en">
<head>
  	<title>CURL Information! </title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
	$webaddress = $_POST["webaddress"];
?>
<div class="text-center">
  	<h1>CURL Information of the entered URL: <span style="color:red;"><?php echo "$webaddress"; ?></span></h1>
</div>
<div class="container">
	<?php include("meta_keyword.php"); ?>
	<?php include("function_ipaddress.php"); ?>
	<div class="row">
    	<div class="col-md-12">
        	<h4>Load Time: </h4><p><?php echo http_detail($webaddress)['load_time']; ?> Seconds</p>
    	</div>
	</div>
	<div class="row">
    	<div class="col-md-12">
        	<h4>Http Code: </h4><p><?php echo http_detail($webaddress)['http_code']; ?></p>
    	</div>
	</div>
	<?php include("function_url_list.php"); ?>
</div>	 
</body>
</html>
<?php 
function curl_request($url)
{
	$response = array();
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $response['data'] = curl_exec($curl); 
    curl_close($curl);
    return $data;
} 

function http_detail($url) {
    $response = array();
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($handle);
    $response['load_time'] = curl_getinfo($handle, CURLINFO_TOTAL_TIME);
    $response['http_code'] = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);
    return $response;
}
?>
