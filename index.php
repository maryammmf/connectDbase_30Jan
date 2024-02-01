<?php

require __DIR__.'/vendor/autoload.php';

$connection =MySqlDatabaseConnection::getInstance();
$connection->setPdo(new PDO("mysql:host=127.0.0.1:8889;dbname=learn_sql",'root' ,'123'));

$result = new MysqlDatabase($connection);


//$result->table('songs')->insert(['id' , 'name' , 'length' , 'album_id'] , ['15' , '55' , '1155' , '8'])
//    ->execute()
//    ->fetchAll();


$result->table('songs')
    ->update(['id' , 'name' , 'length' , 'album_id'] , [7 , 77 , 777 , 7])
    ->where('id' ,['15'] , '=')
    ->execute()
    ->fetchAll();


//$result = new  MysqlDatabase($connection);
//$result->table('songs')
//    ->delete()
//    ->where('id' ,['1'] , '=' ,)
//    ->execute();



//$pdo = $connection->getPdo();
//
//$conn = new MysqlDatabase($connection);
//$bands = $conn->table('songs')->select(['name'])->execute()->fetchAll();
//$albums = $conn->table('albums')->select(['name'])->execute()->fetchAll();
//dd($bands , $albums);