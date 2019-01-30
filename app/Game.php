<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Game extends Model
{

    public $timestamps = false;
    protected $fillable
        = [
            'title',
            'service_id',
        ];

    public function stats()
    {
        return $this->hasOne(Service::class);
    }

    public static function all_games()
    {
        return self::all()->where('service_id', 1);
    }

}
