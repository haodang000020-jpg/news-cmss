# Module Tra cứu thủ tục hành chính

## Chức năng đã tích hợp

- Quản lý lĩnh vực thủ tục tại `/admin/procedure-groups`.
- Quản lý thủ tục tại `/admin/procedures`.
- Nhập thành phần hồ sơ, số bản chính, bản sao, ghi chú và biểu mẫu.
- Nhập trình tự thực hiện theo nhiều bước.
- Tìm kiếm, lọc và xem chi tiết thủ tục ngoài website.
- Trang người dân tại `/thu-tuc-hanh-chinh`.
- Tải biểu mẫu từ trang chi tiết.
- Ô **Tra cứu thủ tục** trong khối **Tiện ích số** đã được mở.
- Thêm thủ tục vào sitemap.
- Bổ sung quyền `procedures.manage`.

## Cài đặt trên máy local hoặc server

Sao lưu cơ sở dữ liệu trước khi chạy migration.

```bash
php artisan optimize:clear
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder --force
php artisan db:seed --class=ProcedureGroupSeeder --force
php artisan storage:link
npm install
npm run build
php artisan optimize:clear
```

Ở local có thể bỏ `--force`.

## Thứ tự sử dụng

1. Đăng nhập Admin.
2. Mở **Lĩnh vực thủ tục** để kiểm tra hoặc bổ sung lĩnh vực.
3. Mở **Thủ tục hành chính** và chọn **Thêm thủ tục**.
4. Nhập thông tin chung, thành phần hồ sơ và trình tự thực hiện.
5. Bật **Hiển thị ngoài website**.
6. Kiểm tra tại `/thu-tuc-hanh-chinh`.

## Lưu ý triển khai

- Biểu mẫu được lưu trong `storage/app/public/procedure-forms`.
- Domain phải có liên kết `public/storage` trỏ đến `storage/app/public`.
- Không ghi đè file `.env` trên server.
- Không xóa thư mục upload hiện có trong `storage/app/public`.
