<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pipeType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'metal_thicknesse_id', 'width_strip_in_millimeters', 'types_metal_id', 'coefficient', 'thickness_in_millimeters', 'pipe_in_pack'];
    public function TypesMetals()
    {
        return $this->hasOne(TypesMetal::class, 'id', 'types_metal_id');
    }
    public function metalThicknesse()
    {
        return $this->hasOne(metalThicknesse::class, 'id', 'metal_thicknesse_id');
    }
}
