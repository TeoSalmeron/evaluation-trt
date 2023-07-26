<?php

use App\Models\UsersModel;
use App\Models\RecruiterModel;

function delete_recruiter(string $id)
{
    $users_model = new UsersModel;
    if(strlen($id) !== 23) {
        $response = [
            "error" => 1,
            "msg" => "01 Impossible de supprimer l'employeur"
        ];
        return $response;
    } else {
        $users = $users_model->findBy(["id" => $id]);
        if(!$users){
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de supprimer l'employeur"
            ];
            return $response;
        } else {
            $recruiter_model = new RecruiterModel;
            if(!$recruiter_model->delete($id)) {
                $response = [
                    "error" => 1,
                    "msg" => "03 Impossible de supprimer l'employeur"
                ];
                return $response;
            } else {
                if(!$users_model->delete($id)) {
                    $response = [
                        "error" => 1,
                        "msg" => "04 Impossible de supprimer l'employeur"
                    ];
                    return $response;
                } else {
                    $response = [
                        "error" => 0,
                        "msg" => "Employeur supprimé !"
                    ];
                    return $response;
                }
            }
        }
    }
}