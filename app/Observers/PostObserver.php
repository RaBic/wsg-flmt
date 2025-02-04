<?php

namespace App\Observers;

use App\Models\ChangeLog;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        ChangeLog::create([
            'model' => 'post',
            'model_id' => $post->id,
            'action' => 'created',
        ]);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        ChangeLog::create([
            'model' => 'post',
            'model_id' => $post->id,
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        ChangeLog::create([
            'model' => 'post',
            'model_id' => $post->id,
            'action' => 'deleted',
        ]);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        // do something grateful
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        // do something grateful
    }
}
