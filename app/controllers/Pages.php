<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('ventas');
      }
      $data = [
        'title' => 'Prueba técnica para Mega Red',
        'description' => 'Prueba técnica para aspirar a la posición de líder de desarrollo',
        'info' => 'Para más información puedes contactarme',
        'name' => 'Edinson Solarte',
        'location' => 'Colombia, Cauca',
        'contact' => '3104348824',
        'mail' => 'edsolarte85@gmail.com'
      ];
     
      $this->view('pages/index', $data);
    }
  }