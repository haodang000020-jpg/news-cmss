# CURRENT STATE

Dự án: Website cổng thông tin điện tử tương tự Văn phòng UBND tỉnh An Giang.

Công nghệ:

* Laravel
* Bootstrap
* MySQL

Đã hoàn thành:

* Admin Authentication
* RBAC
* Admin dashboard
* Category CRUD
* Article CRUD
* Public Frontend News
* Public Portal Layout
* Banner / Slider CRUD
* Dynamic Menu CRUD
* Document Category CRUD
* Document Admin CRUD
* Frontend Documents
* Pages Admin CRUD
* Frontend Page Show
* Sitemap.xml
* Robots.txt
* Production Readiness Audit
* DEPLOYMENT_CHECKLIST.md

Đang ở giai đoạn:
Giai đoạn 15 - Article Rich Text Editor + Upload ảnh trong nội dung bài viết

Mục tiêu tiếp theo:

* Phân tích cách triển khai Article Rich Text Editor
* Thay textarea nội dung bài viết bằng trình soạn thảo rich text editor
* Cho phép định dạng nội dung bài viết: tiêu đề, in đậm, in nghiêng, danh sách, liên kết
* Cho phép upload và chèn hình ảnh trực tiếp trong nội dung bài viết
* Lưu ảnh nội dung bài viết vào storage public
* Đảm bảo chức năng thêm bài viết và sửa bài viết vẫn hoạt động
* Đảm bảo frontend hiển thị đúng nội dung HTML của bài viết
* Không ảnh hưởng ảnh đại diện bài viết hiện có

Lưu ý triển khai:

* Không viết lại dự án từ đầu.
* Không thay đổi kiến trúc nếu chưa được xác nhận.
* Chỉ sửa từng phần nhỏ.
* Trước tiên chỉ phân tích cách triển khai, chưa viết code.
* Chỉ tập trung vào module Article.
* Không sửa Category, Banner, Menu, Documents, Pages nếu không cần.
* Không làm ảnh hưởng các chức năng đã test hoàn thành.
