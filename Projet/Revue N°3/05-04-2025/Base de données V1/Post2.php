<form method="post">
    <div>
        <label for="demande">Votre requête ? </label>
        <input name="demande" id="demande" value="Information" />
    </div>
    <div>
        <label for="destinataire"> Le destinataire de la requête ? </label>
        <input name="destinataire" id="destinataire" value="Information 1" />
    </div>
    <div>
        <button>Envoyer ma requête.</button>
    </div>
</form>

<?php
    $dem = htmlspecialchars($_POST['demande']);
    $pour = htmlspecialchars($_POST['destinataire']);

    echo $dem, '<br>', $pour;
?>
