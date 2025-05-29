<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>..:: Área Administrativa ::..</title>
    <link rel="stylesheet" href="<?= url("assets/css/web/main.css"); ?>"> <link rel="stylesheet" href="<?= url("assets/css/adm/styles.css"); ?>"> </head>
<body class="admin-area">
    <aside class="admin-sidebar">
        <h2>Área Administrativa</h2>
        <nav>
            <?php
            // Obtém o URI atual usando a função da extensão URI do Plates.
            $currentUri = $this->uri();

            // Assume que o caminho base do projeto é '/Clube_de_her-is-master'
            // Você pode obter CONF_URL_TEST e parsear a URL para pegar o path se for dinâmico
            $basePath = '/Clube_de_her-is-master';
            $cleanUri = str_replace($basePath, '', $currentUri);

            // Garante que o cleanUri comece com '/' se não for o caso
            if (empty($cleanUri) || $cleanUri[0] !== '/') {
                $cleanUri = '/' . $cleanUri;
            }
            ?>
            <div class="admin-menu-toggle">☰</div>
            <ul class="admin-nav-menu">
                <li><a href="<?= url("/admin"); ?>" class="<?= ($cleanUri === '/admin' || $cleanUri === '/admin/') ? 'active' : '' ?>">Dashboard</a></li>
                <li><a href="<?= url("/admin/cadastro-produtos"); ?>" class="<?= ($cleanUri === '/admin/cadastro-produtos') ? 'active' : '' ?>">Gerenciar Produtos</a></li>
                <li><a href="#">Gerenciar Usuários</a></li>
                <li><a href="#">Relatórios</a></li>
                <li><a href="<?= url("/login"); ?>">Sair</a></li>
            </ul>
        </nav>
    </aside>
    <div class="admin-content">
        <div class="admin-main-content"> <?php
                echo $this->section("content");
            ?>
        </div>
        <footer class="admin-footer">
            © 2025 Clube de Heróis - Painel Administrativo.
        </footer>
    </div>

    <script>
        // Script para toggle do menu em mobile para a área ADM
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.admin-menu-toggle');
            const navMenu = document.querySelector('.admin-nav-menu');

            if (menuToggle && navMenu) {
                menuToggle.addEventListener('click', function() {
                    navMenu.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>