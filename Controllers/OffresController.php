<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\AdvertisementModel;

class OffresController extends Controller {

    public function index() {
        $advertisement_model = new AdvertisementModel;
        $ads = $advertisement_model->returnAllConfirmedAds();
        $this->render("offres/offres",
        [
            "title" => "TRT - Nos offres d'emplois",
            "ads" => $ads
        ],
        [
            "nav",
            "apply"
        ]);
    }
}