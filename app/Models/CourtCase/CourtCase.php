<?php

namespace App\Models\CourtCase;

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

    public function getHtmlInformationAttribute()
    {
        return html_entity_decode($this->attributes['information']);
    }

    public function getHtmlResultAttribute()
    {
        return html_entity_decode($this->attributes['result']);
    }
}
