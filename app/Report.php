<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'source_id',
        'destination_id'
    ];

    public static function check_reporter($reporter_id, $player)
    {
        $reporter = Report::where('source_id', $reporter_id)->get();
        foreach ($reporter as $user) {
            if ($user->destination_id == $player) {
                return response('User already reported', '500');
                break;
            }
        }
        $report = new Report();
        $report->source_id = $reporter_id;
        $report->destination_id = $player;
        $report->save();
    }
}
