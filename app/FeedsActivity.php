<?php

namespace App;

use App\Events\ActivityLogged;

trait FeedsActivity 
{
    protected static function bootFeedsActivity()
    {
        foreach(static::getModelEvents() as $event)
        {
            static::$event(function ($model) use ($event) {
                $model->feedActivity($event);
            });
        }
    }

    public function feedActivity($event)
    {
        $activity = Activity::create([
            'heading' => $this->getActivityName($this, $event),
            'details' => '',
            'member_id' => $this->user_id
        ]);
        $activity->save();
        broadcast(new ActivityLogged($activity));
    }

    public function getActivityName($model, $action)
    {
        return $action .": ".$model->heading;
    }

    protected static function getModelEvents()
    {
        return ['created','deleted','updated'];
    }

}