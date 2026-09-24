<?php

try {
  
    $connection = new PDO("mysql:host=localhost;dbname=2512G1","root","");
    echo "database connected";




} catch (\Throwable $th) {
    throw $th;
}




?>