<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'table_name'];


    public function warehouses()
    {
        return $this->belongsToMany(warehouse::class);
    }
}


