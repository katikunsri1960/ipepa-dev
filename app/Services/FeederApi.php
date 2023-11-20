<?php

namespace App\Services;

use GuzzleHttp\Client;

class FeederAPI {
    // url Feeder Dikti
    private $url;
    // Username Feeder Dikti
    private $username;
    // Password
    private $password;
    //data
    private $act, $angkatan, $prodi;


    function __construct($act, $angkatan, $prodi) {

        $this->url = "http://neo.unsri.ac.id:3003/ws/live2.php";
        $this->username = env('feeder_username');
        $this->password = env('feeder_password');
        $this->angkatan = $angkatan;
        $this->prodi = $prodi;
        $this->act = $act;

    }

    public function runWS()
    {
        // dd($this->password);
        $client = new Client();
        $params = [
            "act" => "GetToken",
            "username" => $this->username,
            "password" => $this->password,
        ];

        $req = $client->post( $this->url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'body' => json_encode($params)
        ]);

        $response = $req->getBody();
        $result = json_decode($response,true);

        if($result['error_code'] == 0) {
            $token = $result['data']['token'];
            $params = [
                "token" => $token,
                "act"   => $this->act,
                "key" => [
                    'angkatan'=> $this->angkatan,
                    'id_prodi'=> $this->prodi,
                ],
            ];
            // $result = json_encode($params);
            // return $result;
            $req = $client->post( $this->url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'body' => json_encode($params)
            ]);
            $response = $req->getBody();
            // dd($response);
            $result = json_decode($response,true);
            // dd($result);
        }

        return $result;
    }
}
