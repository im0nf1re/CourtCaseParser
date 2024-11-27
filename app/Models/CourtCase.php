<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtCase extends Model
{
    protected $fillable = [
        'number',
        'date',
        'time',
        'room',
        'information',
        'judge',
        'result',
        'solution',
    ];

    // todo сделать только для отдачи на фронт
    public function getInformationAttribute()
    {
        return html_entity_decode($this->attributes['information']);
    }
}
