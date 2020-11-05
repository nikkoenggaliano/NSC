<?php

function dd($smt){
	die(var_dump($smt));
}

$config = array();
$config['dir'] = array('/c99/i', '/r57/i', '/gifimg/i', '/idx/i', '/idx_config/i');
$config['type'] = array('/\.htaccess$/i', '/\.php[45]?$/i', '/\.html?$/i', '/\.aspx?$/i', '/\.inc$/i', '/\.cfm$/i', '/\.css$/i');
$config['file'] = array('/db-.*\.php/i', '/(.*?)\.(cache|bak|old)\.php/i', '/class-(snoopy|smtp|feed|pop3|IXR|phpmailer|json|simplepie|phpass|http|oembed|ftp-pure|wp-filesystem-ssh2|wp-filesystem-ftpsockets|ftp|wp-filesystem-ftpext|pclzip|wp-importer|wp-upgrader|wp-filesystem-base|ftp-sockets|wp-filesystem-direct)\.php/i');
$config['contains'] = array('/edoced_46esab/i', '/system/i', '/str_rot13/i', '/gzinflate/i', '/gzinflate*\(str_rot13*\(base64_decode/i', '/passthru *\(/i', '/eval *\(/i', '/shell_exec *\(/i', '/jumping/i', '/r3c0ded/i', '/document\.write *\(unescape *\(/i', '/base64_decode *\(/i', '/system *\(/i',  '/`.+`/', '/phpinfo *\(/i', '/hacked by /i', '/shell/i', '/b374k 2.8 /i', '/1n73ction/i', '/s_func/i',  '/popcash/i', '/miner/i', '/coinhive/i',   '/web[\s-]*shell/i', '/c99/i', '/r57/i', '/indoxploit/i', '/b374k/i', '/Jayalah Indonesiaku/i', '/mailer/i', '/ransome/i',   '/gumblar\.cn/i', '/martuz\.cn/i', '/beladen\.net/i', '/gooqle/i', '/_analist/i', '/anaiytics/i');
$config['max_reading_length'] = (1000 * 100); // 100MB

// Configuratoin
$stack = array();
$stack['sup'] = [];
$config['dir_saran'] = __DIR__."/saran/";

$config['saran'] = array(
	'shell' => 'shell.pdf',
	'fs' => 'filesystem.pdf',
	'encode' => 'encode.pdf'
);


//can i use this function?
if (!function_exists('is_this_func_exist')) {
    function is_this_func_exist($a) {
        return (function_exists($a) ? !in_array($a, explode(',', ini_get('disable_functions'))) : false);

    }
}



//can i read the file?
if (!function_exists('can_read_file')) {
    function can_read_file($a) {
        return (is_this_func_exist("is_readable") ? (is_readable($a) ? true : false) : false);

    }
}


if (!function_exists('escape_string')) {
    function escape_string($a) {
        return (is_this_func_exist('escapeshellarg') ? escapeshellarg($a) : "'".str_replace("'", "\'", $a)."'");

    }
}


if (!function_exists('read_the_file')) {
    function read_the_file($a) {
        global $config, $stack;
        if (can_read_file($a)) {
            if (is_this_func_exist("file_get_contents")) {
                $b = file_get_contents($a);

            } elseif (is_this_func_exist("fopen")) {
                $b = "";
                $c = fopen($a, "r");
                if ($c) {
                    while (($d = fgets($c)) !== false) {
                        $b .= $d;

                    }
                    fclose($c);
                } else {
                    return false;

                }

            } else {
                return false;

            }

        } elseif ((is_this_func_exist("exec") || is_this_func_exist("shell_exec") || is_this_func_exist("system") || is_this_func_exist("passthru")) && $stack['os_env'] == "linux") {
            $d = "";
            $c = (is_this_func_exist("exec") ? exec("cat " . escape_string($a), $d) : (is_this_func_exist("system")) ? system("cat " . escape_string($a)) : (is_this_func_exist("passthru")) ? passthru("cat " . escape_string($a)) : shell_exec("cat " . escape_string($a)));
            $b = (is_this_func_exist("exec") ? implode("\n", $d) : $c);
            if (empty($b)) {
                $c = (is_this_func_exist("exec") ? exec("tail " . escape_string($a), $d) : (is_this_func_exist("system")) ? system("tail " . escape_string($a)) : (is_this_func_exist("passthru")) ? passthru("cat " . escape_string($a)) : shell_exec("tail " . escape_string($a)));
                $b = (is_this_func_exist("exec") ? implode("\n", $d) : $c);

            }
            return $b;
        
        } elseif ((is_this_func_exist("exec") || is_this_func_exist("shell_exec") || is_this_func_exist("system") || is_this_func_exist("passthru")) && $stack['os_env'] == "windows") {
            $d = "";
            $c = (is_this_func_exist("exec") ? exec("more " . escape_string($a), $d) : (is_this_func_exist("system")) ? system("more " . escape_string($a)) : (is_this_func_exist("passthru")) ? passthru("more " . escape_string($a)) : shell_exec("more " . escape_string($a)));
            $b = (is_this_func_exist("exec") ? implode("\n", $d) : $c);
            return $b;

        } else {
            return false;

        }
        return $b;
    }
}

function PushSup($str){
	global $stack;
	foreach($str as $s){

		if(!in_array($s, $stack['sup'])){
			array_push($stack['sup'], $s);
		}
	}

	return count($str);
}

function Saran($arr, $env='cli', $os='windows'){
	global $config;
	$conf = array();
	$clean = array('()', '(', ')', '#', '\'', '"');
	if(count($arr) < 1){
		exit;
	}
	$possible_shell  = ['shell_exec', 'system', 'passthru', 'exec', 'eval', ];
	$possible_fs     = ['show_source', 'file_get_contents', 'highlight_file'];
	$possible_encode = ['base64_decode', 'base64_encode', 'str_rot13', 'gzdeflate'];
	foreach($arr as $a){
		// shell_exec( /
		if(in_array(str_replace($clean, "", $a), $possible_shell)){

			if(in_array('shell', $conf)){
				continue;
			}else{
				$conf[] = 'shell';
			}
		}elseif (in_array(str_replace($clean, "", $a), $possible_fs)) {
			if(in_array('fs', $conf)){
				continue;
			}else{
				$conf[] = 'fs';
			}
		}elseif(in_array(str_replace($clean, "", $a), $possible_encode)){
			if(in_array('encode', $conf)){
				continue;
			}else{
				$conf[] = 'encode';
			}
		}else{
			continue;
		}

	}

	$sarandir = $config['dir_saran'];
	if($os == 'windows'){
		$sarandir = str_replace('/', "\\", $sarandir);
	}

	if($env == 'cli'){
		echo "\nBerikut ini saran-saran yang dapat kami berikan terkait penggunaan fungsi-fungsi yang dianggap berbahaya oleh system\n\n";
		foreach($conf as $c){
			echo $sarandir.$config['saran'][$c].PHP_EOL;
		}
	}else{
		echo "<br>Berikut ini saran-saran yang dapat kami berikan terkait penggunaan fungsi-fungsi yang dianggap berbahaya oleh system<br>";
			foreach($conf as $c){
					echo '<a href="?pdf='.$sarandir.$config['saran'][$c].'" target="_blank">'.$c.'</a><br>';
			}
	}
}

if (!function_exists('lets_scan_this')) {
    function lets_scan_this($a) {
        global $config, $stack;
        if (!function_exists('worker_dir_file')) {
            function worker_dir_file($a = "", $b = false){
                global $stack, $config;
                if (empty($a)) return false;
                echo "[X] " .preg_replace_callback('/\%(.*?)\%/', function($a) use ($stack, $config, $b) {
                    if ($b == false) return "";
                    return (isset($a[1]) ? (isset($stack[$a[1]]) ? (is_array($stack[$a[1]]) ? "(".PushSup($stack[$a[1]]).")[ " . implode(", ", $stack[$a[1]]) . " ]" : $stack[$a[1]]) : ""): "");
                }, $a) . ($stack['type'] == "cli" ? PHP_EOL : "<br/>");
                return true;
            }

        }
        if (!function_exists('scan_file_scan_dir')) {
            function scan_file_scan_dir($a = array(), $b = "") {
                global $stack, $config;
                if (empty($a) || empty($b)) return false;
                unset($stack['sup_things']);
                foreach($a as $c) {
                    $d = array();
                    preg_match_all($c, $b, $d);
                    foreach($d as $e) {
                        if (isset($e[0])) $stack['sup_things'][] = "\"{$e[0]}\"";
                        
                    }
                }
                return (!empty($stack['sup_things']));
            }
        }
        foreach(glob($a, GLOB_MARK|GLOB_BRACE) as $b) {
            // echo $b . PHP_EOL;
            if (is_dir($b)) { 
                (scan_file_scan_dir($config['dir'], $b) ? worker_dir_file("Suspicious DIR ".substr($b, 0, -1)." > %sup_things%", true) : worker_dir_file());
                lets_scan_this($b . "*");

            } elseif (is_file($b) && scan_file_scan_dir($config['type'], basename($b)) && basename($b) != basename(__FILE__)) {
                (scan_file_scan_dir($config['file'], basename($b)) ? worker_dir_file("Suspicious FILE ".($stack['type'] == "cli" ? $b : "<a href=\"?_view=".realpath($b)."\">".htmlentities($b, ENT_QUOTES)."</a>")." %sup_things%") : worker_dir_file());
                $c = read_the_file(realpath($b));
                if (empty($c) || $c === false) {
                    continue;

                }

                // Line Breaking max 100mb
                if (strlen($c) < $config['max_reading_length']) {
                    $d = explode("\n", $c);
                    foreach($d as $e => $f) {
                        (scan_file_scan_dir($config['contains'], $f) ? worker_dir_file("Contain(s) Malicious String ".($stack['type'] == "cli" ? $b : "<a href=\"?_view=".realpath($b)."\">".htmlentities($b, ENT_QUOTES)."</a>")." > Line " .  ($e+1) . " > %sup_things%", true) : "");
    
                    }

                } else {
                    (scan_file_scan_dir($config['contains'], $c) ? worker_dir_file("Contain(s) Malicious String ".($stack['type'] == "cli" ? $b : "<a href=\"?_view=".realpath($b)."\">".htmlentities($b, ENT_QUOTES)."</a>")." > %sup_things%", true) : "");

                }
            }
        }

        return true;
    };
}
if (defined('PHP_OS')) {
    (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? $stack['os_env'] = "windows" : $stack['os_env'] = "linux");

} else {
    $stack['os_env'] = "linux";

}
if (!defined('PHP_EOL')) {
    define('PHP_EOL', "\r\n");

}
if (is_this_func_exist('php_sapi_name')) {
    (php_sapi_name() == "cli" ? $stack['type'] = "cli" : $stack['type'] = "browser");

} else {
    $stack['type'] = "cli";
    
}
if ($stack['type'] == "cli") {
    echo "Shell Finder v1.0 | Nikko Enggaliano Pratama" . PHP_EOL . "If there's no other line, then there's nothing detected in this entire directory." . PHP_EOL . str_repeat("-", 50) . PHP_EOL . PHP_EOL;
    lets_scan_this("{,.}[!.,!..]*");
    //Saran($stack['sup'], 'cli', $stack['os_env']);

} else {
	if(isset($_GET['pdf'])){

		$filename = $_GET['pdf']; 
		header("Content-type: application/pdf"); 
		header("Content-Dispotition: inline; filename=".$filename);
		header("Content-Length: " . filesize($filename)); 
		header('Content-Transfer-Encoding: binary'); 
		header('Accept-Ranges: bytes'); 
		@readfile($filename);
		exit;
	}


	
    echo "<html><head><title>Shell Finder</title><script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/codemirror.min.js' integrity='sha512-UxcTlYsLkcuGZL9JNnMsfo3p7VFSmcgBjH1VUSM82Okk5ni52bk7vz9f2p+D1VnMcNUmMzbzgWqWcdJ2j8Svow==' crossorigin='anonymous'></script><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/codemirror.min.css' integrity='sha512-xIf9AdJauwKIVtrVRZ0i4nHP61Ogx9fSRAkCLecmE2dL/U8ioWpDvFCAy4dcfecN72HHB9+7FfQj3aiO68aaaw==' crossorigin='anonymous' /><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/theme/base16-dark.min.css' integrity='sha512-KwSvkuZgl9lncVFB+vPkAhZXTTkrEIAfBJoYIXunMfvyM3gsjiAcMXF8yNyHpEPasrEA7CZVcefUvpbJFHEcow==' crossorigin='anonymous' /><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/theme/base16-light.min.css' integrity='sha512-UCcyAfcA/pJ4lD8YMo+fhwFdJeGNN5QrBlHvTQ1BopVjHWh35HD2JRV3tbwxtabH5ymri426oTfa1UF9Z63B3g==' crossorigin='anonymous' /><script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/addon/edit/matchbrackets.min.js' integrity='sha512-zgTUY40c9HFb3Kr25lTW3gpnSt+xVc0yWPYwa6Yu7kChiaOHfNlyA4bM8Y3YLzjeQfrNFy40UcbOE/Cmmb29nQ==' crossorigin='anonymous'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/addon/selection/active-line.min.js' integrity='sha512-ysQeDEwbdvERZqZCqFd64rVjSx4ExrC/r581h40cMF4e6rFWS6VxvdVxmSf/cLr+oe9mVxxzWSMhPJYSFyiVew==' crossorigin='anonymous'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.58.2/addon/runmode/colorize.min.js' integrity='sha512-GWO6evZYugPhppUQv6Kz/yk8j993+9rx+rHFgXXqerywakcoox3sSEjj756hf/qSHIABGIg/TlyfveTqxtLS1w==' crossorigin='anonymous'></script></head><body><center><h1>Shell Finder v1.0</h1><form type=get><input type=text name=_ placeholder='Path' value='".@htmlentities($_GET['_'], ENT_QUOTES)."'/>&nbsp;<input type=submit name=submit/></form></center><hr/><br/></body>";
    if (isset($_GET['_view'])) {
        echo "Opening File " . htmlentities(urldecode($_GET['_view']), ENT_QUOTES) . ":<br/><br/><div style=\"padding-left: 30px;padding-right: 30px;\"><textarea id='my'>";
        echo htmlentities(read_the_file(urldecode($_GET['_view'])), ENT_QUOTES) . "</textarea></div><script>var editor=CodeMirror.fromTextArea(document.getElementById('my'),{lineNumbers: true, styleActiveLine: true, matchBrackets: true});editor.setOption(\"theme\", \"base16-light\");</script>";
    }else {
        if (@!empty($_GET['_'])) {
            lets_scan_this($_GET['_']);
    		//Saran($stack['sup'], 'web', $stack['os_env']);
            //saran soon
        } else {
            lets_scan_this("{,.}[!.,!..]*");
            //Saran($stack['sup'], 'web', $stack['os_env']);
            //saran soon
        }
        
    }
    echo "<br/><hr/><center>Copyright Nikko Enggaliano Pratama</center></body></head>";
}
?>
