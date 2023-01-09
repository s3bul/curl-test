<?php
declare(strict_types=1);

namespace S3bul;

use S3bul\Client\CurlClient as CurlClientOld;
use S3bul\CurlPsr7\Exception\CurlExecException;
use S3bul\CurlPsr7\Factory\CurlFactory;
use S3bul\Exception\CurlExecException as CurlExecExceptionOld;

class CurlClientExample
{
    const SERVICE_URI = 'https://gorest.co.in/public/v2/users';

    public function getUsers(): array
    {
        $curl = CurlFactory::get(self::SERVICE_URI, [
            'page' => 1,
            'per_page' => 1,
        ]);
        $filtered = $curl->exec();

        $curl = CurlFactory::get(self::SERVICE_URI);
        $users = $curl->exec();

        $curl = CurlFactory::get(self::SERVICE_URI . '/272');
        $user = $curl->exec();

        try {
            $curl = CurlFactory::get('https://gore222st.co.in/public/v2/users');
            $error = $curl->exec();
        } catch (CurlExecException $exception) {
            $error = $exception->getMessage();
        }

        return [
            'filtered' => $filtered->getBody()->getContents(),
            'users' => $users->getBody()->getContents(),
            'user' => json_decode($user->getBody()->getContents()),
            'error' => $error,
        ];
    }

    public function getUsersOld(): array
    {
        $curl = new CurlClientOld();
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
        } catch (CurlExecExceptionOld $exception) {
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
