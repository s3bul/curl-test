<?php
declare(strict_types=1);

namespace S3bul;

use S3bul\Client\CurlClient;
use S3bul\Exception\CurlExecException;

class CurlClientExample
{
    public function getUsers(): array
    {
        $curl = new CurlClient();
        $filtered = $curl->init('https://gorest.co.in/public/v2/users')
            ->get(['id' => 269])
            ->getResponse();

        $users = $curl->init()
            ->get()
            ->getResponse();

        $user = $curl->init('https://gorest.co.in/public/v2/users/269')
            ->get()
            ->getResponse();

        try {
            $error = $curl->init('https://gore222st.co.in/public/v2/users')
                ->get()
                ->getResponse();
        } catch (CurlExecException $exception) {
            $error = $exception->getMessage();
        }

        return [
            'filtered' => $filtered,
            'users' => $users,
            'user' => json_decode($user),
            'error' => $error,
        ];
    }

}
