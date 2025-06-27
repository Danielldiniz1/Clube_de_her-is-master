<?php
echo $this->layout("_theme");
?>
<link rel="stylesheet" href="css/style.css">
    <div class="admin-container">

        <main class="main-content">
            <h2>Gerenciador de Clubes</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome do Clube</th>
                        <th>ID do Criador</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>Clube dos Vingadores</td>
                        <td>2</td>
                        <td>Sim</td>
                        <td>
                            <button class="btn btn-secondary btn-action">Editar</button>
                            <button class="btn btn-primary btn-action">Excluir</button>
                        </td>
                    </tr>
                    </tbody>
            </table>

            <div class="form-container">
                <h3>Adicionar / Editar Clube</h3>
                <form>
                    <div class="form-group">
                        <label for="club_name">Nome do Clube:</label>
                        <input type="text" id="club_name" name="club_name" required>
                    </div>
                    <div class="form-group">
                        <label for="user_id">ID do Usuário (Criador):</label>
                        <input type="number" id="user_id" name="user_id" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="is_active" checked>
                            Clube Ativo
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Clube</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>