<?php
require_once('views/View.php');

class ControllerInscriptionClient {
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
    $this->_view = new View('client/inscription');
    $this->_view->generate(array());

    if(isset($_POST['submit'])) {
      $this->_ClientManager = new ClientManager;
      $this->_ClientManager->setClient($_POST);
    }
  }
}