<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getAbbrivatedNameAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1)) . ". " . $this->last_name;
    }

    public function getOldSystemFormatAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 4)) . strtoupper(substr($this->last_name, 0, 4));
    }
}
