<?php

namespace App\Admin\Services\Gist;

class GistApi
{
    protected $http;

    public function __construct()
    {
        $this->http = $this->getHttpClient();
    }

    public function getHttpClient()
    {
        return new \GuzzleHttp\Client();
    }

    public function getAuthToken()
    {
        return config('admin.gist_auth_token');
    }

    public function all()
    {
        return $this->getApi('https://api.github.com/gists');
    }

    public function getRawContent($url)
    {
        return $this->getApi($url, false);
    }


    public function getJson($response)
    {
        return json_decode($response);
    }

    public function getApi($url, $isJson = true)
    {
        $token = $this->getAuthToken();
        $response = $this->http->get($url, [
            'headers' => [
                'Accept' => 'application/vnd.github.v3+json',
                'Authorization' => 'token ' . $token
            ]
        ]);
        if ($isJson) {
            return $this->getJson($response->getBody()->getContents());
        }
        return $response->getBody()->getContents();
    }

}
