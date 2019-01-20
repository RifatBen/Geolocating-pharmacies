<?php

class ControllerDeconnexion {

  public function __construct($url) {
    $_SESSION = array();
    session_destroy();
    header('Location: ./');
    exit();
  }
    
}