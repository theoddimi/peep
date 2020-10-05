<?php

namespace App\Helpers\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Passport\Client;

trait IssueTokenTrait{
  private $clientId;
  private $clientSecret;


  private function fetchClient(){
    $client = Client::find(2);
    $this->clientId = $client->id;
    $this->clientSecret = $client->secret;
  }

  public function issueToken(Request $request, $grantType, $scope){
    $this->fetchClient();
    $params = [
      'grant_type'    => $grantType,
      'client_id'     => $this->clientId,
      'client_secret' => $this->clientSecret,
      'username'      => $request->username ,
      'scope'         => $scope,
  
    ];

     $request->request->add($params);

    $proxy = Request::create('oauth/token', 'POST');
    return Route::dispatch($proxy);
  }


}
