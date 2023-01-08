<?php
declare(strict_types=1);

namespace S3bul;

use S3bul\Client\CurlClient as CurlClientOld;
use S3bul\CurlPsr7\Client\CurlClient;
use S3bul\CurlPsr7\Exception\CurlExecException;
use S3bul\CurlPsr7\Factory\RequestFactory;
use S3bul\Exception\CurlExecException as CurlExecExceptionOld;

class CurlClientExample
{
    const SERVICE_URI = 'https://gorest.co.in/public/v2/users';

    public function getUsers(): array
    {
        $request = RequestFactory::get(self::SERVICE_URI, [
            'page' => 1,
            'per_page' => 1,
        ]);
        $curl = new CurlClient($request);
        $filtered = $curl->exec();

        $request = RequestFactory::get(self::SERVICE_URI);
        $curl = new CurlClient($request);
        $users = $curl->exec();

        $request = RequestFactory::get(self::SERVICE_URI . '/272');
        $curl = new CurlClient($request);
        $user = $curl->exec();

        try {
            $request = RequestFactory::get('https://gore222st.co.in/public/v2/users');
            $curl = new CurlClient($request);
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
