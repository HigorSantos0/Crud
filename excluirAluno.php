<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Aluno</title>
</head>

<body>
    <h1>Excluir Aluno</h1>
    <form method="post" action="excluirAluno.php">
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula"><br>

        <input type="submit" value="Excluir">
    </form>
</body>

</html>

<?php

// Conexão com o banco de dados
$host = "localhost";
$user = "higor";
$pass = "93530504";
$db = "alunos";

// Conectar ao banco de dados
$conexao = mysqli_connect($host, $user, $pass, $db);

// Verificar se ocorreu algum erro de conexão
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Recuperando os dados do formulário
if (!isset($_POST['matricula'])) {
    echo "Matrícula não informada.";
    exit();
}

$matricula = $_POST['matricula'];

// restante do código aqui


// Excluindo o aluno da tabela de alunos
$sql = "DELETE FROM alunos WHERE matricula = '$matricula'";
$resultado = mysqli_query($conexao, $sql);

// Verificando se a exclusão ocorreu com sucesso
if ($resultado === TRUE) {
    echo "Aluno excluído com sucesso!";
} else {
    echo "Erro ao excluir aluno: " . mysqli_error($conexao);
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
