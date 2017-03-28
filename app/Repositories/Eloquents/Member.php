<?php

namespace App\Repositories\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $guarded = array('member_id');
    public $timestamps = true;
}
