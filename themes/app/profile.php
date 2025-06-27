<?php
    echo $this->layout("_theme");
?>
<div class="container">
        <h2>Meu Perfil</h2>
        <form class="profile-form">

            <div class="profile-pic-area">
                <img src="https://via.placeholder.com/150" alt="Foto de Perfil" class="profile-pic">
                <input type="file" id="upload-pic" accept="image/*">
                <label for="upload-pic" class="btn btn-secondary">Alterar Foto</label>
            </div>

            <div class="form-group">
                <label for="name">Nome Completo</label>
                <input type="text" id="name" value="Bruce Wayne">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" value="bruce@wayne-enterprises.com" disabled>
            </div>
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input type="password" id="password" placeholder="Deixe em branco para não alterar">
            </div>

            <div class="address-grid">
                <h3 class="form-section-title">Endereço de Entrega</h3>

                <div class="form-group full-width">
                    <label for="street">Logradouro (Rua, Av.)</label>
                    <input type="text" id="street" value="Avenida das Indústrias">
                </div>

                <div class="form-group">
                    <label for="number">Número</label>
                    <input type="text" id="number" value="1007">
                </div>

                <div class="form-group">
                    <label for="complement">Complemento</label>
                    <input type="text" id="complement" value="Mansão Wayne">
                </div>

                <div class="form-group">
                    <label for="zipcode">CEP</label>
                    <input type="text" id="zipcode" value="12345-678">
                </div>

                <div class="form-group">
                    <label for="city">Cidade</label>
                    <input type="text" id="city" value="Gotham City">
                </div>
                
                <div class="form-group">
                    <label for="state">Estado</label>
                    <input type="text" id="state" value="NJ">
                </div>
            </div>

            <button type="submit" class="btn" style="margin-top: 30px;">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>