<?php

namespace Tests\Feature;

use App\Models\AssistantQuery;
use App\Models\Procedure;
use App\Models\ProcedureGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DigitalAssistantTest extends TestCase
{
    use RefreshDatabase;

    public function test_assistant_page_is_available(): void
    {
        $this->get(route('frontend.digital-assistant.index'))
            ->assertOk()
            ->assertSee('Trợ lý số Vĩnh Bình');
    }

    public function test_assistant_returns_matching_procedure_and_logs_query(): void
    {
        $group = ProcedureGroup::query()->create([
            'name' => 'Hộ tịch',
            'slug' => 'ho-tich',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $procedure = Procedure::query()->create([
            'procedure_group_id' => $group->id,
            'name' => 'Đăng ký khai sinh cho trẻ em',
            'slug' => 'dang-ky-khai-sinh-cho-tre-em',
            'code' => 'HT-001',
            'summary' => 'Hướng dẫn đăng ký khai sinh.',
            'keywords' => 'khai sinh, trẻ em, con mới sinh',
            'processing_time' => 'Trong ngày làm việc',
            'fee' => 'Không',
            'sort_order' => 1,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $response = $this->postJson(
            route('frontend.digital-assistant.search'),
            ['question' => 'Tôi có con mới sinh cần làm giấy tờ gì?']
        );

        $response
            ->assertOk()
            ->assertJsonPath('results.0.name', $procedure->name)
            ->assertJsonCount(1, 'results');

        $this->assertDatabaseHas('assistant_queries', [
            'question' => 'Tôi có con mới sinh cần làm giấy tờ gì?',
            'matched_procedure_id' => $procedure->id,
            'result_count' => 1,
            'is_resolved' => true,
        ]);

        $this->assertSame(1, AssistantQuery::query()->count());
    }

    public function test_assistant_rejects_sensitive_numeric_data(): void
    {
        $this->postJson(
            route('frontend.digital-assistant.search'),
            ['question' => 'Số CCCD của tôi là 012345678901']
        )
            ->assertStatus(422)
            ->assertJsonFragment([
                'message' => 'Vui lòng không nhập số CCCD, số tài khoản, mã OTP, mật khẩu hoặc thông tin cá nhân nhạy cảm.',
            ]);

        $this->assertDatabaseCount('assistant_queries', 0);
    }
}
