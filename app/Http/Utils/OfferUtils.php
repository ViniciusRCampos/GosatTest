<?php

namespace App\Http\Utils;

class OfferUtils{
    /* Manipulates the result of the api creating a list of institutions */
    public function getInstitution($array){
        $institutions = [];
        foreach ($array->instituicoes as $instituicao) {

            $id = $instituicao->id;
            $nome = $instituicao->nome;
            $modalidades = $instituicao->modalidades;

            foreach ($modalidades as $modalidade) {
                $nomeModalidade = $modalidade->nome;
                $codModalidade = $modalidade->cod;
                $institution = [
                    'instituicao_id' => $id,
                    'instituicao' => $nome,
                    'codModalidade' => $codModalidade,
                    'modalidade' => $nomeModalidade
                ];

                $institutions[] = $institution;
            }
        };
        return $institutions;
    }
    /* Manipulates the array of institutions to request the released proposals and create an array of offers */
    public function getOffers($array, $client, $cpf){
        $offers = [];
        foreach($array as $offer) {
            $data = $client->post('https://dev.gosat.org/api/v1/simulacao/oferta', [
                'json' => [
                    'cpf' => $cpf,
                    'instituicao_id' => $offer['instituicao_id'],
                    'codModalidade' => $offer['codModalidade']
                ]
                ]);
                $result = json_decode($data->getBody());
                $valorMedio = ($result->valorMin + $result->valorMax)/2;
                $parcelas = ($result->QntParcelaMin + $result->QntParcelaMax)/2;
                $offers[] = [
                'cpf' => $cpf,
                'instituicao' => $offer['instituicao'],
                'modalidade' => $offer['modalidade'],
                'valor_a_pagar' => $valorMedio * $result->jurosMes * $parcelas,
                'valor_solicitado' => $valorMedio,
                'taxa_juros' => $result->jurosMes, 
                'qtd_parcelas' => $parcelas,
                ];
        }
        return $offers;
    }
}