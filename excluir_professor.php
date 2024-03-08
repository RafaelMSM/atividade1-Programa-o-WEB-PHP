<?php
require_once("config.php");

function excluirProfessor($id)
{
    global $pdo;
    $sql = "DELETE FROM professores WHERE id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id", $id);
    $stm->execute();
    header("Location: index.php?excluir=ok");
    exit();
}

function consultarProfessorPorId($id)
{
    global $pdo;
    $sql = "SELECT * FROM professores WHERE id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":id", $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
}

if ($_POST) {
    if (isset($_POST['id'])) {
        excluirProfessor($_POST['id']);
    }
} elseif (isset($_GET['id'])) {
    $professor = consultarProfessorPorId($_GET['id']);
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body class="container">
    <h3>Excluir Professor</h3>
    <form action="excluir_professor.php" method="POST">
      <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
      <div class="row">
        <div class="col-7">
          <label for="nome" class="form-label">Informe o nome:</label>
          <input disabled value="<?=$professor['nome']?>" type="text" id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="formacao" class="form-label">Informe a formação:</label>
          <input disabled value="<?=$professor['formacao']?>" type="text" id="formacao" name="formacao" class="form-control" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label for="telefone" class="form-label">Informe o telefone:</label>
          <input disabled value="<?=$professor['telefone']?>" type="text" id="telefone" name="telefone" class="form-control" required/>
        </div>
        <div class="col-6">
          <label for="email" class="form-label">Informe o email:</label>
          <input disabled value="<?=$professor['email']?>" type="email" id="email" name="email" class="form-control" required/>
        </div>
      </div>
      <div class="row">
    <div class="col-6">
        <label for="aluno_id" class="form-label">Informe o aluno:</label>
        <input disabled value="<?= isset($professor['aluno_id']) ? $professor['aluno_id'] : '' ?>" type="text" id="aluno_id" name="aluno_id" class="form-control" required/>
    </div>
</div>
      <div class="row">
        <div class="col">
          <button class="btn btn-danger" type="submit">Excluir Dados</button>
        </div>
      </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
