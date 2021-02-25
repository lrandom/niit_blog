<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Str;

class UpdatePostSlug
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostUpdated  $event
     * @return void
     */
    public function handle($event)
    {
        $post = $event->post;
        $slug = Str::slug($post->title);
        $post->slug = $slug;
        $post->save();
    }
}
