<?php

require 'rb.php';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
];

$db = require '../config/config_db.php';
R::setup( $db['dsn'],$db['user'],$db['pass'],$options);
R::freeze(true);
R::fancyDebug( true);
//var_dump(R::testConnection());

//Create
//$cat = R::dispense('category');
//$cat->title = 'Категория 3';
//$id = R::store($cat);

//Read
//$cat = R::load('category',2);
//echo $cat->title; //$cat['title']

//Update
//$cat = R::load('category',2);
//echo $cat->title . "<br>";
//$cat->title = "Категория 3";
//$id = R::store($cat);
//Or can this
//$cat = R::dispense('category');
//$cat->title = 'Категория 2';
//$cat->id = 2;
//$id = R::store($cat);

//Delete
//$cat = R::load('category',2);
//R::trash($cat);
//R::wipe('category');

//FindAll
//$cats = R::findAll('category');
//$cats = R::findAll('category','id > ?',[2]);
//$cats = R::findAll('category','title LIKE ?',["%1%"]);
//$cat = R::findOne('category','id=2');
