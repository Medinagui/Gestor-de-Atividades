<?php 

    require_once("jwt.php");
    
    $secret = "chave-secreta";
    
    $payload = [
        "sub" => "1234567890",
        "name" => "Luís Felipe",
        "role" => "admin"
    ];

    echo MyJWT::encode($payload, $secret);

    $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Ikx1XHUwMGVkcyBGZWxpcGUiLCJyb2xlIjoiYWRtaW4ifQ.KsF0ePfK6roKqMR8sZNpW0RSTAbQHjmaKO6-VfrM1dc";

    echo "<br><br><br>"; 

    print_r(MyJWT::decode($token, $secret));

?>