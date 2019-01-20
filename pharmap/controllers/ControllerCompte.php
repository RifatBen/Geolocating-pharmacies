<?php
require_once('views/View.php');

class ControllerCompte {
  private $_view;
  private $_PharmacienManager;
  private $_PharmacienUpdateManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(!isset($_SESSION['id'])) {
        header('Location: ./');
      } else {
        $this->open();
      }
    }
  }

  private function open() {
    $this->_PharmacienManager = new PharmacienManager;
    $this->_PharmacienUpdateManager = new PharmacienUpdateManager;
    
    $info = $this->_PharmacienManager->getPharmacien($_SESSION['id']);
    
    $assurance = decbin($info['assurance']);
    $c1 = false; $c2 = false; $c3 = false;
    if((int)($assurance / 100)) {
      $c1 = true;
      $assurance -= 100;
    }
    if((int)($assurance / 10)) {
      $c2 = true;
      $assurance -= 10;
    }
    if((int)($assurance)) {
      $c3 = true;
    }


    if(isset($_POST['submit-1'])) {
      $this->_PharmacienUpdateManager->updateName($info['id'], $_POST['nom'], $_POST['prenom']);
      header('Location: Compte');
    }

    if(isset($_POST['submit-3'])) {

      if(isset($_POST['casnos'])) $c1 = true; else $c1 = false;
      if(isset($_POST['cnas'])) $c2 = true; else $c2 = false;
      if(isset($_POST['camssp'])) $c3 = true; else $c3 = false;
      $assurance = bindec(($c1*100) + ($c2*10) +$c3);

      $this->_PharmacienUpdateManager->updatePharma($info['id'], $_POST['nompharma'], $_POST['tel'], $assurance);
      header('Location: Compte');
    }

    if(isset($_POST['submit-4'])) {
      $err = $this->_PharmacienUpdateManager->deleteAccount($info['id'], $_POST['password']);
    }

    $data = array(
      'nom' => $info['nom'],
      'prenom' => $info['prenom'],
      'email' => $info['email'],
      'numero' => $info['numero'],
      'nompharma' => $info['nompharma'],
      'tel' => $info['tel'],
      'c1' => $c1, 'c2' => $c2,
      'c3' => $c3
    );

    $this->_view = new View('pharmacien/compte');
    $this->_view->generate($data);
    
    if(isset($_POST['submit-2'])) {
      $err = $this->_PharmacienUpdateManager->updatePass($info['id'], $_POST['old-pass'], $_POST['new-pass']);
    }

    if(isset($err)) {
      echo $err;
    }

  }
}