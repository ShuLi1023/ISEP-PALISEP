<?php

function my_json_encode($arrayus)
{
    $newarr = '{';
    foreach ($arrayus as $key => $val) {
        $newarr .= '"' . $key . '":"' . $val . '",';
    }
    $newarr = substr($newarr, 0, strlen($newarr) - 1);
    $newarr .= '}';
    return $newarr;
}

if ($_POST) {
    $to = "heraldica@sfr.fr"; // your mail here
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $objet = $_POST["objet"];
    $message = $_POST["message"];
    $body = "Nom: $nom\nPrenom: $prenom\nE-mail: $email\nMessage: $message";

    if (@mail($to, $objet, $body)) {
        $output = my_json_encode(array('success' => true));
    } else {
        $output = my_json_encode(array('success' => false));
    }
    echo $output;
    return;
}
