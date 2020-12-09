<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $fillable = ['status','notes','value','product_name','product_price','product_amount'];
    protected $guarded  = ['id', 'created_at', 'update_at'];
    protected $table = 'orders';

    public function client()
    {
        return $this->hasOne(Client::class);
    }

}
