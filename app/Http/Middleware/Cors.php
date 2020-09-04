<?php


namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Closure;

class Cors
{
    public function handle(Request $request,Closure $next){
      header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
      header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, X-Token-Auth, Authorization');
      /*$headers=[
      	'Access-Control-Allow-Origin'=>'http://localhost:3000',
      	'Access-Control-Allow-Methods'=>'GET, POST, PUT, DELETE, OPTIONS',
      	'Access-Control-Allow-Headers'=>'X-Requested-With, Content-Type, Origin, X-Token-Auth, Authorization',
      ];*/
      
      return $next($request);/*
      foreach ($headers as $key => $value) {
      	$response->header($key,$value);
      }
      $response->header($headers[0]);
      return $response;*/
    }

}
