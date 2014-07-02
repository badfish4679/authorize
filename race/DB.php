<?php
function connect()
{
    $db = null;
    $dir = 'sqlite:race.sqlite';
    $db = new PDO($dir) or die("cannot open the database");
//        foreach ($db->query("SELECT * FROM mykeys") as $row)
//        {
//            var_dump($row);
//        }
    return $db;
}
//function connect()
//{
//    $db = null;
//
//    if ($db = sqlite_open('race.sqlite', 0666, $sqliteerror)) {
//    } else {
//        die($sqliteerror);
//    }
//    return $db;
//}