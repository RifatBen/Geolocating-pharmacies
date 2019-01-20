<?php
require_once('views/View.php');

class ControllerConnexionClient {
  private $_view;
  private $_ClientManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(isset($_SESSION['idClient'])) {
        header('Location: ./');
      } else if(isset($_SESSION['id'])) {
        header('Location: Compte');
      } else {
        $this->open();
      }
    }
  }

  private function open() {
    if(isset($_POST['submit'])) {
			$this->_ClientManager = new ClientManager;
      $err = $this->_ClientManager->authentification($_POST);
    }

    $this->_view = new View('client/connexion');
    $this->_view->generate(array());

    if(isset($err)) {
      echo $err;
    }
  }
}