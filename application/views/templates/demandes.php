</div>
<link rel="stylesheet" href="<?php echo base_url('/assets/css/StyleDemandes.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('/assets/css/bootstrap.css') ?>">
<div class="dem">
    
    <?php if (isset($demande)&&!empty($demande)) { ?>
        <h1>Mes demandes de transaction</h1>
       <table class="table" border="1">
            <tr>
                <th>idEchange</th>
                <th>Objet de change</th>
                <th>Demandeur</th>
                <th>Objet demande</th>
                <th>Demande</th>
            </tr>
            <?php for ($i=0; $i <count($demande['idEchange']) ; $i++) { ?>
                <tr>
                    <td><?php echo $demande['idEchange'][$i] ?></td>
                    <td><?php echo $demande['nom1'][$i] ?></td>
                    <td><?php echo $demande['user1'][$i] ?></td>
                    <td><?php echo $demande['nom2'][$i] ?></td>
                    <td><?php echo $demande['user2'][$i] ?></td>
                    <td><a href="<?php echo base_url('RoutesController/detailEchange?idEchange='.$demande['idEchange'][$i] ) ?>">Detail</a></td>
                </tr>
            <?php } ?>
       </table>
    <?php } else { ?>
        <h1>Pas de demandes en cours</h1>
    <?php } ?>
</div>
