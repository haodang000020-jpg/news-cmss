<?php

namespace App\Notifications;

use App\Models\CitizenFeedback;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CitizenFeedbackSubmittedNotification extends Notification
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
        return (new MailMessage)
            ->subject('Đã tiếp nhận phản ánh '.$this->feedback->tracking_code)
            ->greeting('Xin chào '.$this->feedback->full_name.',')
            ->line('Phản ánh của bạn đã được ghi nhận trên Cổng thông tin xã Vĩnh Bình.')
            ->line('Mã tra cứu: '.$this->feedback->tracking_code)
            ->line('Tiêu đề: '.$this->feedback->subject)
            ->action(
                'Theo dõi phản ánh',
                route('frontend.feedbacks.show', $this->feedback->public_id)
            )
            ->line('Vui lòng giữ lại mã tra cứu để kiểm tra trạng thái xử lý.');
    }
}
