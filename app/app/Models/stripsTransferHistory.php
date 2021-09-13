<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stripsTransferHistory extends Model
{
    use HasFactory;
    protected $fillable = ['strips_id', 'outgoing_warehouse_id', 'incoming_warehouse_id', 'user_sending_id', 'user_receipt_id', 'date_sending', 'date_receipt'];
}
