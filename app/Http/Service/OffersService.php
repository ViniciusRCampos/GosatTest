<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Offers;
use App\Http\Utils\OfferUtils;

class OfferService
{
    /* Function to get all the offers for the given CPF number */
    public function getOffers($cpf)
    {
        /* ensures that the CPF is a number-only string */
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $client = new Client();
        try{
            $data = $client->post('https://dev.gosat.org/api/v1/simulacao/credito', [
                'json' => [
                    'cpf' => $cpf,
                ]
            ]);
            $dataResult = json_decode($data->getBody());
        } catch (\Exception $e) {
            return null;
        }
        /* details on OfferUtils folder */
        $institutions = $offerUtils->getInstitution($dataResult);
        $offers = $offerUtils->getOffers($institutions, $client, $cpf);
        
        /* For each offer received, it checks if it exists and updates it or just creates a new one, if there are no offers it returns a null result */
        foreach ($offers as $offer){
            $created = $offerModel::updateOrCreate([
                'cpf' => $offer['cpf'],
                'instituicao' => $offer['instituicao'],
                'modalidade' => $offer['modalidade'],
            ],[
                'valor_a_pagar' => $offer['valor_a_pagar'],
                'valor_solicitado' => $offer['valor_solicitado'],
                'taxa_juros' => $offer['taxa_juros'],
                'qtd_parcelas' => $offer['qtd_parcelas'],
            ]);

            if($created){
                return 'Ofertas solicitadas com sucesso';
            }
        }
        return null;
        }
    }
