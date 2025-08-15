<?php


$host="localhost";
$user="root";
$password="";
$db="ecocycle";

//create connection
$conn= new mysqli($host,$user,$password,$db);


if($conn->connect_error){
  echo "Failed to connect ".$conn->connect_error;
}


















?>