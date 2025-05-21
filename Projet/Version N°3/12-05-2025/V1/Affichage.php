<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Affichage de la Table.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="Affichage.css" rel="stylesheet" />
</head>

<body>

<?php
    $host = 'XXXXXX';
    $dbname = 'mairie';
    $username = 'XXXXXX';
    $password = 'XXXXXX';
        
    $con = mysqli_connect($host, $username, $password, $dbname);
    if(!$con)
        {
            die("Erreur de connection !" . mysqli_connect_error());
        }
    else
        {
            echo "Connection réussie  ! <br>";
        }
    $sql = "SELECT ID, Nom, Mdp, Statut, Code, FROM connexions";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0)
        {
            echo '<table> <tr> <th> ID <i class="fa-solid fa-user"></i> </th> <th> Nom </th> <th> Mdp </th> <th> Statut <i class="fa-solid fa-location-dot"></i> </th> <th> Code </th></tr>';
            while($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr> <td>' . $row["ID"] . '</td>
                    <td>' . $row["Nom"] . '</td>
                    <td>' . $row["Mdp"] . '</td>
                    <td>' . $row["Statut"] . '</td>
                    <td>' . $row["Code"] . '</td> </tr>';
                }
                echo '</table>';
            }
            else 
            {
                echo "0 résultats obtenus.";    
            }
        /*
            $query = mysqli_query($con, "SELECT * FROM utilisateurs ORDER BY Nom ASC") or die(mysqli_error());
            while($fetch = mysqli_fetch_assoc($query))
                {
                    echo "<pre>";
                    print_r($fetch);
                    echo "</pre>";
                }
            mysqli_close($con);
        */
?>

</body>
</html>