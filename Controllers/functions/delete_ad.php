<?php

use App\Models\AdvertisementModel;

function delete_ad(int $id)
{
    $ad_model = new AdvertisementModel;
    $id = (int)htmlspecialchars(strip_tags(trim($_POST["id"])));
    if(!is_int($id)) {
        $response = [
            "error" => 1,
            "msg" => "Impossible de supprimer l'annonce"
        ];
        return $response;
    } else {
        if(!$ad_model->delete($id)) {
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de supprimer l'annonce"
            ];
            return $response;
        } else {
            $response = [
                "error" => 0,
                "msg" => "Annonce supprimée !"
            ];
            return $response;
        }
    }
}