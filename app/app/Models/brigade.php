<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brigade extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name'];

    public function warehouse()
    {
        return $this->belongsToMany(warehouse::class);
    }
}
