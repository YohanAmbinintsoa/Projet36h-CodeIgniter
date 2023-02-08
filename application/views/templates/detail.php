</div>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleDetail.css') ?>">
<div class="detail">
    <div class="image">
        <?php
        if (isset($image)) {
            for ($i=0; $i <count($image['path']) ; $i++) { ?>
                <img src="<?php echo base_url('/assets/img/'.$image['path'][$i]) ?>" width="100px" height="100px" alt="">
        <?php }
         } ?>
    </div>
    <div class="txt">
        <h1><?php echo $produit['nom'] ?></h1>
        <p>Description :
            <?php echo $produit['description'] ?>
        </p>
        <h3>Prix:<?php echo $produit['prix'] ?></h3>
        <p>Proprietaire:<?php echo $produit['proprietaire'] ?></p>
        <?php 
            if ($produit['idUser']!=$_SESSION['id']) {
                if(isset($other)&&!empty($other)) { ?>
                    <form action="<?php echo base_url('RoutesController/echange') ?>" method="get">
                    <select name="idEntana1" id="">
                        <?php for ($i=0; $i <count($other['id']) ; $i++) { ?>
                            <option value="<?php echo $other['id'][$i] ?>"><?php echo $other['nom'][$i] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="idEntana2" value="<?php echo $produit['id'] ?>">
                    <input type="submit" value="Proceder a la transaction">
                </form>
            <?php } else { ?>
                <p>Vous n'avez rien a echanger</p>
            <?php }          
         }
         ?>
    </div>
</div>