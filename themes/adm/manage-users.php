<?php
echo $this->layout("_theme");
?>
<link rel="stylesheet" href="css/style.css">
    <div class="admin-container">
        <main class="main-content">
            <h2>Gerenciador de Usuários</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Função (Role)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Admin Master</td>
                        <td>admin@email.com</td>
                        <td>admin</td>
                        <td>
                            <button class="btn btn-secondary btn-action">Editar</button>
                            <button class="btn btn-primary btn-action">Excluir</button>
                        </td>
                    </tr>
                    </tbody>
            </table>

            <div class="form-container">
                <h3>Adicionar / Editar Usuário</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Função:</label>
                        <select id="role" name="role">
                            <option value="creator">Creator</option>
                            <option value="store">Store</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Usuário</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>