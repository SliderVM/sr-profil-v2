<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buhta extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'warehouse_id', 'name', 'type_metal_id', 'width', 'metal_thickness_id', 'length', 'weight', 'price', 'available', 'counterparty_id','receipt_date'];
}
