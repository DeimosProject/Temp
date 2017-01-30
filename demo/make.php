<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$file = new \Deimos\Temp\File();

var_dump($file);

$file->puts('hello ');
$file->puts('world');

var_dump($file);

var_dump($file->read());
var_dump($file->read(0, 5), $file->read(6));

$file->write('hell');

var_dump($file->read());

var_dump(file_exists($file));