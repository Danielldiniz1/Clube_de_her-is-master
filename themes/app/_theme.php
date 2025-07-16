<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clube de heróis</title>
    <meta name="description" content="Plataforma white-label de clubes de assinatura geek para criadores de conteúdo e lojas" />
    <meta name="author" content="Clube de Heróis" />
    <meta property="og:title" content="Clube de Heróis - Plataforma de Assinatura Geek" />
    <meta property="og:description" content="Plataforma white-label de clubes de assinatura geek para criadores de conteúdo e lojas" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://lovable.dev/opengraph-image-p98pqg.png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@lovable_dev" />
    <meta name="twitter:image" content="https://lovable.dev/opengraph-image-p98pqg.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bangers&family=Roboto:wght@400;500;700&display=swap">
    <body>
    <div id="root"></div>
    <script src="https://cdn.gpteng.co/gptengineer.js" type="module"></script>
  </body>
</head>
    <link rel="stylesheet" href="<?= url("themes/app/style.css"); ?>">
<?php if ($this->section("specific-script")): ?>
<script src="assets/js/app/scripts-change-password.js" async></script>
    <?= $this->section("specific-script"); ?>
<?php endif; ?>
</head>
<body>
<header class="public-header"> <div class="container">
        <nav>
            <a href="<?= url(); ?>" class="logo comic-font">CLUBE DE HERÓIS</a>
            <ul class="nav-menu">
                <li><a href="<?= url('app/minhascompras'); ?>">Minhas compras</a></li>
                <li><a href="<?= url('app/produtos'); ?>">Produtos</a></li>
                <li><a href="<?= url('app/carrinho'); ?>">Meu carrinho</a></li>
                <li><a href="<?= url('app/meuclube'); ?>">Meu clube</a></li>
                <li><a href="<?= url('app/listadedesejos'); ?>">Lista de desejos</a></li>
                <li><a href="<?= url('app/perfil'); ?>">Perfil</a></li>     
                <a>
                <li id="change">Trocar senha</li>
                </a>        

            </ul>
        </nav>
    </div>
    <?php
  $this->start("specific-script");
?>
<script type="module" src="assets/js/app/scripts-change-password.js" async></script>
<?php
    $this->end();
?>
</header>
    <?php
    
echo '<main class="app-container">';
echo $this->section("content");
echo '</main>';
    ?>
    <div class="modal" id="modal">
     <link rel="stylesheet" href="<?= url("assets/css/app/switch.css"); ?>">

    <div class="modal-content">
      <h2>Alterar Senha</h2>
      <form>
        <label for="currentPassword">Senha Atual</label>
        <input type="password" id="currentPassword" name="currentPassword" required>

        <label for="newPassword">Nova Senha</label>
        <input type="password" id="newPassword" name="newPassword" required>

        <label for="confirmPassword">Confirmar Nova Senha</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <div class="buttons">
          <button type="submit" class="save">Salvar</button>
          <button type="button" class="cancel" id="cancel">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
<footer>
    <div class="container">
      <p class="footer-logo comic-font">CLUBE DE HERÓIS</p>
      <ul class="footer-links">
        <li><a href="#">Início</a></li>
        <li><a href="#plans">Planos</a></li>
        <li><a href="<?= url('sobre'); ?>">Sobre</a></li>
        <li><a href="<?= url('contato'); ?>">Contato</a></li>
      </ul>
      <div class="copyright">© 2025 Clube de Heróis. Todos os direitos reservados.</div>
    </div>
  </footer>
</body>
</html>