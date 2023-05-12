<?php 

namespace App\Controllers;

class ErrorController extends CoreController {

  public function err403()
    {
        $this->show('error/err403');
    }

  public function err404()
  {
      $this->show('error/err404');
  }

}