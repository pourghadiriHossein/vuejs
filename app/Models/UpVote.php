<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpVote extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = ['post_id', 'user_id'];
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        UpVote::created(function(UpVote $upVote) {
            $post = $upVote->post;
            $post->increment('up_vote_count', 1);
            $post->save();
        });
        UpVote::deleted(function(UpVote $upVote) {
            $post = $upVote->post;
            $post->decrement('up_vote_count', 1);
            $post->save();
        });
    }
}
