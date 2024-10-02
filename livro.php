<?php

// Conexão
$servidor = 'localhost';
$banco = 'livraria'; 
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST['titulo'];
        $idioma = $_POST['idioma'];
        $qtd_paginas = $_POST['qtd_paginas'];
        $editora = $_POST['editora'];
        $data_publicacao = $_POST['data_publicacao'];
        $isbn = $_POST['isbn'];

        echo "Recebido: <br>";
        echo "Título do Livro: " . htmlspecialchars($titulo) . "<br>";
        echo "Idioma: " . htmlspecialchars($idioma) . "<br>";
        echo "Quantidade de Páginas: " . htmlspecialchars($qtd_paginas) . "<br>";
        echo "Editora: " . htmlspecialchars($editora) . "<br>";
        echo "Data da Publicação: " . htmlspecialchars($data_publicacao) . "<br>";
        echo "ISBN: " . htmlspecialchars($isbn) . "<br>";

        $codigoSQL = "INSERT INTO `livros` (`id`, `titulo`, `idioma`, `qtd_paginas`, `editora`, `data_publicacao`, `isbn`) VALUES (NULL, :titulo, :idioma, :qtd_paginas, :editora, :data_publicacao, :isbn)";

        $comando = $conexao->prepare($codigoSQL);
        $resultado = $comando->execute(array(
            ':titulo' => $titulo,
            ':idioma' => $idioma,
            ':qtd_paginas' => $qtd_paginas,
            ':editora' => $editora,
            ':data_publicacao' => $data_publicacao,
            ':isbn' => $isbn
        ));

        if ($resultado) {
            echo "Dados salvos com sucesso!";
        } else {
            echo "Erro ao salvar os dados!";
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

$conexao = null;

?>
