<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apr extends Model
{
    use HasFactory;
    protected $fillable = ['buhta_id', 'width', 'amount', 'tonage'];

    public function calculation()
    {

        вычислить 1 мм бухты вес / ширина
        количество: вес бухты / ширина  * вес 1 мм бухты
        Вес: ширина * количество * вес 1 мм бухты
        обрезь: вычесть общую длину штрипсовв (количество * ширина) и ширина - общая длина штрипсов
    }
}
