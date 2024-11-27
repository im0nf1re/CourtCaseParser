<?php

namespace App\Models\Court;

class DistrictCourt extends Court
{
    public function getUrl(): string
    {
        return 'https://verhisetsky--svd.sudrf.ru/modules.php?name=sud_delo&srv_num=1&H_date=';
    }

    public function getRowPattern(): string
    {
        return '/<tr\s+valign="top"(?:[^>]*)>(.*?)<\/tr>/s';
    }

    public function getColumnPattern(): string
    {
        return '/<td(?:\s+[^>]*)?>(.*?)<\/td>/s';
    }
}
