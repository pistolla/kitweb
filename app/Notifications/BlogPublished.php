<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Twitter\TwitterChannel;
use NotificationChannels\Twitter\TwitterStatusUpdate;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;
use App\Blog;

class BlogPublished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail',TwitterChannel::class,FacebookPosterChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = "";
        $image = "";
        if($notifiable instanceof Blog)
        {
            $blog = (Blog)$notifiable;
            $message = $blog->heading;
            $image = $blog->photo;
            return (new MailMessage)
                    ->line($message)
                    ->action('New Blog Published', url('/').'/blog/'.$blog->slug)
                    ->line('You can click on the link to read the full article');
        }
        return null;
    }

    public function toTwitter($notifiable)
    {
        $message = "";
        $image = "";
        if($notifiable instanceof Blog)
        {
            $blog = (Blog)$notifiable;
            $message = $blog->heading;
            $image = $blog->photo;
            return (new TwitterStatusUpdate($message))->withImage(url('/').'/images/blog/'.$image);
        }
        return null;
    }

    /**
     * Get the Facebook post representation of the notification.
     *
     * @param  mixed  $notifiable.
     * @return \NotificationChannels\FacebookPoster\FacebookPosterPost
     */
    public function toFacebookPoster($notifiable) {
        $message = "";
        $image = "";
        if($notifiable instanceof Blog)
        {
            $blog = (Blog)$notifiable;
            $message = $blog->heading;
            $image = $blog->photo;
            return (new FacebookPosterPost($message))->withLink(url('/').'/blog/'.$blog->slug);
        }
        return null;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
