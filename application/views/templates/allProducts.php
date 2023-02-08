<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleProduit.css') ?>">
<div class="listProduit">
    
    <?php 
    if (!empty($produit)) { 
        for ($i=0; $i <count($produit['nom']) ; $i++) { ?>
            <a href="<?php echo base_url('RoutesController/lien') ?>">
            <div class="objet">
                <div class="im"><img src="<?php echo base_url('/assets/img/1.jpg') ?>" alt="tsisy"></div>
                <div class="det">
                    <h2><?php echo $produit['nom'][$i] ?></h2>
                    <p><?php echo $produit['prix'][$i] ?></p>
                    <a href="">Echanger ce produit</a>
                </div>
            </div>
        </a>
        <?php } 
    } else { ?>
        <h1>Pas encore de produits!</h1>
    <?php } ?>
</div>
