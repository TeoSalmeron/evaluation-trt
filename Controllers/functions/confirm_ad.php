<?php

use App\Models\AdvertisementModel;

function confirm_ad(int $id) {
    $ad_model = new AdvertisementModel;
    $id = (int)htmlspecialchars(strip_tags(trim($_POST["id"])));
    if(!is_int($id)) {
        $response = [
            "error" => 1,
            "msg" => "Impossible de confirmer l'annonce"
        ];
        return $response;
    } else {
        $datas = [
            "verified_by" => $_SESSION["id"]
        ];
        if(!$ad_model->update($datas, $id)) {
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de confirmer l'annonce"
            ];
            return $response;
        } else {
            $response = [
                "error" => 0,
                "msg" => "Annonce confirmée !"
            ];
            return $response;
        }
    }
}