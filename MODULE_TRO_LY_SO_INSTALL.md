# Module Trợ lý số Vĩnh Bình - Giai đoạn 1

## Điều kiện trước khi cài

Bản vá này được xây dựng để cài **sau module Tra cứu thủ tục hành chính**. Dự án phải có các bảng và model:

- `procedure_groups`
- `procedures`
- `procedure_required_documents`
- `procedure_steps`

Nên sao lưu source và cơ sở dữ liệu trước khi cài.

## Chức năng được bổ sung

- Trang Trợ lý số tại `/tro-ly-so`.
- Tìm kiếm thủ tục bằng câu hỏi tự nhiên, chưa sử dụng API AI trả phí.
- Hiển thị tối đa 3 thủ tục phù hợp.
- Hiển thị số thành phần hồ sơ, thời hạn và lệ phí.
- Mở popup kết quả trực tiếp từ trang chủ.
- Các câu hỏi gợi ý: khai sinh, tình trạng hôn nhân, bảo trợ xã hội.
- Ghi nhận câu hỏi vào bảng `assistant_queries`.
- Ghi nhận phản hồi “Phù hợp” hoặc “Chưa phù hợp”.
- Trang quản trị câu hỏi tại `/admin/assistant-queries`.
- Giới hạn 20 lượt tìm kiếm/phút trên mỗi nguồn truy cập.
- Cảnh báo và từ chối câu hỏi có chuỗi số nhạy cảm, OTP, mật khẩu hoặc số tài khoản.
- Bổ sung trang Trợ lý số vào sitemap.

## Cách cài bằng file ZIP

Giải nén nội dung file ZIP vào thư mục gốc dự án, cùng cấp với `artisan`, `app`, `database`, `resources` và `routes`.

Cho phép ghi đè các file được hỏi. Không ghi đè `.env`.

Sau đó chạy:

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan view:clear
```

Ở local có thể bỏ `--force`:

```bash
php artisan migrate
```

Module sử dụng CSS và JavaScript trực tiếp trong Blade nên không bắt buộc chạy `npm run build`.

## Cách cài bằng Git patch

Đặt file `news-cmss-digital-assistant-module.patch` ở thư mục gốc dự án rồi chạy:

```bash
git apply --check news-cmss-digital-assistant-module.patch
git apply news-cmss-digital-assistant-module.patch
php artisan optimize:clear
php artisan migrate --force
```

## Đường dẫn kiểm tra

Frontend:

```text
/tro-ly-so
```

Trang quản trị:

```text
/admin/assistant-queries
```

Trang chủ:

- Nhập câu hỏi tại khối **Trợ lý số Vĩnh Bình**.
- Bấm **Hỏi ngay**.
- Kết quả mở trong popup mà không tải lại trang.

## Câu hỏi mẫu để kiểm tra

```text
Tôi có con mới sinh cần làm giấy tờ gì?
Tôi cần giấy xác nhận tình trạng hôn nhân
Thủ tục văn hóa thể thao cộng đồng
Bảo trợ xã hội cần giấy tờ gì?
```

Nếu dữ liệu thủ tục mẫu có tiền tố `[MẪU TEST]`, hệ thống vẫn có thể tìm thấy dựa trên tên và từ khóa.

## Kiểm tra câu hỏi chưa tìm được

Đăng nhập Admin và mở:

```text
Câu hỏi Trợ lý số
```

Tại đây có thể xem:

- Tổng lượt hỏi.
- Lượt có kết quả.
- Lượt chưa tìm thấy.
- Phản hồi chưa phù hợp.
- Thủ tục được hệ thống ghép gần nhất.

Dựa trên các câu hỏi chưa tìm thấy, bổ sung từ khóa vào thủ tục tương ứng để cải thiện kết quả.

## Lưu ý

- Đây là giai đoạn 1, hệ thống tìm kiếm trên dữ liệu thủ tục trong database, không tự tạo nội dung pháp lý.
- Không hiển thị hoặc yêu cầu người dân nhập CCCD, OTP, mật khẩu, số tài khoản hay hồ sơ nhạy cảm.
- Cần nhập từ khóa đầy đủ cho từng thủ tục để kết quả chính xác hơn.
- Tài khoản quản trị cần quyền `procedures.manage` để xem trang câu hỏi Trợ lý số.
