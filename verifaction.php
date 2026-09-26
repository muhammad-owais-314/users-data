<?php
session_start();
include("connection.php");

// echo $_SESSION["name"];  // ya session ma value aa gaya ha 

if(isset($_POST["btn"])){


$userEntercode = $_POST["codeVerifaction"];

if($userEntercode == $_SESSION["code"]){

    echo "verifaction successfully";
  

    
 $name = $_SESSION["name"];
 $password = $_SESSION["password"];
 $email = $_SESSION["email"];


 $insertquery = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
 $insertprepare = $connection->prepare($insertquery);
 $insertprepare->bindParam(":name",$name, PDO::PARAM_STR);
 $insertprepare->bindParam(":email",$email, PDO::PARAM_STR);

 $hashpassword = password_hash($password,PASSWORD_BCRYPT);  // ya password ko ya password ko dcord karay ga show nahii ho ga

 $insertprepare->bindParam(":password", $hashpassword, PDO::PARAM_STR);   // // password ko hash password ka andar store kr da ga

if($insertprepare->execute()){
echo "user added successfully";

}else{
    echo "user not added successfully";
}




}else{
    echo "verification failed";
}



}
   







?>













<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>verify email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center">verify email</h1>
    <div class="container">
    <form class="row g-3" method ="post">
    <div class="col-md-12">
    <label for="inputPassword4" class="form-label">username</label>
    <input type="text" class="form-control" name ="codeVerifaction">
  </div>
    <button type="submit" class="btn btn-primary" name ="btn">verify</button>
  </div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>