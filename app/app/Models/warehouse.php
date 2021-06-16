<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;
    protected $fillable = ['id','name'];

    public function WarehouseTypes()
    {
        return $this->belongsToMany(WarehouseType::class);
    }
}




