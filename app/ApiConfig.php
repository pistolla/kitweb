<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','url','account_no','business_number','public_key','secret','access_token','refresh_time','pass_key'
    ];

}