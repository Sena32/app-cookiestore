<?php

namespace App\Models;

use MStaack\LaravelPostgis\Eloquent\PostgisTrait;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use PostgisTrait;
    protected $fillable = ['name','telephone','street','number','neighborhood','location'];
    protected $postgisFields = [
        'location'
    ];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'clients';

}
