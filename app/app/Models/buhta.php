<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buhta extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'warehouse_id', 'name', 'type_metal_id', 'width', 'metal_thickness_id', 'length', 'weight', 'price', 'available', 'counterparty_id','receipt_date'];
    use SoftDeletes;

    public function TypesMetals()
    {
      return $this->hasOne(typesMetal::class, 'id', 'type_metal_id');
    }

    public function counterparties()
    {
        return $this->hasOne(counterparties::class, 'id', 'counterparty_id');
    }
}
