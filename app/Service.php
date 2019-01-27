<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Game;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'title',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function games()
    {
        return $this->belongsTo(Game::class);
    }

    public static function all_services()
    {
        return self::all();
    }
}
