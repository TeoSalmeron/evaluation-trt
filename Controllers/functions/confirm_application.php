<?php

use App\Models\ApplicationModel;

function confirm_application(int $id) {
    $application_model = new ApplicationModel;
    $id = (int)htmlspecialchars(strip_tags(trim($_POST["id"])));
    if(!is_int($id)) {
        $response = [
            "error" => 1,
            "msg" => "Impossible de confirmer la candidature"
        ];
        return $response;
    } else {
        $datas = [
            "verified_by" => $_SESSION["id"]
        ];
        if(!$application_model->update($datas, $id)) {
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de confirmer la candidature"
            ];
            return $response;
        } else {
            $response = [
                "error" => 0,
                "msg" => "Candidature confirmée !"
            ];
            return $response;
        }
    }
}