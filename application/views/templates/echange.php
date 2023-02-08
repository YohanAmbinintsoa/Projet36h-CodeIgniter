</div>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleEchange.css') ?>">
<div class="echange">
    <div class="left">
        <img src="<?php echo base_url('/assets/img/3.jpg') ?>" alt="tsisy">
        <h1><?php echo $objet1['nom'] ?></h1>
        <p><?php echo $objet1['description'] ?></p>
        <p><?php echo $objet1['prix'] ?></p>
    </div>
    <div class="transaction">
        <button><a href="<?php echo base_url('RoutesController/accepter?idEchange='.$echange['idEchange']) ?>">Accepter</a></button>
        <br>
        <button><a href="<?php echo base_url('RoutesController/refuser?idEchange='.$echange['idEchange']) ?>">Refuser</a></button>
    </div>
    <div class="right">
        <img src="<?php echo base_url('/assets/img/4.jpg') ?>" alt="tsisy">
        <h1><?php echo $objet2['nom'] ?></h1>
        <p><?php echo $objet2['description'] ?></p>
        <p><?php echo $objet2['prix'] ?></p>
    </div>
</div>
