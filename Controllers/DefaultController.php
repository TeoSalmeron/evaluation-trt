<?php

namespace App\Controllers;

use App\Models\AdvertisementModel;
use App\Models\UserModel;

class DefaultController extends Controller
{
    public function index()
    {
        $ad_model = new AdvertisementModel;
        $ads = $ad_model->returnAllConfirmedAds();
        $this->render("home", [
            "title" => "TRT - Emploi restauration et hôtellerie",
            "ads" => $ads
        ], ["nav", "apply"]);
    }
}
