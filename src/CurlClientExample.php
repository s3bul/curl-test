<?php
declare(strict_types=1);

namespace S3bul;

use S3bul\Client\CurlClient;

class CurlClientExample
{
    public function getUsers(): string
    {
        $curl = new CurlClient();
        return $curl->init('https://gorest.co.in/public/v2/users')
            ->get()
            ->getResponse();
    }

}
