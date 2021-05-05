<?php
/*
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
*/
// Recepción de los datos enviados mediante POST desde el JS
//require_once(realpath(dirname(__FILE__)).'/../config.inc.php');

$desenvolvedorId = (isset($_POST['desenvolvedorId'])) ? $_POST['desenvolvedorId'] : '';
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$nome = (isset($nome)) ? $nome : '';
//$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
$sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$idade = (isset($_POST['idade'])) ? $_POST['idade'] : '';
$hobby = (isset($_POST['hobby'])) ? $_POST['hobby'] : '';
$dataNascimento = (isset($_POST['dataNascimento'])) ? $_POST['dataNascimento'] : '';
$acao = (isset($_POST['acao'])) ? $_POST['acao'] : '';

include_once(__DIR__ . "/../controller/DesenvolvedorController.php");
$desenvolvedorController = new DesenvolvedorController();

switch($acao){
    case 'getTodos':
           $data = array();
           $result = $desenvolvedorController->getTodos();
           if(is_array($result['data'])){
              $data = $result['data'];
           }
           //$data = array();
           print json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    case 'salvar':
        //echo $desenvolvedorId;return;
        try{
            $data = $desenvolvedorController->salvar($desenvolvedorId, $nome, $sexo, $idade, $hobby, $dataNascimento);

            $data = array();
            $resposta = $desenvolvedorController->getTodos();
            if(is_array($resposta['data'])){
               $data = $resposta['data'];
            }
            print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array
        }catch(Exception $e){
            $code = $e->getCode();
            //$data = array(array(),$e->getCode(),$e->getMessage());
            //header("HTTP/1.0 "+$code+' '+$e->getMessage());
            $cad = utf8_decode("HTTP/1.0 ".$code.' '.$e->getMessage());
            //header('Content-Type: text/html; charset=utf-8');
            header($cad);
        }
        //$data = array();


        break;
    case 'eliminar'://baja
        //echo $desenvolvedorId; return;
        $data = $desenvolvedorController->eliminar($desenvolvedorId);
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array
        break;
    default:{
        //$desenvolvedorController->listar();
        $desenvolvedorController->mostrar();
    }
}

// json a JS
//$conexion = NULL;
