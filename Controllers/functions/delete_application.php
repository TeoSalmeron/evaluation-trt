<?php

use App\Models\ApplicationModel;

function delete_application(int $id)
{
    $application_model = new ApplicationModel;
    $id = (int)htmlspecialchars(strip_tags(trim($_POST["id"])));
    if(!is_int($id)) {
        $response = [
            "error" => 1,
            "msg" => "Impossible de supprimer la candidature"
        ];
        return $response;
    } else {
        if(!$application_model->delete($id)) {
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de supprimer la candidature"
            ];
            return $response;
        } else {
            $response = [
                "error" => 0,
                "msg" => "Candidature supprimée !"
            ];
            return $response;
        }
    }
}