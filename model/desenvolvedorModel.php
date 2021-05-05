<?php
include_once(__DIR__ . "/../lib/php/functions/Funcoes.php");
include_once(__DIR__ . "/../lib/php/connect/Conexao.php");
class Desenvolvedor
{
    private $nome;
    private $sexo;
    private $idade;
    private $dataNascimento;

    public function __construct()
    {

    }

    /*
    public function __construct($nome, $sexo, $idade, $dataNascimento) {
        $this->nome = $nome;
        $this->sexo = $sexo;
        $this->idade = $idade;
        $this->dataNascimento = $dataNascimento;
    }*/


    public function getTodos()
    {
        try {
            $conexao = new Conexao();
            $conn = $conexao->conectar();
            $sql = "SELECT desenvolvedorId, nome, sexo, idade, hobby, DATE_FORMAT(dataNascimento,'%d/%m/%Y') as dataNascimento FROM desenvolvedor";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            unset($conexao);
            unset($conn);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception("Error Processing Request:".$e->getMessage(), 1);
        }
    }

    public function salvar($desenvolvedorId, $nome, $sexo, $idade, $hobby, $dataNascimento){
        $dataNascimento = Funcoes::data_br2bd($dataNascimento);

        if(!filter_var($nome, FILTER_VALIDATE_REGEXP,
        array("options"=>array("regexp"=>"/^[a-z A-Z]+$/")))
        ){
           throw new Exception("Error ao salvar: O nome é inválido", 400);
        }elseif(empty($nome) || strlen($nome) == 0){
            throw new Exception("Erro ao salvar. O nome não pode estar vazio.", 1);
        }elseif(!empty($nome) && strlen($nome) >255){
            throw new Exception("Erro ao salvar. O nome não pode ter mais de 255 carateres.", 1);
        }

        if (empty($desenvolvedorId))
        {

            /*$sql = "INSERT INTO desenvolvedor (nome, sexo, idade, hobby, dataNascimento) VALUES('{$nome}', '{$sexo}', $idade, '{$hobby}', '{$dataNascimento}') ";
            */
            try{
                $sql = "INSERT INTO desenvolvedor (nome, sexo, idade, hobby, dataNascimento) VALUES(:nome, :sexo, :idade, :hobby, :dataNascimento) ";

                $conexao = new Conexao();
                $conn = $conexao->conectar();
                //return $sql;
                $conn->beginTransaction();
                $stmt = $conn->prepare($sql);
                $stmt->bindValue('nome', $nome, PDO::PARAM_STR);
                $stmt->bindValue('sexo', $sexo, PDO::PARAM_STR);
                $stmt->bindValue('idade', $idade, PDO::PARAM_INT);
                $stmt->bindValue('hobby', $hobby, PDO::PARAM_STR);
                $stmt->bindValue('dataNascimento', $dataNascimento, PDO::PARAM_STR);
                $stmt->execute();
                /*
                $sql = "SELECT desenvolvedorId, nome, sexo, idade, hobby, dataNascimento FROM desenvolvedor ORDER BY desenvolvedorId DESC LIMIT 1";
                */
                $lastInsertId = $conn->lastInsertId();
                $sql = "SELECT desenvolvedorId, nome, sexo, idade, hobby, dataNascimento FROM desenvolvedor where desenvolvedorId = {$lastInsertId}";
                //return $sql;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $conn->commit();
                return $stmt->fetchAll(PDO::FETCH_ASSOC );
            } catch (PDOException $e) {
                $conn->rollBack();
                throw new Exception("Erro ao salvar.", 400);
            }catch(Exception $e){
                $conn->rollBack();
                throw new Exception("Erro ao salvar.", 400);
            }

        }else{

            $sql = "UPDATE desenvolvedor SET nome='{$nome}', sexo='{$sexo}', idade='{$idade}', hobby = '{$hobby}', dataNascimento = '{$dataNascimento}' WHERE desenvolvedorId = {$desenvolvedorId}  ";
            $conexao = new Conexao();
            $conn = $conexao->conectar();

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $sql = "SELECT desenvolvedorId, nome, sexo, idade, hobby, dataNascimento FROM desenvolvedor WHERE desenvolvedorId={$desenvolvedorId} ";
            //echo $sql; return;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC );
        }
    }

    public function eliminar($desenvolvedorId){
        $sql = "DELETE FROM desenvolvedor WHERE desenvolvedorId={$desenvolvedorId}  ";
        echo $sql;
        $conexao = new Conexao();
        $conn = $conexao->conectar();

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}



