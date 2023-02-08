<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>a-takalo</title>
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.css') ?>">
</head>
<body>
    <div class="big">
        <div class="navbar other">
            <h1 class="logo">A-TAKALO</h1>
            <nav>
                <ul>
                    <li><?php echo anchor('RoutesController?page=main','Main') ?></li>
                    <?php if ($_SESSION['admin']!=1) { ?>
                        <li><a href="<?php echo base_url('/RoutesController/produit') ?>">Mes produits</a></li>
                        <li><a href="<?php echo base_url('/RoutesController/allProduit') ?>">Tous les produits</a></li>
                        <li><a href="<?php echo base_url('RoutesController/demand') ?>">Les demandes</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url('RoutesController/admin') ?>">Pages Admin</a></li>
                    <?php } ?>
                    <li><?php echo anchor('FormControll/logout','Log Out'); ?></li>
                    
                </ul>
            </nav>
        </div>
    </div>