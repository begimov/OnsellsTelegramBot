<?php

namespace App\Models\Promotions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Promotion extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', 1);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Promotions\Category');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function smallImgPath()
    {
        return $this->images()->where('type', 'small')->first()->path;
    }

    public function mediumImgPath()
    {
        return $this->images()->where('type', 'medium')->first()->path;
    }

    public function smallImage()
    {
        return $this->hasOne('App\Models\Image')->where('type', 'small');
    }

    public function location()
    {
        return $this->hasOne('App\Models\Promotions\Location');
    }
}
