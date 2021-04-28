<?php
 // define("ID_APP", 166); 

  function pasta_raiz($pasta=null) {
    return $_SERVER['DOCUMENT_ROOT'] . "/" .$pasta;
  }

  function pasta_atual($pasta=null) {
    return __DIR__ . "/" . $pasta;
  }
  
  //require_once pasta_raiz("sguSessao.php");
  //require_once pasta_raiz("/lib/autoload.php");
  //require_once realpath(__DIR__ . '/constant.php');