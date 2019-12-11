<?php
$pastaOrigem = __DIR__ . '/../images/';
$pastaDestino = __DIR__  .  "/../images/thumbs/";

// Verificar se existe uma pasta de destino
if (!is_dir($pastaDestino)) {
    mkdir($pastaDestino); // cria a pasta de destino
}
// Verificar se existe uma pasta de origem
if (is_dir($pastaOrigem)) {
    /*  
    *   A função glob() procura por todos os caminhos que combinem com o padrão pattern de acordo com as 
    *   regras usadas pela função glob() da libc, que é semelhante às regras usadas por shells comuns.
    *   glob ( string $pattern [, int $flags = 0 ] ) : array
    */
    $arquivos = glob("$pastaOrigem{*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);

    for ($i = 0; $i < count($arquivos); $i++) {

        $largura_nova = 200;
        $altura_nova = 200;

        $nome = explode($pastaOrigem, $arquivos[$i])[1]; // Pega o nome original 

        // Salva o tamanho antigo da imagem
        list($largura_antiga, $altura_antiga, $type) = getimagesize($arquivos[$i]);

        // tipos validos de imagens
        $allowedTypes = array(
            1,  // [] gif
            2,  // [] jpg
            3,  // [] png
            6   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1:
                $imagem_original = imageCreateFromGif($arquivos[$i]);
                break;
            case 2:
                $imagem_original = imageCreateFromJpeg($arquivos[$i]);
                break;
            case 3:
                $imagem_original = imageCreateFromPng($arquivos[$i]);
                break;
            case 6:
                $imagem_original = imageCreateFromBmp($arquivos[$i]);
                break;
        }
        /* 
        * Calculo para redimensionar imagem e mantendo proporção
        */
        $areaOriginal = $largura_antiga / $altura_antiga;

        if ($largura_nova / $altura_nova >  $areaOriginal) {
            $largura_nova = $altura_nova * $areaOriginal;
        } else {
            $altura_nova = $largura_nova / $areaOriginal;
        }
        /* 
        *   imagecreatetruecolor()  retorna um identificador de imagem representando uma imagem 
        *   preta de tamanho x_size por y_size.
        *   imagecreatetruecolor ( int $x_size , int $y_size ) : resource
        *   Doc => https://www.php.net/manual/pt_BR/function.imagecreatetruecolor.php
        */
        $imagem_nova = imagecreatetruecolor($largura_nova, $altura_nova);

        /* 
        *   imagecopyresampled () copia uma parte retangular de uma imagem para outra imagem, 
        *   interpolando suavemente os valores de pixel para que, 
        *   em particular, reduzir o tamanho de uma imagem ainda retenha uma grande clareza. 
        *   Doc => https://www.php.net/manual/pt_BR/function.imagecopyresampled.php
        */
        imagecopyresampled(
            $imagem_nova,
            $imagem_original,
            0,
            0,
            0,
            0,
            $largura_nova,
            $altura_nova,
            $largura_antiga,
            $altura_antiga
        );

        switch ($type) {
            case 1:
                // imagegif() cria um arquivo GIF em filename a partir da imagem image
                // imagegif ( resource $image [, string $filename ] ) : bool
                $resultado = imagegif($imagem_nova, $pastaDestino . $nome);
                break;
            case 2:
                //imagejpeg() cria um arquivo JPEG em a partir da image.
                //imagejpeg ( resource $image [, string $filename [, int $quality ]] ) : bool
                $resultado = imagejpeg($imagem_nova,  $pastaDestino . $nome, 72);
                break;
            case 3:
                // Emite ou grava uma imagemPNG a partir do parâmetro image.
                // imagepng ( resource $image [, mixed $to [, int $quality [, int $filters ]]] ) : bool
                $resultado = imagepng($imagem_nova, $pastaDestino . $nome);
                break;
            case 6:
                // imagewbmp() mostra ou salva uma versão WBMP da dada image.
                // imagewbmp ( resource $image [, string $filename [, int $foreground ]] ) : bool
                $resultado = imagewbmp($imagem_nova, $pastaDestino . $nome);
                break;
            default:
                echo '';
                break;
        }
        // imagedestroy() libera qualquer memória associada com a imagem image.
        // imagedestroy ( resource $image ) : bool
        if ($resultado) {
            imagedestroy($imagem_original);
            imagedestroy($imagem_nova);
            echo "As images da pasta { $pastaOrigem } foram redimensionada e copiada para a pasta {$pastaOrigem} <br>";
        }
    }
} else {
    echo " Pasta não existe ";
}
