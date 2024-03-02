<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }
      $data = [
        'title' => 'Technical Test For Mega Network',
        'description' => 'Technical test to aspire to the position of lead developer ',
        'info' => 'For more information I add my contact information',
        'name' => 'Edinson Solarte',
        'location' => 'Colombia, Cauca',
        'contact' => '3104348824',
        'mail' => 'edsolarte85@gmail.com'
      ];
     
      $this->view('pages/index', $data);
    }
  }