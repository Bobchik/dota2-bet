<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steam extends Model
{
    public static function toSteamID($id)
    {
        if (is_numeric($id) && strlen($id) >= 16) {
            $z = bcsub($id, '76561197960265728');
        } elseif (is_numeric($id)) {
            $z = bcdiv($id, '2'); // Actually new User ID format
        } else {
            return $id; // We have no idea what this is, so just return it.
        }
        $y = bcmod($id, '2');

        return $z;
    }

    public static function win($id)
    {
        $last_match = file_get_contents('https://api.opendota.com/api/matches/'.$id);

        return $last_match;
    }
}
