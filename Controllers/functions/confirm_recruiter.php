<?php

use App\Models\UsersModel;

function confirm_recruiter(string $id)
{
    $users_model = new UsersModel;
    if(strlen($id) !== 23) {
        $response = [
            "error" => 1,
            "msg" => "01 Impossible de confirmer l'employeur"
        ];
        return $response;
    } else {
        $users = $users_model->findBy(["id" => $id]);
        if(!$users) {
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de confirmer l'employeur"
            ];
            return $response;
        } else {
            if(!$users_model->update(["verified" => 1], $id)) {
                $response = [
                    "error" => 1,
                    "msg" => "03 Impossible de confirmer l'employeur"
                ];
                return $response;
            } else {
                $response = [
                    "error" => 0,
                    "msg" => "Employeur confirmé !"
                ];
                return $response;
            }
        }
    }
}