<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apr extends Model
{
    use HasFactory;
    protected $fillable = ['buhta_id', 'width', 'amount', 'tonage'];

    public function buhtas()
    {
        return $this->hasOne(buhta::class);
    }
}
