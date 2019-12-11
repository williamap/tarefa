<?php
require_once __DIR__.'/../config/Database.php';
require_once 'Imagem.php';

class ImagemDAO{
    private $conexao;

    function __construct(){
        $db = new Database();
        $this->conexao = $db->conexao();
    }

    public function listaImagensPorGaleria($galeria_id){
        try{
            $sql = "select * from imagem where galeria_id=:galeria_id order by data desc";
            $stmt = $this->conexao->prepare($sql);

            $stmt->bindParam(':galeria_id', $galeria_id);
            $stmt->execute();
            $imagens = $stmt->fetchAll(PDO::FETCH_CLASS, "Imagem");
            return $imagens;    
        }catch(PDOException $e){
            throw $e;
        }
    }    

    public function insereImagem(Imagem $imagem){
        try{
            $sql = "insert into imagem (descricao, arquivo, galeria_id)
             values (:descricao, :arquivo, :galeria_id)";
            $stmt = $this->conexao->prepare($sql);

            $stmt->bindValue(':descricao', $imagem->descricao);
            $stmt->bindValue(':arquivo', $imagem->arquivo);
            $stmt->bindValue(':galeria_id', $imagem->galeria_id);
            $stmt->execute();
        }catch(PDOException $e){
            throw $e;
        }

    }
}
