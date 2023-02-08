</div>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleInsert.css') ?>">
<div class="insertion">
    <div class="ankavia">
    <h1>Inserez une nouvelle categorie</h1>
    <hr>
    <form action="<?php echo base_url('/RoutesController/insertCat') ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="categorie" id="" placeholder="nom de la categorie">
        <br>
        <input type="submit" value="Valider">
    </form>
    </div>
    <div class="ankavanana">
    <h1>Modifier une categorie</h1>
    <hr>
    <form action="<?php echo base_url('/RoutesController/modifyCat') ?>" method="post" enctype="multipart/form-data">
        <select name="idCategorie" id="">
            <?php for ($i=0; $i <count($categories['id']) ; $i++) { ?>
                <option value="<?php echo $categories['id'][$i] ?>"><?php echo $categories['nom'][$i] ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="text" name="categorie" id="" placeholder="nom de la categorie">
        <br>
        <input type="submit" value="Valider">
    </form>
    </div>
    
</div>
