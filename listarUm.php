<form method="get" action="">
    <label for="matricula">Matrícula:</label>
    <input type="text" name="matricula" id="matricula">
    <button type="submit">Buscar</button>
</form>

<?php

// Conexão com o banco de dados
$host = "localhost";
$user = "higor";
$pass = "93530504";
$db = "alunos";

// Connect to the database
$mysqli = mysqli_connect($host, $user, $pass, $db);

// Verificando se a matrícula foi informada
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];
} else {
    echo "Matrícula não informada.";
    exit;
}

// Buscando os dados do aluno no banco de dados
$sql = "SELECT * FROM alunos WHERE matricula = '$matricula'";
$resultado = mysqli_query($mysqli, $sql);

// Verificando se o aluno foi encontrado
if (mysqli_num_rows($resultado) == 0) {
    echo "Aluno não encontrado.";
    exit;
}

// Exibindo os dados do aluno em uma tabela HTML
$linha = mysqli_fetch_array($resultado);
echo "<table>";
echo "<tr><th>Nome</th><th>Matrícula</th><th>Curso</th></tr>";
echo "<tr><td>" . $linha['nome'] . "</td><td>" . $linha['matricula'] . "</td><td>" . $linha['curso'] . "</td></tr>";
echo "</table>";

mysqli_close($mysqli);
