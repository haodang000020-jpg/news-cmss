# Cài đặt module Phản ánh - kiến nghị trực tuyến

## Chức năng

- Người dân gửi phản ánh theo lĩnh vực.
- Đính kèm tối đa 5 ảnh/tài liệu, lưu trên private disk.
- Cấp mã tra cứu tự động.
- Tra cứu bằng mã hồ sơ và số điện thoại/email.
- Theo dõi tiến độ, phản hồi của cơ quan và tải lại tệp đã gửi.
- Đánh giá mức độ hài lòng sau khi hồ sơ được giải quyết.
- Admin lọc, phân công, cập nhật trạng thái, phản hồi và ghi chú nội bộ.
- Lưu lịch sử thay đổi trạng thái.
- Gửi email xác nhận/cập nhật khi hệ thống email đã được cấu hình.

## Cài đặt local

Giải nén patch vào thư mục gốc dự án, sau đó chạy:

```bash
php artisan optimize:clear
php artisan migrate
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=FeedbackCategorySeeder
php artisan view:clear
```

## Cài đặt production

Backup database và source trước khi triển khai, sau đó chạy:

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder --force
php artisan db:seed --class=FeedbackCategorySeeder --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Không cần chạy `storage:link` cho tệp phản ánh vì chúng được lưu tại `storage/app/private` và chỉ tải qua controller có kiểm tra hồ sơ.

## Đường dẫn kiểm tra

Frontend:

```text
/phan-anh-kien-nghi
/phan-anh-kien-nghi/tra-cuu
```

Admin:

```text
/admin/citizen-feedbacks
/admin/feedback-categories
```

## Luồng kiểm thử

1. Đăng nhập admin và kiểm tra quyền `feedbacks.manage`.
2. Vào **Lĩnh vực phản ánh** để kiểm tra dữ liệu mẫu.
3. Mở `/phan-anh-kien-nghi`, gửi một phản ánh có ảnh đính kèm.
4. Lưu mã `PA-...` được cấp.
5. Dùng mã và số điện thoại để tra cứu.
6. Trong admin, chuyển trạng thái sang **Đã tiếp nhận** rồi **Đang xử lý**.
7. Nhập phản hồi và chuyển sang **Đã giải quyết**.
8. Quay lại trang theo dõi và gửi đánh giá 1-5 điểm.

## Cấu hình email tùy chọn

Nếu muốn gửi email xác nhận và cập nhật, cấu hình các biến `MAIL_*` trong `.env`. Nếu email chưa cấu hình hoặc gửi lỗi, việc lưu phản ánh vẫn hoàn thành và lỗi được ghi vào log.

## Bảo mật

- Không công khai danh sách phản ánh ngoài frontend.
- Trang chi tiết dùng UUID khó đoán và có `noindex,nofollow`.
- Tra cứu yêu cầu đồng thời mã hồ sơ và thông tin liên hệ.
- Tệp đính kèm lưu trên private disk.
- Có honeypot, giới hạn tần suất và validation định dạng/kích thước tệp.
- Không nhập mật khẩu, OTP, số tài khoản hoặc dữ liệu nhạy cảm không liên quan.
