<form method="get">
    <div>
        <label for="demande">Votre requête ? </label>
        <input name="demande" id="demande" value="Valeurs du vent" />
    </div>
    <div>
        <label for="destinataire"> Le destinataire de la requête ? </label>
        <input name="destinataire" id="destinataire" value="Station météo" />
    </div>
    <div>
        <button>Envoyer ma requête.</button>
    </div>
</form>

<?php
    $dem = htmlspecialchars($_GET['demande']);
    $pour = htmlspecialchars($_GET['destinataire']);

    echo $dem, '<br>', $pour;
?>
