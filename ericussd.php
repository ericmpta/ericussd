<?php

$email=$_POST['email'];
$password=$_POST['password'];


$dbname = "ussd";
$db_servername = "localhost";
$db_username = "root";
$db_password = "";


 $text=$_GET[‘USSD_STRING’];
 $phonenumber=$_GET[‘MSISDN’];
 $serviceCode=$_GET[‘serviceCode’];

#we explode the text using the separator ‘*’ which will give us an array.

$level = explode(“*”, $text);

//check to see of the text variable has data to avoid errors.
 if (isset($text)) {
    if ( $text == “” ) {
 $response=”CON Welcome to the registration portal.\nPlease enter you full name”;
 }

 if(isset($level[0]) && $level[0]!=”” && !isset($level[1])){

$response=”CON Hi “.$level[0].”, enter your ward name”;

 }
 else if(isset($level[1]) && $level[1]!=”” && !isset($level[2])){
 $response=”CON Please enter you national ID number\n”;

}
 else if(isset($level[2]) && $level[2]!=”” && !isset($level[3])){
 //Save data to database
 $data=array(
 ‘phonenumber’=>$phonenumber,
 ‘fullname’ =>$level[1],
 ‘electoral_ward’ => $level[2],
 ‘national_id’=>$level[3]
 );

//Insert the values into the db SOMEWHERE HERE!!

 $response=”END Thank you “.$level[1].” for registering.\nWe will keep you updated”;
 }

 header(‘Content-type: text/plain’);
 echo $response;

}

?>
