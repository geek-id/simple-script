<?php

$server_name = "192";
$domain_name = "168.10.2";
$site_name = "Wireless Network";

// arp
$arp = "/usr/sbin/arp";

$users = "/var/lib/users";

// Check if we've been redirected by firewall to here.
// If so redirect to registration address
if ($_SERVER['SERVER_NAME']!="$server_name.$domain_name") {
  header("location:http://$server_name.$domain_name/index.php?add="
    .urlencode($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
  exit;
}

$mac = shell_exec("$arp -a ".$_SERVER['REMOTE_ADDR']);
preg_match('/..:..:..:..:..:../',$mac , $matches);
@$mac = $matches[0];
if (!isset($mac)) { exit; }

if (!isset($_POST['email']) || !isset($_POST['name'])) {
  // Name or email address not entered therefore display form
  ?>
  <h1>Welcome to <?php echo $site_name;?></h1>
  To access the Internet you must first enter your details:<br><br>
  <form method='POST'>
  <table border=0 cellpadding=5 cellspacing=0>
  <tr><td>Your full name:</td><td><input type='text' name='name'></td></tr>
  <tr><td>Your email address:</td><td><input type='text' name='email'></td></tr>
  <tr><td></td><td><input type='submit' name='submit' value='Submit'></td></tr>
  </table>
  </form>
  <?php
} else {
    enable_address();
}


function enable_address() {

    global $name;
    global $email;
    global $mac;
    global $users;

    file_put_contents($users,$_POST['name'].";".$_POST['email'].";"
        .$_SERVER['REMOTE_ADDR'].";$mac;".date("U")."\n",FILE_APPEND + LOCK_EX);
    

    exec("sudo iptables -I internet 1 -t mangle -m mac --mac-source $mac -j RETURN");
    // The following line removes connection tracking for the PC
    // This clears any previous (incorrect) route info for the redirection
    exec("sudo rmtrack ".$_SERVER['REMOTE_ADDR']);

    sleep(1);
    header("location:http://".$_GET['add']);
    exit;
}

// Function to print page header
function print_header() {

  ?>
  <html>
  <head><title>Welcome to <?php echo $site_name;?></title>
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <LINK rel="stylesheet" type="text/css" href="./style.css">
  </head>

  <body bgcolor=#FFFFFF text=000000>
  <?php
}

// Function to print page footer
function print_footer() {
  echo "</body>";
  echo "</html>";

}

?>
