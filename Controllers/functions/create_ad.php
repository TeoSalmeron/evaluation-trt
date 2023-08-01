<?php

use App\Core\Form;
use App\Models\AdvertisementModel;

function create_ad() {
    $form = new Form;
    if(!$form->issetFormItem($_POST["title"])) {
        $response = [
            "error" => 1,
            "msg" => "Renseignez le titre de votre offre"
        ];
        return $response;
    } else {
        if(!$form->issetFormItem($_POST["address"])) {
            $response = [
                "error" => 1,
                "msg" => "Renseignez l'adresse de votre offre"
            ];
            return $response;
        } else {
            if(!$form->issetFormItem($_POST["description"])) {
                $response = [
                    "error" => 1,
                    "msg" => "Renseignez la description de votre offre"
                ];
                return $response;
            } else {
                $ad_model = new AdvertisementModel;
                $datas = [
                    "title" => htmlspecialchars(strip_tags(trim($_POST["title"]))),
                    "address" => htmlspecialchars(strip_tags(trim($_POST["address"]))),
                    "description" => htmlspecialchars(strip_tags(trim($_POST["description"]))),
                    "posted_by" => $_SESSION["id"]
                ];
                if(!$ad_model->create($datas)) {
                    $response = [
                        "error" => 1,
                        "msg" => "Impossible de créer votre offre d'emploi"
                    ];
                    return $response;
                } else {
                    $response = [
                        "error" => 0,
                        "msg" => "Offre d'emploi créé ! Vous devez attendre qu'un consultant valide votre offre."
                    ];
                    return $response;
                }
            }
        }
    }
}