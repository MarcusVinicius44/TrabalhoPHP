<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li>
                <a href="pagina.php"> Formulário</a>
            </li>
            <li>
                <a href="cadastrosrealizados.php"> Cadastros</a>
            </li>
        </ul>
    </nav>
<?php
// Inicializando variáveis com valores padrão
$nome = '';
$email = '';
$data = '';
$genero = '';
$bio = '';
$erro = '';
$mostrar_formulario = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data = $_POST['data_nascimento'];
    $genero = $_POST['genero'];
    $bio = $_POST['biografia'];
    
    // Verificar se todos os campos foram preenchidos
    if (empty($nome) || empty($email) || empty($data) || empty($genero) || empty($bio)) {
        $erro = 'Todos os campos devem ser preenchidos!';
    } elseif (count(explode(' ', trim($nome))) < 2) {
        $erro = 'O nome deve conter pelo menos dois nomes (primeiro nome e sobrenome).';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'E-mail inválido!';
    } else {
        // Salvar os dados do cadastro em um arquivo de texto
        $arquivo = fopen("cadastros.txt", "a");
        $linha = $nome . "," . $email . "," . $data . "," . $genero . "," . $bio . "\n";
        fwrite($arquivo, $linha);
        fclose($arquivo);
        echo "<script>alert('Cadastro concluído com sucesso!');</script>";
        $mostrar_formulario = false;
        header("Location: http://localhost/trabalhoPHP/cadastrosrealizados.php");
    }
}
?>

<div class="container">
    <?php if ($erro) { ?>
        <div class="error-message"><?php echo $erro; ?></div>
    <?php } ?>
    
    <?php if ($mostrar_formulario) { ?>
        <h1>Formulário de Cadastro</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="formulario">
            <div class="campo">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            
            <div class="campo">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($data); ?>" required>
            </div>
            
            <div class="campo">
                <label for="genero">Gênero:</label>
                <select name="genero" required>
                    <option value="masculino" <?php echo ($genero == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="feminino" <?php echo ($genero == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="outros" <?php echo ($genero == 'outros') ? 'selected' : ''; ?>>Outros</option>
                </select>
            </div>
            
            <div class="campo">
                <label for="biografia">Biografia:</label>
                <textarea id="biografia" name="biografia" rows="4" cols="50" required><?php echo htmlspecialchars($bio); ?></textarea>
            </div>
            
            <input type="submit" value="Enviar" class="botao-enviar">
        </form>
    <?php } ?>
</div>

</body>
</html>
