<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('パスワードリセット通知')
            ->greeting('こんにちは！')
            // 英語の部分を日本語に修正
            ->line('このメールは、あなたのアカウントのパスワードリセットリクエストを受け付けたため、送信されています。')
            ->action('パスワードをリセットする', $url)
            ->line('このパスワードリセットリンクは60分後に期限切れとなります。')
            ->line('もしこのリクエストに覚えがない場合は、このメールを無視してください。')
            ->salutation('よろしくお願いいたします。')
            ->line('「パスワードをリセットする」ボタンをクリックできない場合は、以下のURLをコピーしてブラウザに貼り付けてください。')
            ->line($url);
    }
}
