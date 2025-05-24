<?php
    echo $this->layout("_theme");
?>
<?php
  $this->start("specific-script");
?>
<script type="module" src="<?= url("assets/js/web/login.js"); ?>" async></script>
<?php
    $this->end();
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Crie sua conta</h1>
                <p>Junte-se ao Clube de Heróis e tenha acesso a conteúdos exclusivos</p>
            </div>
            
            <!-- Contêiner para as mensagens toast -->
            <div id="toast-container"></div>
            
            <form id="formRegister" class="auth-form">
                <div class="form-group">
                    <label for="name">Nome completo:</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome completo" required>
                </div>
                
                <div class="form-group">
                    <label for="number">CPF:</label>
                    <input type="email" id="email" name="email" placeholder="Seu CPF" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Seu melhor email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" placeholder="Crie uma senha segura" required>
                </div>
                
                <button type="submit" class="btn-submit">Cadastrar</button>
            </form>
            
            <div class="auth-footer">
                <p>Já possui uma conta? <a href="<?= url('login'); ?>">Faça login</a></p>
            </div>
        </div>
    </div>
</section>