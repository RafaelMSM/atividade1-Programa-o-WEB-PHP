<?php
    require_once("config.php");

    function consultarProfessorPorId($id){
        global $pdo;
        $sql = "SELECT * FROM professores WHERE id = :id";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(":id", $id);
        $result = $stm->execute();

        // Verifica se a consulta foi bem-sucedida
        if ($result === false) {
            die(print_r($stm->errorInfo(), true)); // Imprime informações sobre o erro
        }

        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    function alterarProfessor($id, $nome, $formacao, $telefone, $email, $aluno){
        global $pdo;
        $sql = "
            UPDATE professores SET nome = :nome, formacao = :formacao, telefone = :telefone, email = :email, aluno_id = :aluno
            WHERE id = :id
        ";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(":nome", $nome);
        $stm->bindParam(":formacao", $formacao);
        $stm->bindParam(":telefone", $telefone);
        $stm->bindParam(":email", $email);
        $stm->bindParam(":aluno", $aluno);
        $stm->bindParam(":id", $id);
        $result = $stm->execute();

        // Verifica se a atualização foi bem-sucedida
        if ($result === false) {
            die(print_r($stm->errorInfo(), true)); // Imprime informações sobre o erro
        }

        header("Location: index.php?alterar=ok");
        exit();
    }

    if ($_POST) {
        if (isset($_POST['nome']) && isset($_POST['formacao']) && isset($_POST['telefone']) && isset($_POST['email']) && isset($_POST['aluno'])) {
            alterarProfessor($_POST['id'], $_POST['nome'], $_POST['formacao'], $_POST['telefone'], $_POST['email'], $_POST['aluno']);
        }
    } elseif (isset($_GET['id'])) {
        $professor = consultarProfessorPorId($_GET['id']);

        // Verifica se a consulta retornou um resultado
        if ($professor === false) {
            die("Erro ao recuperar dados do professor.");
        }
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
    <h3>Alterar Professor</h3>
    <form action="alterar_professor.php" method="POST">
      <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
      <div class="row">
        <div class="col-7">
          <label for="nome" class="form-label">Informe o nome:</label>
          <input value="<?=$professor['nome']?>" type="text" id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
          <label for="formacao" class="form-label">Informe a formação:</label>
          <input value="<?=$professor['formacao']?>" type="text" id="formacao" name="formacao" class="form-control" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label for="telefone" class="form-label">Informe o telefone:</label>
          <input value="<?=$professor['telefone']?>" type="text" id="telefone" name="telefone" class="form-control" required/>
        </div>
        <div class="col-6">
          <label for="email" class="form-label">Informe o email:</label>
          <input value="<?=$professor['email']?>" type="email" id="email" name="email" class="form-control" required/>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <label for="aluno" class="form-label">Informe o aluno:</label>
          <input value="<?=$professor['aluno']?>" type="text" id="aluno" name="aluno" class="form-control" required/>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <button class="btn btn-primary" type="submit">Salvar Dados</button>
        </div>
      </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
