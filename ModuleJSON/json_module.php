<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $url = $_POST["url"];
    $tag = $_POST["tag"];

    // Effectuer la requête HTTP pour obtenir les données JSON

    $json_data = file_get_contents($url);

    // Vérifier si la requête HTTP a réussi

    if ($json_data !== false)
    {
        // Nettoyer les données JSON en supprimant les caractères indésirables après la fin des données (cf doc)
        $cleaned_json_data = preg_replace('/[^\x20-\x7E]/', '', $json_data);

        // Décoder les données JSON en tableau

        $data = json_decode($cleaned_json_data, true);

        // Se connecter à la base de données
        $mysqli = new mysqli("127.0.0.1", "root", "", "json");

        // Vérifier la connexion
        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        // Vérifier si un tag est spécifié ou non

        if (empty($tag))
        {
            // Afficher le JSON complet
            header('Content-Type: application/json');

            echo $cleaned_json_data;

        } else {
            // Vérifier si le tag existe dans les données

            if (isset($data[$tag])) {
                // Récupérer les informations spécifiques à partir du tag

                $tag_data = $data[$tag];

                // Encoder les données du tag en JSON

                $tag_data_json = json_encode($tag_data);

                // Obtenir le type de la valeur

                $type = gettype($tag_data);

                // Convertir la valeur en string pour l'insertion dans la base de données

                $value = (string) $tag_data;

                // Préparer la requête SQL

                $stmt = $mysqli->prepare("INSERT INTO json (url, tag, champ, valeur) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $url, $tag, $type, $value);

                // Exécuter la requête SQL
                $stmt->execute();

                // Afficher le JSON du tag spécifié

                header('Content-Type: application/json');
                echo json_encode($tag_data);


            } else
            {
                echo "Tag non trouvé dans les données pour l'URL : $url";
            }
        }
        // Fermer la connexion à la base de données
        $mysqli->close();
    } else {
        echo "Échec de récupération des données JSON pour l'URL : $url";
    }
}
?>
