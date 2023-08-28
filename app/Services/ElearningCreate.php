<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ElearningCreate
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

        $req = Http::post($this->url."?wstoken=".$this->token."&wsfunction=".$this->act."&moodlewsrestformat=json&users[0][createpassword]=1&users[0][username]=".$this->parameters['username']."&users[0][firstname]=".$this->parameters['firstname']."&users[0][lastname]=".$this->parameters['lastname']."&users[0][email]=".$this->parameters['email']);

        $result = json_decode($req->getBody(), true);

        if (isset($result['exception'])) {
            return false;
        }

        return true;

    }
}
