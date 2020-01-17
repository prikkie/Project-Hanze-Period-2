<?php
$pa = password_hash("admin", PASSWORD_DEFAULT);
$query = "INSERT INTO users(username, password, department) VALUES ('admin',$pa,'lol')";
mysqli_query($conn, $query);
echo $query;