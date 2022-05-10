
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.tiny.cloud/1/4yaoq7b06okhamkb5o9vzr6wj4r7da95z2wrn5u8zj394ln6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<?php require 'conexao.php';

$id = filter_input(INPUT_GET, 'id');
if($id){

    $sql = $pdo->prepare("SELECT * FROM vagas WHERE id = :id");
    $sql->bindValue(':id',$id);
    $sql->execute();

    if($sql->rowCount() > 0){

    $info =$sql->fetch(PDO:: FETCH_ASSOC);

    $info['vaga'];

}else{
    header("Location:vaga.php");
    exit;
}
}else{
    header("Location: index.php");
    exit;
}

?>


<br>


<div style="width: 70%; margin: 0 auto;box-shadow: 0 0 20px black; border-radius: 10px; margin-top:50px; margin-bottom:50px" class="card">
  <h5 style="text-align: center;" class="card-header"><?= $info['vaga']; ?></h5>
  <div class="card-body">
    
    <p class="card-text"><?= $info['texto']; ?></p>
    
  </div>
</div>
</body>
</html>
