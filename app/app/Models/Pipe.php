<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipe extends Model
{
    use HasFactory;
    protected $fillable = ['pipe_type_id', 'warehouse_id', 'pipe_quality_id', 'length_one_piece', 'number'];

    public function pipeType()
    {
        return $this->hasOne(pipeType::class, 'id', 'pipe_type_id');
    }
    public function typesMetal()
    {
        return $this->hasOne(TypesMetal::class, 'id', 'types_metal_id');
    }
}
