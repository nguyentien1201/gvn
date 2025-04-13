# Laravel Project

Dự án này sử dụng **Laravel Framework 7.30.7** và yêu cầu **PHP >= 8.0.13**. Để khởi chạy dự án trên môi trường local, vui lòng thực hiện các bước sau:

**Bước 1:** Cài đặt các thư viện PHP cần thiết bằng Composer  
Chạy lệnh: `composer install`

**Bước 2:** Tạo file cấu hình môi trường  
Chạy lệnh: `cp .env.example .env`

**Bước 3:** Chỉnh sửa file `.env`  
Mở file `.env` vừa tạo và cập nhật các thông số cấu hình như `APP_NAME`, `APP_ENV`, `APP_URL`, `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` và các thiết lập khác nếu cần.

**Bước 4:** Tạo khóa ứng dụng  
Chạy lệnh: `php artisan key:generate`

Sau khi hoàn thành các bước trên, bạn có thể tiếp tục chạy `php artisan migrate` để tạo bảng cơ sở dữ liệu (nếu sử dụng migration), và `php artisan serve` để khởi chạy ứng dụng Laravel trên localhost.
