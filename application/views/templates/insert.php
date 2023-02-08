</div>

<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleInsert.css') ?>">
<div class="insertion">
    <h1>Inserez un nouveau Produit</h1>
    <hr>
    <form action="<?php echo base_url('DatabaseHandler/insertProduit') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="nom" id="" placeholder="nom du produit">
        <br>
        <input type="text" name="description" id="" placeholder="description">
        <br>
        <input type="number" name="prix" id="" placeholder="prix">
        <br>
        <p>Categories :</p>
        <?php for ($i=0; $i <count($categories['nom']) ; $i++) { ?>
            <input type="checkbox" name="categorie[]" id="" value="<?php echo $categories['id'][$i]; ?>"> <?php echo $categories['nom'][$i]; ?>
        <br>
        <?php } ?>
        <input type="file" name="files[]" id="" multiple>
        <br>
        <input type="submit" value="Valider">
    </form>
</div>