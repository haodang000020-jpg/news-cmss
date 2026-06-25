# Deployment Checklist Laravel CMS

## 1. Chuẩn bị trước deploy

- [ ] Kiểm tra `git status` sạch.
- [ ] Push code mới nhất lên GitHub.
- [ ] Kiểm tra `.env` không bị commit.
- [ ] Kiểm tra `.env.example` có đủ biến mẫu cần thiết.
- [ ] Kiểm tra `composer.lock` đã có.
- [ ] Kiểm tra `package-lock.json` đã có nếu dùng npm.

## 2. Yêu cầu hosting

- PHP 8.3 hoặc phiên bản tương thích với Laravel hiện tại.
- Composer.
- Node.js/npm nếu build asset trực tiếp trên server.
- MySQL hoặc SQLite tùy cấu hình production.
- Quyền ghi cho:
  - `storage`
  - `bootstrap/cache`
- Public document root phải trỏ về thư mục `public`.

## 3. Cấu hình `.env` production

```env
APP_NAME="Laravel CMS"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://domain

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

FILESYSTEM_DISK=public
CACHE_STORE=file
SESSION_DRIVER=file
```

Sau khi cấu hình, kiểm tra lại:

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL` đúng domain production.
- [ ] Thông tin database đúng.
- [ ] `FILESYSTEM_DISK=public`.

## 4. Lệnh deploy lần đầu

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=RolePermissionSeeder --force
php artisan db:seed --class=FeedbackCategorySeeder --force
php artisan storage:link
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 5. Kiểm tra sau deploy

- [ ] Trang chủ `/` hoạt động.
- [ ] `/admin` truy cập được.
- [ ] Đăng nhập admin thành công.
- [ ] `/sitemap.xml` hoạt động.
- [ ] `/robots.txt` hoạt động.
- [ ] Upload ảnh bài viết hoạt động.
- [ ] Upload banner hoạt động.
- [ ] Upload file văn bản hoạt động.
- [ ] Gửi và tra cứu Phản ánh - kiến nghị hoạt động.
- [ ] Tệp phản ánh được lưu trong `storage/app/private`.
- [ ] `public/storage` hoạt động.
- [ ] User thường bị chặn khỏi admin.

## 6. Lệnh cập nhật code lần sau

```bash
git pull
composer install --no-dev --optimize-autoloader
```

Nếu `package.json` hoặc `package-lock.json` thay đổi:

```bash
npm install
```

Nếu asset thay đổi:

```bash
npm run build
```

Nếu có migration mới:

```bash
php artisan migrate --force
```

Nếu permission thay đổi:

```bash
php artisan db:seed --class=RolePermissionSeeder --force
```

Luôn chạy lại cache production:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 7. Rollback cơ bản

- [ ] Backup database trước khi chạy migration.
- [ ] Backup `storage/app/public`.
- [ ] Giữ lại commit/tag trước deploy.
- [ ] Nếu lỗi, checkout commit cũ.
- [ ] Restore database nếu migration gây lỗi dữ liệu.
- [ ] Restore `storage/app/public` nếu upload bị ảnh hưởng.
- [ ] Chạy lại cache sau khi rollback.

## 8. Lưu ý bảo mật

- Không bật `APP_DEBUG=true` trên production.
- Không commit `.env`.
- Không để `database.sqlite` trong thư mục `public`.
- Không để dữ liệu nhạy cảm trong storage public.
- Chỉ cho phép upload file đã validate.
- Đổi mật khẩu admin sau deploy.
- Dùng HTTPS.
- Kiểm tra quyền ghi chỉ cấp cho thư mục cần thiết.

## 9. Checklist hoàn tất

- [ ] Code đã push.
- [ ] `.env` production đã cấu hình.
- [ ] `APP_KEY` đã có.
- [ ] Database đã migrate.
- [ ] Permission đã seed.
- [ ] Storage link đã tạo.
- [ ] Cache production đã chạy.
- [ ] Admin login được.
- [ ] Frontend chạy được.
- [ ] Sitemap/robots chạy được.
- [ ] Upload file chạy được.
