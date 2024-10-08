<?php 
class HomeService extends Requests {

  public function index(){
    
    $method = $this->getMethod();
    if($method == 'GET') { $this->success("", "Inicio API - Bienvenido!!"); } 
    else { $this->failed(405,"HTTP Method not allowed"); }
    
  }
}