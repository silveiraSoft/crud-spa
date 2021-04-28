<?php
include_once(__DIR__ . "/../model/desenvolvedorModel.php");
//include_once("../model/desenvolvedorModel.php");
class DesenvolvedorController
{
    private $nome;
    private $sexo;
    private $idade;
    private $dataNascimento;

    public function __construct()
    {
    }

    public function getTodos()
    {
        try {
            $desenvolvedor = new Desenvolvedor();
            return $desenvolvedor->getTodos();
            //include_once(__DIR__ ."/../view/desenvolvedorList.php");
        } catch (Exception $e) {
            throw new Exception("Error Processing Request:".$e->getMessage(), 1);
        }
    }

    public function listar()
    {
        try {
            $desenvolvedor = new Desenvolvedor();
            $data = $desenvolvedor->getTodos();
            include_once(__DIR__ ."/../view/desenvolvedorList.php");
        } catch (Exception $e) {
            throw new Exception("Error Processing Request:".$e->getMessage(), 1);
        }
    }

    public function mostrar(){
        include_once(__DIR__ ."/../view/desenvolvedorList.php");
    }

    public function salvar($desenvolvedorId, $nome, $sexo, $idade, $hobby, $dataNascimento){
        try {
            $desenvolvedor = new Desenvolvedor();
            return $desenvolvedor->salvar($desenvolvedorId, $nome, $sexo, $idade, $hobby, $dataNascimento);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request:".$e->getMessage(), 1);
        }
    }

    public function eliminar($desenvolvedorId){
        try {
            $desenvolvedor = new Desenvolvedor();
            return $desenvolvedor->eliminar($desenvolvedorId);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request:".$e->getMessage(), 1);
        }
    }
}   