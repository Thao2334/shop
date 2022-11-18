<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timstamps = false;
    protected $fillable = [
'comment','comment_name','comment_date','comment_status','comment_parent_comment'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function comment () {
        return $this->hasMany('App\Models\Comment');
    }
}
