<?php
header('Content-Type: application/json');

require_once '../model/ImagemDAO.php';

if (isset($_GET['gal'])){
    $galeria_id = $_GET['gal'];

    $dao = new ImagemDAO();
    $imagens = $dao->listaImagensPorGaleria($galeria_id);
    echo json_encode($imagens);
}else{
    echo json_encode(array('erro' => 'Id de Galeria não informado'));
}


