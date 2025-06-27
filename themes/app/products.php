<?php
    echo $this->layout("_theme");
?>

<section class="products-section">
    <div class="container">
        <h1 class="section-title">NOSSOS PRODUTOS</h1>
        
        <div class="product-filters">
            <input type="text" placeholder="Buscar produtos..." class="filter-search">
            <select class="filter-select">
                <option value="">Todas as Categorias</option>
                <option value="hq">Quadrinhos</option>
                <option value="figure">Action Figures</option>
                <option value="shirt">Camisetas</option>
                <option value="collectible">Colecionáveis</option>
            </select>
        </div>

        <div class="products-grid">
            <div class="product-card comic-border">
                <img src="<?= url('/assets/img/imagem.jpg') ?>"alt="Produto 1" class="product-image">
                <h3 class="product-title">Action Figure do Batman</h3>
                <p class="product-description">Detalhes da Action Figure do Batman, com articulações e acessórios.</p>
                <div class="product-price">R$ 149,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product-card comic-border">
                <img src="<?= url('/assets/img/imagem.jpg') ?>" alt="Produto 2" class="product-image">
                <h3 class="product-title">HQ A Noite Mais Densa</h3>
                <p class="product-description">Clássica saga da DC Comics, essencial para fãs de quadrinhos.</p>
                <div class="product-price">R$ 79,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product-card comic-border">
                <img src="" alt="Produto 3" class="product-image">
                <h3 class="product-title">Camiseta Superman Vintage</h3>
                <p class="product-description">Camiseta 100% algodão com estampa retrô do Superman.</p>
                <div class="product-price">R$ 59,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product-card comic-border">
                <img src="" alt="Produto 4" class="product-image">
                <h3 class="product-title">Funko Pop! Homem de Ferro</h3>
                <p class="product-description">Colecionável Funko Pop! do Homem de Ferro, perfeito para sua estante.</p>
                <div class="product-price">R$ 99,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product-card comic-border">
                <img src="" alt="Produto 5" class="product-image">
                <h3 class="product-title">HQ Batman: Ano Um</h3>
                <p class="product-description">A história definitiva da origem do Batman, por Frank Miller.</p>
                <div class="product-price">R$ 69,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
            <div class="product-card comic-border">
                <img src="" alt="Produto 6" class="product-image">
                <h3 class="product-title">Caneca Mulher-Maravilha</h3>
                <p class="product-description">Caneca de cerâmica da Mulher-Maravilha, ideal para o café da manhã.</p>
                <div class="product-price">R$ 39,90</div>
                <button class="btn-add-cart">Adicionar ao Carrinho</button>
            </div>
        </div>
    </div>
</section>