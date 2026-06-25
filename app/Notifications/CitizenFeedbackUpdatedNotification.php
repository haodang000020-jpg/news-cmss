<?php

namespace App\Notifications;

use App\Models\CitizenFeedback;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CitizenFeedbackUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly CitizenFeedback $feedback
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Cập nhật phản ánh '.$this->feedback->tracking_code)
            ->greeting('Xin chào '.$this->feedback->full_name.',')
            ->line('Phản ánh của bạn vừa được cập nhật.')
            ->line('Trạng thái hiện tại: '.$this->feedback->statusLabel());

        if ($this->feedback->admin_response) {
            $message->line('Phản hồi của cơ quan: '.$this->feedback->admin_response);
        }

        return $message
            ->action(
                'Xem trạng thái chi tiết',
                route('frontend.feedbacks.show', $this->feedback->public_id)
            )
            ->line('Cảm ơn bạn đã gửi thông tin đến cơ quan.');
    }
}
