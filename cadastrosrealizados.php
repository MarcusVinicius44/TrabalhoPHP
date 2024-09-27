<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <link rel="stylesheet" href="pagina.php">

    <title>Document</title>
</head>
<body>
<nav>
        <ul>
            <li>
                <a href="pagina.php"> Formulário</a>
            </li>
            <li>
                <a href="cadastrosrealizados.php" class="cad"> Cadastros</a>
            </li>
        </ul>
    </nav>

<h2>Cadastros Realizados</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th>Gênero</th>
                <th>Biografia</th>
            </tr>
        </thead>
        <tbody>
    <?php
    // Verificar se o arquivo existe e ler os cadastros
    if (file_exists('cadastros.txt')) {
        $arquivo = fopen('cadastros.txt', 'r');
        
        // Ler cada linha do arquivo e exibir na tabela
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(',', $linha);
            echo "<tr>";
            echo "<td data-label='Nome'>" . htmlspecialchars($dados[0]) . "</td>";
            echo "<td data-label='Email'>" . htmlspecialchars($dados[1]) . "</td>";
            echo "<td data-label='Data de Nascimento'>" . htmlspecialchars($dados[2]) . "</td>";
            echo "<td data-label='Gênero'>" . htmlspecialchars($dados[3]) . "</td>";
            echo "<td data-label='Biografia'>" . htmlspecialchars($dados[4]) . "</td>";
            echo "</tr>";
        }
        fclose($arquivo);
    } else {
        echo "<tr><td colspan='5'>Nenhum cadastro encontrado.</td></tr>";
    }
    ?>
</tbody>

    </table>
</body>
</html>