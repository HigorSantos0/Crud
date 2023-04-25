<?php

// Conexão com o banco de dados
$host = "localhost";
$user = "higor";
$pass = "93530504";
$db = "alunos";

// Connect to the database
$mysqli = mysqli_connect($host, $user, $pass, $db);

// Selecionando todos os alunos cadastrados na tabela de alunos
$sql = "SELECT * FROM alunos";
$resultado = mysqli_query($mysqli, $sql);


// Exibindo os alunos em uma tabela HTML
echo "<table>";
echo "<tr><th>Nome</th><th>Matrícula</th><th>Curso</th></tr>";
while ($linha = mysqli_fetch_array($resultado)) {
    echo "<tr><td>" . $linha['nome'] . "</td><td>" . $linha['matricula'] . "</td><td>" . $linha['curso'] . "</td></tr>";
}
echo "</table>";
