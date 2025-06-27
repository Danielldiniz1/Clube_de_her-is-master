<?php
echo $this->layout("_theme");
?>
<link rel="stylesheet" href="css/style.css">
    <div class="admin-container">
        <main class="main-content">
            <h2>Gerenciador de Produtos</h2>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>ID Clube</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Action Figure Homem de Ferro</td>
                        <td>R$ 299,90</td>
                        <td>50</td>
                        <td>101</td>
                        <td>
                            <button class="btn btn-secondary btn-action">Editar</button>
                            <button class="btn btn-primary btn-action">Excluir</button>
                        </td>
                    </tr>
                    </tbody>
            </table>

            <div class="form-container">
                <h3>Adicionar / Editar Produto</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Nome do Produto:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="club_id">ID do Clube:</label>
                        <input type="number" id="club_id" name="club_id" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Preço (R$):</label>
                        <input type="text" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Estoque:</label>
                        <input type="number" id="stock" name="stock" value="0">
                    </div>
                    <div class="form-group">
                        <label for="fandom">Fandom:</label>
                        <input type="text" id="fandom" name="fandom">
                    </div>
                    <div class="form-group">
                        <label for="rarity">Raridade:</label>
                        <select id="rarity" name="rarity">
                            <option value="common">Comum</option>
                            <option value="rare">Raro</option>
                            <option value="exclusive">Exclusivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                     <div class="form-group">
                        <label for="image_url">URL da Imagem:</label>
                        <input type="text" id="image_url" name="image_url">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Produto</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>