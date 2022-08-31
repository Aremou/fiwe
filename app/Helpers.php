<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vente;
use App\Models\Produit;
use App\Models\Salaire;
use App\Models\Commande;
use App\Models\Parametre;
use App\Models\Personnel;
use Illuminate\Support\Str;
use App\Models\DepotReappro;
use App\Models\PayementVente;
use App\Models\DepotCotisation;
use App\Models\PayementFournisseur;

if (!function_exists('background_color_1')) {
    function background_color_1()
    {
        return 'background-color: #54CC96';
    }
}
if (!function_exists('color_1')) {
    function color_1()
    {
        return 'color: #54CC96';
    }
}
