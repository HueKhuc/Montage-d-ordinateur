<div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Date</th>
                <th scope="col" class="text-center">Quantité</th>
                <th scope="col" class="text-center">Entree/Sortie</th>
            </tr>
        </thead>
<?php 
foreach ($resultStock as $stock) { 
?>
        <tbody>
            <td class="text-center"><?= $stock->getIdComposant(); ?></td>
            <td class="text-center"><?= $stock->getDateEntree(); ?></td>
            <td class="text-center">
            <?php 
            if ($stock->getEntree() == 1) {
                echo '+' . $stock->getQuantite();
            } else {
                echo '-' . $stock->getQuantite();
            }
            ?>
            </td>
            <td class="text-center">
            <?php 
            if ($stock->getEntree() == 1) {
                echo 'entrée';
            } else {
                echo 'sortie';
            }
            ?>
            </td>
        </tbody>
<?php 
} 
?>
    </table>
</div>
