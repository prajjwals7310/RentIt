<?php
$conn = new mysqli("localhost","root","");
if(!$conn){
    echo "connection not established ".$conn->connect_error();
}else{
    // echo "connection established successfully";
    if($conn->query("CREATE DATABASE IF NOT EXISTS REANTIT")){
        // ECHO " database created ";
    }else{
        echo "failed".$conn->error();
    }
}
$conn->close();
$conn = new mysqli("localhost","root","","reantit");
if(!$conn){
    echo "connection not established ".$conn->connect_error();
}else{
    if($conn->query("CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,Name VARCHAR(50) NOT NULL,Number INT(10) NOT NULL,
    Email VARCHAR(50) NOT NULL,Password VARCHAR(50) NOT NULL)")){
        // echo " table created";
    }else{
        echo "failed".$conn->error();
    }

    if($conn->query("CREATE TABLE IF NOT EXISTS resarvation ( rno INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,carID VARCHAR(500) NOT NULL,admin_id INT(50) NOT NULL,date DATE,location_pin INT(6) NOT NULL, status VARCHAR(50),remark VARCHAR(50))")){

    }else{
        echo "failed".$conn->error();
    }
    if($conn->query("CREATE TABLE IF NOT EXISTS locations ( lno INT AUTO_INCREMENT PRIMARY KEY,pickup VARCHAR(50),location_name VARCHAR(50) NOT NULL,admin_id INT(50) NOT NULL,pin INT NOT NULL)")){

    }else{
        echo "failed".$conn->error();
    }
    if($conn->query("CREATE TABLE IF NOT EXISTS admin ( sno INT AUTO_INCREMENT PRIMARY KEY,Username VARCHAR(500) NOT NULL,name VARCHAR(50) NOT NULL,number INT(10),city VARCHAR(50) NOT NULL,pin INT(6) NOT NULL,password VARCHAR(100) NOT NULL)")){
    }else{
        echo "failed".$conn->error();
    }
    if($conn->query("CREATE TABLE IF NOT EXISTS cars ( cno VARCHAR(50) PRIMARY KEY,Car_name VARCHAR(500) NOT NULL,color VARCHAR(10) NOT NULL,model VARCHAR(100) NOT NULL,admin_id INT(50) NOT NULL,location_pin INT(50),discription VARCHAR(100),image VARCHAR(500),rant_per_hour INT(50),status VARCHAR(500) DEFAULT 'ready')")){
    }else{
        echo "failed".$conn->error();
    }
}
?>