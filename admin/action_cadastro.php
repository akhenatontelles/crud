<?php

require '../conexao.php';

// Atribui uma conexão PDO
$conexao = conexao::getInstance();

// Recebe os dados enviados pela submissão
$acao  = (isset($_POST['acao'])) ? $_POST['acao'] : '';
$id    = (isset($_POST['id'])) ? $_POST['id'] : '';
$vaga = (isset($_POST['vaga'])) ? $_POST['vaga'] : '';
$foto_atual = (isset($_POST['foto_atual'])) ? $_POST['foto_atual'] : '';



// Valida os dados recebidos
$mensagem = '';
if ($acao == 'editar' && $id == '') :
    $mensagem .= '<li>ID do registros desconhecido.</li>';
endif;

if ($acao == 'incluir') :

    $nome_foto = 'padrao.jpg';
    if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) :

        $extensoes_aceitas = array('pdf');
        $extensao = strtolower(end(explode('.', $_FILES['foto']['name'])));

        // Validamos se a extensão do arquivo é aceita
        if (array_search($extensao, $extensoes_aceitas) === false) :
            echo "<h1>Extensão Inválida!</h1>";
            exit;
        endif;

        // Verifica se o upload foi enviado via POST
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) :



            // Verifica se o diretório de destino existe, senão existir cria o diretório
            if (!file_exists("../upload")) :
                mkdir("../upload");
            endif;




            // Monta o caminho de destino com o nome do arquivo

            $nome_foto = md5(uniqid(time() . rand(0, 99))) . "." . $extensoes_aceitas[0];

            // Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], '../upload/' . $nome_foto)) :
                echo "Houve um erro ao gravar arquivo na pasta de destino!";
            endif;

            //comprimir e redimensionar

            


        endif;
    endif;

    $sql = 'INSERT INTO vagas (vaga, foto)
							   VALUES(:vaga,  :foto)';

    $stm = $conexao->prepare($sql);
    $stm->bindValue(':vaga', $vaga);
    $stm->bindValue(':foto', $nome_foto);

    $retorno = $stm->execute();

        echo "<script>location.href='index.php';</script>";
die();
endif;




    
    



// Verifica se foi solicitada a exclusão dos dados
if ($acao == 'excluir') :

    // Captura o nome da foto para excluir da pasta
    $sql = "SELECT foto FROM vagas WHERE id = :id AND foto <> 'padrao.jpg'";
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':id', $id);
    $stm->execute();
    $cliente = $stm->fetch(PDO::FETCH_OBJ);

    if (!empty($cliente) && file_exists('upload/' . $cliente->foto)) :
        unlink("upload/" . $cliente->foto);
    endif;

    // Exclui o registro do banco de dados
    $sql = 'DELETE FROM vagas WHERE id = :id';
    $stm = $conexao->prepare($sql);
    $stm->bindValue(':id', $id);
    $retorno = $stm->execute();

    echo "<script>location.href='index.php';</script>";
die();
endif;
