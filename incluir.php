<?php

// Conexão com o banco de dados
$host = "localhost";
$user = "higor";
$pass = "93530504";
$db = "alunos";

// Conectar ao banco de dados
$mysqli = mysqli_connect($host, $user, $pass, $db);

// Verificar se ocorreu algum erro de conexão
if (!$mysqli) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recuperar a lista de alunos do formulário
    $alunos = $_POST['alunos'];

    // Percorrer a lista de alunos e inseri-los no banco de dados
    foreach ($alunos as $aluno) {
        $nome = $aluno['nome'];
        $matricula = $aluno['matricula'];
        $curso = $aluno['curso'];

        $sql = "INSERT INTO alunos (nome, matricula, curso) VALUES ('$nome', '$matricula', '$curso')";
        $resultado = mysqli_query($mysqli, $sql);

        // Verificar se a inclusão ocorreu com sucesso
        if (!$resultado) {
            echo "Erro ao cadastrar aluno: " . mysqli_error($mysqli);
            break;
        }
    }

    // Verificar se todos os alunos foram cadastrados com sucesso
    if ($resultado) {
        echo "Alunos cadastrados com sucesso!";
    }
}

// Fechar a conexão com o banco de dados
mysqli_close($mysqli);

?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>

<body>
    <form method="post">

        <h2>Adicionar alunos</h2>

        <div id="alunos-container">
            <div class="aluno">
                <label for="nome">Nome:</label>
                <input type="text" name="alunos[0][nome]" required>

                <label for="matricula">Matrícula:</label>
                <input type="text" name="alunos[0][matricula]" required>

                <label for="curso">Curso:</label>
                <input type="text" name="alunos[0][curso]" required>
            </div>
        </div>

        <button type="button" onclick="addAluno()">Adicionar outro aluno</button>
        <br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <script>
    let contador = 0;
    const alunosContainer = document.getElementById('alunos-container');

    function addAluno() {
        contador++;
        const div = document.createElement('div');
        div.classList.add('aluno');
        div.innerHTML = `
                <label for="nome">Nome:</label>
                <input type="text" name="alunos[${contador}][nome]" required>

                <label for="matricula">Matrícula:</label>
                <input type="text" name="alunos[${contador}][matricula]" required>

                <label for="curso">Curso:</label>
                <input type="text" name="alunos[${contador}][curso]" required>
            `;
        alunosContainer.appendChild(div);
    }
    </script>
</body>

</html>