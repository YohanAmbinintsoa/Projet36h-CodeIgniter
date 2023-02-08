<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleProduit.css') ?>">
<div class="listProduit">
    <?php 
    if (!empty($produit)) { 
        for ($i=0; $i <count($produit['nom']) ; $i++) { ?>
           
            <div class="objet">
                
                    <div class="im"><img src="<?php echo base_url('/assets/img/'.$produit['image'][$i]) ?>" alt="tsisy"></div>    
                <div class="det">
                    <h2><a href="<?php echo base_url('RoutesController/detail?id='.$produit['id'][$i]) ?>"><?php echo $produit['nom'][$i] ?></a></h2>
                    <p><?php echo $produit['prix'][$i] ?></p>
                </div>
            </div>
        <?php } 
    } else { ?>
        <h1>Pas encore de produits!</h1>
    <?php } ?>
    <br>
<a href="<?php echo base_url('RoutesController/add') ?>">Add new Product</a>
</div>
