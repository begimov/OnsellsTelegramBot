<?php

namespace App\Models\Promotions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $geofields = array('location');

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = DB::raw("POINT($value)");
    }

    public function getLocationAttribute($value)
    {
        $loc =  substr($value, 6);
        $loc = explode(' ', substr($loc, 0, -1));
        return $loc;
    }

    public function newQuery($excludeDeleted = true)
    {
        $raw='';
        foreach ($this->geofields as $column) {
            $raw .= ' astext('.$column.') as '.$column.' ';
        }
        return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
    }

    public function scopeDistance($query, $dist, $location)
    {
        return $query->whereRaw('st_distance_sphere(location,POINT('.$location.')) < '.$dist);
    }
}
