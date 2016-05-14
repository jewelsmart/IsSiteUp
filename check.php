<?php
error_reporting(0);

$input = htmlspecialchars($_GET['url']);

if (substr($input, 0, 7)=='http://'||substr($input, 0, 8)=='https://'){
	echo 'true ';
	$domain1 = $input;
} else {
	$domain1 = 'http://'.$input;
}

//echo $domain1;

function get_http_response_code($domain1) {
  
  //$domainName = 'http://www.example.com';
	//$rec = dns_get_record('google.com', DNS_A); // get all records
	// $ip=$rec[0]['ip'];
	//print_r($ip);
  //var_dump($rec);
  
  $headers = get_headers($domain1);
  
  if($headers==false){
	  echo " header returned false";
	  $response_code = 0;
  }
  
  //var_dump($headers);
  $response_code = substr($headers[0], 9, 3);
  
  return $response_code;
  
}

$get_http_response_code = get_http_response_code($domain1);

if (substr($get_http_response_code, 0, 1)==5){
	  $result = 'server error.';
  } else if ($get_http_response_code==0){
	  $result = ' looks down from here.';
  } else {
	  $result = ' looks up from here.';
  }
 ?>
<html>
   <head>
		<style>
		body {
			background: #eee;
			font: 12px 'Lucida sans', Arial, Helvetica;
			color: #333;
			text-align: center;
		}
		
		a {
			color: #2A679F;
		}
		.centered {
		  position: fixed;
		  top: 50%;
		  left: 50%;
		  margin-top: -50px;
		  margin-left: -100px;}
  
  p {
    display: block;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
}

#container {
    font-size: 220%;
    margin-top: 20%;
    text-align: center;
}

#container p {
    line-height: 1.2em;
    margin: 0.6em;
}

#container .smaller{font-size:65%;}
a, a:visited, a:active {
    color: #369;
    text-decoration: none;
}
		
		</style>
		<title>Result</title>
   </head>
   <body>
	<div id="container">
		<p><a href="<?php echo $domain1; ?>"><?php echo $domain1;?></a><?php echo $result;?></p>
        <p class="smaller"><a href="#">Check Another</a></p>
		<br></br>
		<?php $externalIp = file_get_contents('http://www.icanhazip.com/'); ?>
		<p class="smaller"><?php echo $externalIp; ?></p>
		<p class="smaller">Atlanta, US</p>
	</div>
   </body>
</html>


  

