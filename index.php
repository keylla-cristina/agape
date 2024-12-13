<?php
// Configuração do banco de dados
$host = 'localhost';
$dbname = 'hospital_agape';
$user = 'root';
$password = '1234';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Inicia a sessão
session_start();

// Página a ser exibida (home por padrão)
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Ágape</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header-container">
        <h1 class="logo">Hospital Ágape</h1>
        <nav>
            <ul class="menu">
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="index.php?page=servicos">Serviços</a></li>
                <li><a href="index.php?page=cadastro">Cadastro</a></li>
                <li><a href="index.php?page=login">Login</a></li>
                <li><a href="index.php?page=feedback">Feedback</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <?php
    if ($page === 'home') {
        echo "<section class='hero'>
                <h2>Bem-vindo ao Hospital Ágape</h2>
                <p>Excelência em cuidados médicos para você e sua família.</p>
                <a href='index.php?page=servicos' class='cta'>Conheça nossos serviços</a>
              </section>
              <section class='section'></section>
              <section class='sobre'>
                <div class='text' id='sobre'>
                    <h1>Hospital Ágape</h1>
                    <p>Com uma ampla gama de serviços, incluindo como pronto-socorro, internações, cirurgias, e muito mais. O Hospital Ágape se destaca por oferecer um atendimento completo e personalizado. Nossa equipe multidisciplinar, composta por profissionais altamente qualificados, está sempre à disposição para proporcionar o melhor cuidado aos nossos pacientes.</p>
                </div>
                    <h1>Médicos Renomados</h1><br>
                <div class='doctor'>
                        <div class='card'>
                            <div class='img'>
                                <img src='img/doctor (1).jpg' height='200px'>
                            </div>
                            <div class='texto'>
                                Dr. Antônio Santana - Pediatra
                            </div>
                        </div>

                        <div class='card'>
                            <div class='img'>
                                <img src='img/doctor (2).jpg' height='200px'>
                            </div>
                            <div class='texto'>
                                Dra. Maria Fernanda - Ginecologista
                            </div>
                        </div>

                        <div class='card'>
                            <div class='img'>
                                <img src='img/doctor (3).jpg' height='200px'>
                            </div>
                            <div class='texto'>
                                Dr. Charles Dias - Cirurgião Geral
                            </div>
                        </div>
                </div>
              </section>";
    } 
    elseif ($page === 'servicos') {
        echo "<section class='services'>
                <h1>Nossos Serviços</h1>
                <div class='services-container'>
                    <div class='serv'>

                    <div class='s serv1'>

                        <div class='conteudo'>

                            <img src='img/doctor.png' height='150em'>

                            <h2>Consultas Médicas</h2>

                        </div>

                    </div>

                    <div class='s serv2'>

                        <div class='conteudo'>

                            <p>Agende consultas com especialistas de diversas áreas.</p>

                        </div>

                    </div>
                </div>  
                <div class='serv'>

                    <div class='s serv1'>

                        <div class='conteudo'>

                            <img src='img/injection.png' height='150em'>

                            <h2>Exames Laboratoriais</h2>

                        </div>

                    </div>

                    <div class='s serv2'>

                        <div class='conteudo'>

                            <p>Realize exames rápidos e precisos com resultados confiáveis.</p>

                        </div>

                    </div>

                </div>

                <div class='serv' id='s'>

                    <div class='s serv1'>

                        <div class='conteudo'>

                            <img src='img/emergency-call.png' height='150em'>

                            <h2>Emergências 24h</h2>

                        </div>

                    </div>

                    <div class='s serv2'>

                        <div class='conteudo'>

                            <p>Atendimento médico para emergências durante todo o dia.</p>

                        </div>

                    </div>
                </div>

                <div class='serv' id='s'>

                    <div class='s serv1'>

                        <div class='conteudo'>

                            <img src='img/pediatria.png' height='150em'>

                            <h2>Atendimento Pediátrico</h2>

                        </div>

                    </div>

                    <div class='s serv2'>

                        <div class='conteudo'>

                            <p>Cuidado especializado para crianças e adolescentes.</p>

                        </div>

                    </div>

                </div>

                

    </section>";
    } elseif ($page === 'cadastro') {
        // Página de cadastro
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute(['nome' => $nome, 'email' => $email, 'senha' => $senha]);
                echo "<p>Cadastro realizado com sucesso! Você já pode fazer login.</p>";
            } catch (PDOException $e) {
                echo "<p>Erro ao cadastrar: " . $e->getMessage() . "</p>";
            }
        }

        echo '<section class="formulario">
                <div class="div">
                <div class="form-section">
                    <h2>Cadastro</h2>
                    <form action="" method="POST" class="form">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" required>
                        <button type="submit" class="btn">Cadastrar</button>
                    </form>
                </div>
                </div>
              </section>';
    } elseif ($page === 'login') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario'] = $usuario;
                echo "<p>Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($usuario['nome']) . ".</p>";
            } else {
                echo "<p>Email ou senha incorretos.</p>";
            }
        }

        echo '<section class="formulario">
              <div class="div">  
              <div class="form-section">
                <h2>Login</h2>
                <form action="" method="POST" class="form">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="submit" class="btn">Entrar</button>
                </form>
              </div>
              </div>
              <section>';
    } elseif ($page === 'feedback') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $comentario = $_POST['comentario'];

            $sql = "INSERT INTO feedbacks (nome, comentario) VALUES (:nome, :comentario)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nome' => $nome, 'comentario' => $comentario]);
            echo "<p>Obrigado pelo feedback!</p>";
        }

        $sql = "SELECT nome, comentario FROM feedbacks ORDER BY data DESC";
        $stmt = $pdo->query($sql);

        echo '<section class="feedback-section">
                <h2>Feedback dos Pacientes</h2>
                <form action="" method="POST" class="form">
                    <label for="nome">Seu Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                    <label for="comentario">Comentário:</label>
                    <textarea id="comentario" name="comentario" required></textarea>
                    <button type="submit" class="btn">Enviar</button>
                </form>
                <h3>Depoimentos</h3>';
        while ($feedback = $stmt->fetch()) {
            echo "<div class='feedback'>
                    <strong>{$feedback['nome']}:</strong>
                    <p>{$feedback['comentario']}</p>
                  </div>";
        }
        echo '</section>';
    } else {
        echo '<p>Página não encontrada!</p>';
    }
    ?>
</main>

<footer>
    <p>&copy; 2024 Hospital Ágape. Todos os direitos reservados.</p>
</footer>
</body>
</html>
