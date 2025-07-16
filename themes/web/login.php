<?php
    echo $this->layout("_theme");
?>
<?php
  $this->start("specific-script");
?>
<script type="module" src="<?= url("assets/js/web/scripts-login.js"); ?>" async></script>
<?php
    $this->end();
?>

<section class="auth-section">
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Acesse sua conta</h1>
                <p>Entre com suas credenciais para acessar sua área exclusiva</p>
            </div>
            
            <!-- Contêiner para as mensagens toast -->
            <div id="toast-container"></div>
            
            <form id="formLogin" class="auth-form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Seu email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" placeholder="Sua senha" required>
                </div>
                
                <button type="submit" class="btn-submit">Entrar</button>
                <p id="result"></p>
            </form>
            
            <div class="auth-footer">
                <p>Ainda não tem uma conta? <a href="<?= url('cadastro'); ?>">Cadastre-se</a></p>
            </div>
        </div>
    </div>
</section>