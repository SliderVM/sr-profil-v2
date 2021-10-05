<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_warehouse_type extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','warehouse_id', 'warehouse_type_id'];
    protected $table = 'user_warehouse_type';
}
