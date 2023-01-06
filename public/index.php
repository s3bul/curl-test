<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$test = new \S3bul\CurlClientExample();
var_dump($test->getUsers());