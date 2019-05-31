<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() // 単数形にする（postする人は１人。）
    {
        return $this->belongsTo(User::class); // Userはメソッド名と同じにすること
        // 従テーブル（Post）なのでbelongsTo
    }
}
