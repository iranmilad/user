<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Chart extends Model
{
    use SoftDeletes;

    protected $fillable = ["id", "title", "key", "refresh_time", "feeder_url"];

    public function subscribes()
    {
        return $this->hasMany(SubscribeAccessibility::class, "reference_id", "id")->where('reference_type', 1);
    }

    public function getAccessibilityAttribute()
    {
        $res = new stdClass();
        $res->refresh_time = $this->refresh_time;
        $res->active = false;
        if ($this->subscribes->count() > 0) {
            if (auth()->check()) { //check user ligined
                $user = auth()->user(); //get logined user
                $userSubscribe = $user->subscribe; //user current subscribe
                if ($userSubscribe) {
                    $activeSubscribes = $this->subscribes()->where('subscribe_id', $userSubscribe->subscribe_id)->first();
                    if ($activeSubscribes) { // if has subscribe
                        $res->refresh_time = $activeSubscribes->refresh_time;
                        $res->active = true;
                    }
                }
            }
        } else {
            $res->active = true;
        }
        return $res;
    }
}
