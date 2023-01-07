<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$example = new \S3bul\CurlClientExample();
var_dump($example->getUsers());