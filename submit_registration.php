<?php


$con= new mysqli('localhost','root','','hohospital_DB');
if($con){
print("<p> its done</p>");
}else{
die("its not done".mysqli._connect_error());
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //create varibales 
$name1=$_POST['name'];
$email1=$_POST['email'];
$username1=$_POST['username'];
$password=$_POST['password'];

}
$q="INSERT INTO user (name, email, username, password ) VALUES ('$name1', '$email1', '$username1', '$password')";
//insert into DB
if(mysqli_query($con,$q)){
    print("<p>its inserted!</p>");
    }else{
    die("its not inserted");
    }
    
?>
