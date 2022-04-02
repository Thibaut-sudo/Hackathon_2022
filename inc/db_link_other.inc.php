<?php

define('HOST','192.168.128.13');
define('DB_NAME','in19b1168');
define('USER','in19b1168');
define('PASS','8169');


try{
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo $e;
}
