<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\OffersService;

class OffersController extends Controller
{
    public function getOffers(Request $request){
        
        $offersService  = new OffersService();
        $cpf = $request->cpf;
        $data = $offersService->getOffers($cpf);

        if(!$data){
            return response()->json("Não existem ofertas para esse CPF, verifique os dados e tente novamente", 422);
        } 
            return response()->json($data, 200);

    }
}
