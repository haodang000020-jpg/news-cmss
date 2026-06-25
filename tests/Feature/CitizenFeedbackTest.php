<?php

namespace Tests\Feature;

use App\Models\CitizenFeedback;
use App\Models\FeedbackCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CitizenFeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_feedback_form_is_available(): void
    {
        FeedbackCategory::query()->create([
            'name' => 'Môi trường',
            'slug' => 'moi-truong',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $this->get(route('frontend.feedbacks.create'))
            ->assertOk()
            ->assertSee('Phản ánh - kiến nghị trực tuyến')
            ->assertSee('Môi trường');
    }

    public function test_citizen_can_submit_feedback_with_private_attachment(): void
    {
        Notification::fake();
        Storage::fake('local');

        $category = FeedbackCategory::query()->create([
            'name' => 'Hạ tầng',
            'slug' => 'ha-tang',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->post(route('frontend.feedbacks.store'), [
            'feedback_category_id' => $category->id,
            'full_name' => 'Nguyễn Văn A',
            'phone' => '0912 345 678',
            'email' => 'test@example.com',
            'location' => 'Ấp Bình An',
            'subject' => 'Đèn đường không hoạt động',
            'content' => 'Đèn đường tại khu vực này không hoạt động nhiều ngày, đề nghị kiểm tra và xử lý.',
            'attachments' => [
                UploadedFile::fake()->image('hien-truong.jpg'),
            ],
            'agree_privacy' => '1',
            'website' => '',
        ]);

        $feedback = CitizenFeedback::query()->firstOrFail();

        $response->assertRedirect(route('frontend.feedbacks.show', $feedback->public_id));

        $this->assertDatabaseHas('citizen_feedbacks', [
            'id' => $feedback->id,
            'phone' => '0912345678',
            'status' => CitizenFeedback::STATUS_NEW,
        ]);
        $this->assertDatabaseCount('citizen_feedback_attachments', 1);
        $this->assertDatabaseCount('citizen_feedback_status_histories', 1);

        $attachment = $feedback->attachments()->firstOrFail();
        Storage::disk('local')->assertExists($attachment->path);
    }

    public function test_feedback_lookup_requires_matching_contact(): void
    {
        $category = FeedbackCategory::query()->create([
            'name' => 'Khác',
            'slug' => 'khac',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $feedback = CitizenFeedback::query()->create([
            'public_id' => '11111111-1111-4111-8111-111111111111',
            'tracking_code' => 'PA-260625-ABC123',
            'feedback_category_id' => $category->id,
            'full_name' => 'Nguyễn Văn A',
            'phone' => '0912345678',
            'subject' => 'Nội dung thử nghiệm',
            'content' => 'Nội dung phản ánh đủ dài để phục vụ việc kiểm thử hệ thống.',
            'status' => CitizenFeedback::STATUS_NEW,
        ]);

        $this->post(route('frontend.feedbacks.lookup'), [
            'tracking_code' => 'pa-260625-abc123',
            'contact' => '0912 345 678',
        ])->assertRedirect(route('frontend.feedbacks.show', $feedback->public_id));

        $this->from(route('frontend.feedbacks.lookup.form'))
            ->post(route('frontend.feedbacks.lookup'), [
                'tracking_code' => $feedback->tracking_code,
                'contact' => '0999999999',
            ])
            ->assertRedirect(route('frontend.feedbacks.lookup.form'))
            ->assertSessionHasErrors('tracking_code');
    }

    public function test_resolved_feedback_can_be_rated_once(): void
    {
        $category = FeedbackCategory::query()->create([
            'name' => 'Khác',
            'slug' => 'khac',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $feedback = CitizenFeedback::query()->create([
            'public_id' => '22222222-2222-4222-8222-222222222222',
            'tracking_code' => 'PA-260625-XYZ789',
            'feedback_category_id' => $category->id,
            'full_name' => 'Trần Thị B',
            'phone' => '0987654321',
            'subject' => 'Nội dung đã giải quyết',
            'content' => 'Nội dung phản ánh đủ dài để phục vụ việc kiểm thử đánh giá.',
            'status' => CitizenFeedback::STATUS_RESOLVED,
        ]);

        $this->post(route('frontend.feedbacks.rate', $feedback->public_id), [
            'rating' => 5,
            'comment' => 'Xử lý nhanh và rõ ràng.',
        ])->assertRedirect();

        $this->assertDatabaseHas('citizen_feedbacks', [
            'id' => $feedback->id,
            'satisfaction_rating' => 5,
            'satisfaction_comment' => 'Xử lý nhanh và rõ ràng.',
        ]);

        $this->post(route('frontend.feedbacks.rate', $feedback->public_id), [
            'rating' => 4,
        ])->assertSessionHasErrors('rating');
    }
}
