<?php


namespace App;


trait RecordsActivity
{

    /**
     * Boot the trait
     * triggered automatically: boot+NameOfTheTrait
     */
    protected static function bootRecordsActivity()
    {

        if (auth()->guest()) return;

        foreach (static::getActivityToRecord() as $event) {
            static::$event(function($model) use ($event) {

                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model){
            $model->activity()->delete();
        });


    }


    /**
     * @return array
     */
    protected static function getActivityToRecord()
    {
        return ['created'];
    }

    /**
     * @param $event
     */
    protected function recordActivity($event)
    {

        $this->activity()->create([

            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event), //App/Foo/Thread -> Thread

        ]);

    }

    /**
     * PolyMorphism,
     * @return mixed
     */
    public function activity()
    {
        /**
         * Define a polymorphic one-to-many relationship, with related class
         * and related name
         *
         */
        return $this->morphMany('App\Activity','subject');
        
    }

    /**
     * @param $event
     * @return string
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }
}