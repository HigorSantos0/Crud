<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>

<body>
    <form method="post" action="alterar.php">
        <table>
            <thead>
                <tr>
                    <th>Selecionar</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
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

                // Selecionar todos os alunos da tabela
                $sql = "SELECT * FROM alunos";
                $resultado = mysqli_query($mysqli, $sql);

                // Verificar se a seleção ocorreu com sucesso
                if ($resultado) {
                    // Exibir os alunos em uma tabela
                    while ($aluno = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='selecionados[]' value='" . $aluno['matricula'] . "'></td>";
                        echo "<td>" . $aluno['nome'] . "</td>";
                        echo "<td>" . $aluno['matricula'] . "</td>";
                        echo "<td>" . $aluno['curso'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Erro ao selecionar alunos: " . mysqli_error($mysqli);
                }

                // Fechar a conexão com o banco de dados
                mysqli_close($mysqli);
                ?>
            </tbody>
        </table>

        <label for="nome">Novo nome:</label>
        <input type="text" id="nome" name="nome"><br>

        <label for="curso">Novo curso:</label>
        <input type="text" id="curso" name="curso"><br>

        <input type="submit" value="Alterar selecionados">
    </form>
</body>

</html>

<?php
// Conexão com o banco de dados
$host = "localhost";
$user = "higor";
$pass = "93530504";
$db = "alunos";

// Connect to the database
$mysqli = mysqli_connect($host, $user, $pass, $db);

// Verificar se ocorreu algum erro de conexão
if (!$mysqli) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Verificar se foram selecionados alunos para alteração
if (isset($_POST['selecionados']) && is_array($_POST['selecionados'])) {

    // Recuperando os dados do formulário
    if (!isset($_POST['nome']) || !isset($_POST['curso'])) {
        echo "Nome ou curso não informados.";
        exit();
    }

    $nome = $_POST['nome'];
    $curso = $_POST['curso'];

    // Alterando os alunos selecionados
    foreach ($_POST['selecionados'] as $matricula) {
        $sql = "UPDATE alunos SET nome='$nome', curso='$curso' WHERE matricula=$matricula";
        $resultado = mysqli_query($mysqli, $sql);
        if (!$resultado) {
            echo "Erro ao alterar aluno com matrícula $matricula: " . mysqli_error($mysqli);
        }
    }
}
