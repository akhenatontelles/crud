<?php
session_start();

if(isset($_SESSION['id'])&& empty($_SESSION['id'])==false){
    echo "";
}else{

    header("Location:login.php");

}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Cadastrar</title>
</head>

<body>

                    <br><br>
                        <section style="width: 70%; margin:0 auto">

                        <div style="float: left;"><h2>CADASTRAR VAGAS</h2></div>

                        <a style="float: right;" class="btn btn-danger" href="sair.php">
                             Sair
                        </a>

                        </section><br><br>
                   
                    

    <section style="margin: 0 auto; width:70% ">

        <div class="card mb-3">

            <div class="card-body">
                <form action="action_cadastro.php" method="post" enctype='multipart/form-data'>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">VAGA</label>
                        <input type="text" name="vaga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>


                    <div class="mb-3">
  <label for="formFileReadonly" class="form-label">Readonly file input example</label>
  <input name="foto" class="form-control" type="file" id="formFileReadonly" readonly>
</div>


                    <input type="hidden" name="acao" value="incluir">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>

    </section>

    <section style="width: 60%; margin:0 auto">

        <?php
        require '../conexao.php';

        // Recebe o termo de pesquisa se existir


        // Verifica se o termo de pesquisa está vazio, se estiver executa uma consulta completa
        if (empty($termo)) :

            $conexao = conexao::getInstance();
            $sql = 'SELECT id, vaga FROM vagas ORDER BY id DESC';
            $stm = $conexao->prepare($sql);
            $stm->execute();
            $clientes = $stm->fetchAll(PDO::FETCH_OBJ);

        else :

            // Executa uma consulta baseada no termo de pesquisa passado como parâmetro
            $conexao = conexao::getInstance();



        endif;
        ?>

        <div class="separator mb-5"></div>
        <?php if (!empty($clientes)) : ?>
            </div>
            </div>

            <div class="row">
                <div class="col-12 " data-check-all="">



                    <?php foreach ($clientes as $cliente) : ?>

                        <div class="card d-flex flex-row mb-3">

                            <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">

                                    <p class="mb-1 text-muted text-small w-15 w-sm-100"><?= $cliente->vaga; ?></p>

                                    <div class="w-15 w-sm-100">



                                        <a href='javascript:void(0)' class="badge badge-pill badge-primary link_exclusao" rel="<?= $cliente->id ?>">Excluir</a>
                                    </div>
                                </div>


                            </div>
                        </div>

                    <?php

                    endforeach; ?>
                </div>
            </div>
        <?php else : ?>


            <h3 class="text-center text-primary">Não existem cadastrados!</h3>
        <?php endif; ?>

    </section>

    </div>
    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>

</html>