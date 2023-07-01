<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = [
        'cpf',
        'instituicao',
        'modalidade',
        'valor_a_pagar',
        'valor_solicitado',
        'taxa_juros',
        'qtd_parcelas',
    ];
}
