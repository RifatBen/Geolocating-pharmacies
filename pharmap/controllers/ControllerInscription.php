<?php
require_once('views/View.php');

class ControllerInscription {
  private $_view;
  private $_PharmacienManager;

  public function __construct($url) {
    if(isset($url) && count($url) > 1)
      throw new Exception('Page introuvable');
    else {
      if(isset($_SESSION['id'])) {
        header('Location: Compte');
      } else if(isset($_SESSION['idClient'])) {
        header('Location: ./');
      } else {
        $this->open();
      }
    }
  }

  private function open() {
    $this->_view = new View('pharmacien/inscription');
    $this->_view->generate(array());

    if(isset($_POST['submit'])) {
			$this->_PharmacienManager = new PharmacienManager;
			$err = $this->_PharmacienManager->setPharmacien($_POST);
		}

    if(isset($err)) {
      echo $err;
    }
  }
}