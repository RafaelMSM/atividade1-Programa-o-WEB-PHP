<?php
require_once("config.php");

function inserirProfessor($nome, $formacao, $telefone, $email, $aluno_id)
{
    global $pdo;
    $sql = "INSERT INTO professores (nome, formacao, telefone, email, aluno_id) VALUES (:nome, :formacao, :telefone, :email, :aluno_id)";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(":nome", $nome);
    $stm->bindParam(":formacao", $formacao);
    $stm->bindParam(":telefone", $telefone);
    $stm->bindParam(":email", $email);
    $stm->bindParam(":aluno_id", $aluno_id);

    try {
        $stm->execute();
        header("Location: index.php?inserir=ok");
        exit();
    } catch (PDOException $e) {
        die("Erro ao inserir professor: " . $e->getMessage());
    }
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
<h3>Inserir Professor</h3>
<form action="inserir_professor.php" method="POST">
    <div class="row">
        <div class="col-7">
            <label for="nome" class="form-label">Informe o nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required/>
        </div>
        <div class="col-5">
            <label for="formacao" class="form-label">Informe a formação:</label>
            <input type="text" id="formacao" name="formacao" class="form-control" required/>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="telefone" class="form-label">Informe o telefone:</label>
            <input type="text" id="telefone" name="telefone" class="form-control" required/>
        </div>
        <div class="col-6">
            <label for="email" class="form-label">Informe o email:</label>
            <input type="email" id="email" name="email" class="form-control" required/>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for="aluno_id" class="form-label">Informe o ID do aluno:</label>
            <input type="text" id="aluno_id" name="aluno_id" class="form-control" required/>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" type="submit">Salvar Dados</button>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
