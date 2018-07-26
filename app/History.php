<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
      return $this->belongsTo(user::class);
    }
    public function shop()
    {
      return $this->belongsTo(shop::class);
    }
}
