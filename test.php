<?php 
    $input = "ls -la; && id;;;id id";
    $re = '/(;|\|\||\&\&|\&|\\\\n|\$(.*)|\`.*\`)/m';
	$sanitized = preg_replace($re, str_repeat("A", rand(2,10)),  $input);
	echo $sanitized;
?>