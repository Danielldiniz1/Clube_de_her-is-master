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
         
        </div>
    </div>
</section>