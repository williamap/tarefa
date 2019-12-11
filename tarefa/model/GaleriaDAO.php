<?php
require_once __DIR__.'/../config/Database.php';
require_once 'Galeria.php';

class GaleriaDAO{
    private $conexao;

    function __construct(){
        $db = new Database();
        $this->conexao = $db->conexao();
    }

    public function listaGalerias(){
        try{
            $sql = "select * from galeria order by nome";
            $stmt = $this->conexao->prepare($sql);

            $stmt->execute();
            $galerias = $stmt->fetchAll(PDO::FETCH_CLASS, "Galeria");
            return $galerias;    
        }catch(PDOException $e){
            throw $e;
        }
    }    
}
