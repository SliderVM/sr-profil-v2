<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strips extends Model
{
    use HasFactory;
    protected $fillable = ['buhta_id', 'brigade_id', 'warehouse_id', 'metal_thicknesse_id', 'types_metal_id', 'counterpartie_id', 'length_in_meters', 'width_in_millimeters', 'weight_in_tons', 'cost', 'date_manufacture', 'available'];

    public function counterparties()
    {
        return $this->hasOne(counterparties::class, 'id', 'counterpartie_id');
    }
    public function brigade()
    {
        return $this->hasOne(brigade::class, 'id', 'brigade_id');
    }
    public function TypesMetals()
    {
        return $this->hasOne(TypesMetal::class, 'id', 'types_metal_id');
    }
    public function metalThicknesse()
    {
        return $this->hasOne(metalThicknesse::class, 'id', 'metal_thicknesse_id');
    }
    public function pipeType()
    {
        return $this->hasOne(pipeType::class, 'width_strip_in_millimeters', 'width_in_millimeters');
    }

}
