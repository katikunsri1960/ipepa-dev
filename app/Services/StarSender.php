<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class StarSender
{
    private $apikey, $tujuan, $pesan;

    function __construct($tujuan, $pesan)
    {
        $this->apikey = env('STARSENDER_KEY');
        $this->tujuan = $tujuan;
        $this->pesan = $pesan;
    }

    public function sendWa()
    {
        $apikey=$this->apikey;

        $pesan = [
            "messageType" => "text",
            "to" => $this->tujuan,
            "body" => $this->pesan,
        ];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.starsender.online/api/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($pesan),
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json',
                'Authorization: '.$apikey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['success'] == true) {
            return true;
        } else {
            return false;
        }

    }
}
