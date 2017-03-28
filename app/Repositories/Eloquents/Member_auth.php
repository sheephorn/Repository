<?php

namespace App\Repositories\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Member_auth extends Model
{
    protected $table = 'member_auth';
    protected $primaryKey = 'member_id';
    protected $guarded = array();
    public $timestamps = true;
}
