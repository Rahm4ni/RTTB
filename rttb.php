<?php
/* START: Credits
	RTTB = Remaining time Temaspeak bot
	Author: Key1 (Github: @Todliwch)
*/// END: Credits
require("teamspeak.class.php"); //Include Teamspeak PHP Class
// START: Teamspeak server details
$address = 'localhost'; //Teamspeak address
$qport = 10011 ; //Query port 
$port = 9987; //Port
$user = 'username'; //Query username (normal use: serveradmin)
$password = 'password'; //Query password
$name = 'Countbot'; //Bot name
$cid = 2; //Channel ID that you want.
$timezone = "Asia/Tehran"; //Timezone (for example: Asia/Tehran)
$target = "2016-07-12 12:00:00"; //Your target's date
//   END: Teamspeak server details
date_default_timezone_set($timezone); // Set timezone
$con = new ts3admin($address, $qport); // Connect to server
if($con->getElement('success', $con->connect())) { //If connection was successfully
	$con->login($user, $password); //Login into query
	$con->selectServer($port); //Select server by port. (You can use server id instead of port)
	$con->setName($name); //Set the bot's name
	while(1) {
		$date    = strtotime($target) - time(); //Convert string to time and count remaining date
		$days    = floor($date / 86400); //Count remaining days
		$hours   = floor(($date % 86400) / 3600); //Count remaining hours
		$cstr    = "[cspacer]{$days}d and {$hours}h remaining..."; //Channel's name string (Use '$days' for remaining days and '$hours' for remaining hours)
		$con    -> channelEdit($cid, array('channel_name' => $cstr)); //Set channel's name
		sleep(60); //Run the loop every 60seconds(1minute) and check date. (Edit it optionaly)
	}
} else {
	die("Unable to connect to $address:$port..."); //If connection was not successfully
}
?>
