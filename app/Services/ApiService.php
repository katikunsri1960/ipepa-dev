<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use App\Models\ApiConfig;

class ApiService
{
    private $url, $token, $act, $limit, $order, $page;

    function __construct($act, $page)
    {
        $db = ApiConfig::where('name', 'pdunsri')->first();
        $this->url = $db['api_url'];
        $this->token = $db['api_key'];
        $this->act = $act;
        $this->page = $page;
    }

    public function runWs()
    {
        $client = new Client();

        $req = $client->get($this->url . $this->act, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'query' => [
                'page' => $this->page,
            ],
            'http_errors' => false,
            'verify' => false,
        ]);

        if ($req->getStatusCode() == 401) {

            $this->getToken();

        } else {
            $result = json_decode($req->getBody(), true);
            return $result;
        }


    }

    public function getToken()
    {
        $client = new Client();

        $db = ApiConfig::where('name', 'pdunsri')->select('username', 'password')->first();

        if ($db) {
            $req = $client->post($this->url .'/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'email' => $db['username'],
                    'password' => $db['password'],
                ],
                'verify' => false,
                // 'http_errors' => false,
            ]);


            if ($req->getStatusCode() == 401) {
                return false;
            } else {

                $result = json_decode($req->getBody(), true);

                $key = $result['data']['token'];
                ApiConfig::where('name', 'pdunsri')->update(['api_key' => $key]);


                return response()->json([
                    'status' => 'success',
                    'message' => 'Token berhasil diperbarui!! Silahkan coba lagi',
                ]);


            }
        }
    }
}
