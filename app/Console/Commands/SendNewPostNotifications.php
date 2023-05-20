<?php

namespace App\Console\Commands;

use App\Jobs\SendPostNotificationEmail;
use App\Mail\NewPostNotification;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class SendNewPostNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-new-post-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new post notifications to subscribers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //command must check all websites and send all new posts to subscribers which haven't been sent yet.
        //by fetching all websites first and then pull posts and then subscribers with users and then email users iteratively
        // will create 3 levels nested loops. Instead, I prefer this code, I will directly pull up posts and check which on
        // of them has sent false, I pull up subscriptions based on website_id and sent all the subscribed users that this
        // website has new post.

        //I'm avoiding nesting level queries (lazy loading) here because it'll put load on mysql
        $posts = Post::where('sent', false)->get();
        $ids = $posts->pluck('website_id');
        $subscriptions = Subscription::with('user')->whereIn('website_id', $ids)->get();
        $collection = collect($subscriptions);

        foreach ($posts as $post) {
            $filtered = $collection->filter(function ($item) use ($post) {
                return $item->website_id == $post->website_id;
            });
            foreach ($filtered as $subscriber) {
                //$email = new NewPostNotification($post);
                //Mail::to($subscriber->user->email)->send($email);

                //Another way of doing it, In order to speed up the process
                // Check if the post is already queued for sending
                if (!$post->queue) $this->queueEmailNotification($subscriber->user->email, $post);
            }
            // Mark the post as sent and set the queue name
            $post->sent = true;
            $post->queue = 'notifications';
            $post->save();
        }

        $this->info('New post notifications sent successfully.');
    }

    /**
     * @param $email
     * @param Post $post
     * @return void
     */
    protected function queueEmailNotification($email, Post $post): void
    {
        Queue::push(new SendPostNotificationEmail($email, $post));
    }

}
