<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ElearningService
{
    private $url, $token, $act, $parameters;

    function __construct($act, $parameters)
    {
        $this->url = env('ELEARNING_URL');
        $this->token = env('ELEARNING_TOKEN');
        $this->act = $act;
        $this->parameters = $parameters;
    }

    public function runWs()
    {

        $req = Http::post($this->url."?wstoken=".$this->token."&wsfunction=".$this->act."&moodlewsrestformat=json&field=email&values[0]=".$this->parameters);

        // dd(json_decode($req->getBody()));

        if ($req->getStatusCode() != 200) {

            return "Data tidak ditemukan";

        } else {
            $result = json_decode($req->getBody(), true);
            return $result;
        }

    }
}
