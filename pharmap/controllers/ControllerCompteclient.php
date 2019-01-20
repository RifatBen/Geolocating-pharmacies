<?php
require_once('views/View.php');

class ControllerCompteClient {
  private $_view;
  private $_ClientManager;
  private $_ClientUpdateManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(!isset($_SESSION['idClient'])) {
        header('Location: ./');
      } else {
        $this->open();
      }
    }
  }

  private function open() {
    $this->_ClientManager = new ClientManager;
    $this->_ClientUpdateManager = new ClientUpdateManager;
    
    $info = $this->_ClientManager->getClient($_SESSION['idClient']);

    if(isset($_POST['submit-1'])) {
      $this->_ClientUpdateManager->updateInfo($info['id'], $_POST['nom'], $_POST['prenom'], $_POST['tel']);
      header('Location: CompteClient');
    }

    if(isset($_POST['submit-3'])) {
      $err = $this->_ClientUpdateManager->deleteAccount($info['id'], $_POST['password']);
    }

    $data = array(
      'nom' => $info['nom'],
      'prenom' => $info['prenom'],
      'email' => $info['email'],
      'tel' => $info['tel'],
    );

    $this->_view = new View('client/compte');
    $this->_view->generate($data);
    
    if(isset($_POST['submit-2'])) {
      $this->_ClientUpdateManager->updatePass($info['id'], $_POST['old-pass'], $_POST['new-pass']);
    }

    if(isset($err)) {
      echo $err;
    }
  }
}