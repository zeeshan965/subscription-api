<?php

namespace App\Listeners;

use App\Events\NewPostCreated;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNewPostNotification
{
    /**
     * Handle the event.
     */
    public function handle(NewPostCreated $event): void
    {
        $post = $event->post;
        Log::info('New post created', [
            'post_id' => $post->id,
            'title' => $post->title,
            'description' => $post->description
        ]);

        //$email = new NewPostNotification($post);
        //Mail::to('zeeshanbutt223@gmail.com')->send($email);

    }
}
