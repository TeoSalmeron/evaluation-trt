<?php

use App\Models\UsersModel;
use App\Models\CandidateModel;
use App\Models\RecruiterModel;

function delete_user(string $id, string $role)
{
    $users_model = new UsersModel;
    if(strlen($id) !== 23) {
        $response = [
            "error" => 1,
            "msg" => "01 Impossible de supprimer l'utilisateur"
        ];
        return $response;
    } else {
        $users = $users_model->findBy(["id" => $id]);
        if(!$users){
            $response = [
                "error" => 1,
                "msg" => "02 Impossible de supprimer l'utilisateur"
            ];
            return $response;
        } else {
            if($role === "candidate") {
                $model = new CandidateModel;
            } elseif ($role === "recruiter") {
                $model = new RecruiterModel;
            }
            if(!$model->delete($id)) {
                $response = [
                    "error" => 1,
                    "msg" => "03 Impossible de supprimer l'utilisateur"
                ];
                return $response;
            } else {
                if(!$users_model->delete($id)) {
                    $response = [
                        "error" => 1,
                        "msg" => "04 Impossible de supprimer l'utilisateur"
                    ];
                    return $response;
                } else {
                    $response = [
                        "error" => 0,
                        "msg" => "Utilisateur supprimé !"
                    ];
                    return $response;
                }
            }
        }
    }
}