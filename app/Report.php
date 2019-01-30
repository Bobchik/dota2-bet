<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Report extends Model
{
    protected $fillable = [
        'source_id',
        'destination_id'
    ];

    public static function check_reporter($reporter_id, $player)
    {
        $reporter = Report::where('source_id', $reporter_id)->get();
        $date = Carbon::now();
        foreach ($reporter as $user) {
            if ($user->destination_id == $player && $date->diffInHours($user->created_at) < 168) {
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
