<?php

$webaddress = $_POST["webaddress"]; 
$temp_file = fopen('php://temp', 'r+');

$curl = curl_init($webaddress);
curl_setopt($curl, CURLOPT_VERBOSE, true);  
curl_setopt($curl, CURLOPT_STDERR, $temp_file);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl); 
curl_close($curl);
$ip_list = get_curl_remote_ips($temp_file);
fclose($temp_file);


function get_curl_remote_ips($file_pointer) 
{
    rewind($file_pointer);
    $str = fread($file_pointer, 8192); 
    $regex = '/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/'; 
    if (preg_match_all($regex, $str, $matches)) {
        return array_unique($matches[0]);
    } else {
        return false;
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <h4>IP Address: </h4><p><?php echo end($ip_list); ?></p>
    </div>
</div>  
