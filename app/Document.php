<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = array('privacypolicy','refundpolicy','termofservice','sitexml','robottxt','cookiepolicy');
}
