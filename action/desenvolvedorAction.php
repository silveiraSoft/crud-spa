<?php
/*
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
*/
// Recepción de los datos enviados mediante POST desde el JS   

$desenvolvedorId = (isset($_POST['desenvolvedorId'])) ? $_POST['desenvolvedorId'] : '';
$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$idade = (isset($_POST['idade'])) ? $_POST['idade'] : '';
$hobby = (isset($_POST['hobby'])) ? $_POST['hobby'] : '';
$dataNascimento = (isset($_POST['dataNascimento'])) ? $_POST['dataNascimento'] : '';
$acao = (isset($_POST['acao'])) ? $_POST['acao'] : '';

include_once(__DIR__ . "/../controller/desenvolvedorController.php");
$desenvolvedorController = new DesenvolvedorController(); 

switch($acao){
    case 'getTodos':
           $data = $desenvolvedorController->getTodos();
           print json_encode($data, JSON_UNESCAPED_UNICODE);  
        break;    
    case 'salvar':  
        //echo $desenvolvedorId;return; 
        $data = $desenvolvedorController->salvar($desenvolvedorId, $nome, $sexo, $idade, $hobby, $dataNascimento);   
        print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array
        //echo json_encode($data);    
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
