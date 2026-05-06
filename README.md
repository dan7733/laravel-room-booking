# RoomBooking Signature

RoomBooking Signature là hệ thống quản lý và đặt phòng không gian làm việc cao cấp. Dự án hỗ trợ khách hàng đặt phòng nhanh chóng và cung cấp công cụ quản trị mạnh mẽ cho quản trị viên, với giao diện tối giản, chuyên nghiệp.

---

## Chức năng chính

### Khu vực người dùng
- Đăng ký, đăng nhập, xác thực email
- Xem danh sách phòng và chi tiết
- Đặt phòng, tránh trùng lịch
- Theo dõi trạng thái đặt phòng
- Gửi yêu cầu hủy phòng
- Nhận thông báo qua email

### Khu vực quản trị
- Quản lý phòng (thêm, sửa, xóa, khóa/mở)
- Quản lý đơn đặt phòng (duyệt, từ chối, hủy)
- Ép hủy đơn và gửi thông báo
- Quản lý người dùng (tạo, cập nhật, khóa, xóa)

---

## Công nghệ sử dụng

- Laravel 13.5.0 (PHP 8.3.30)
- MySQL
- Blade Template Engine
- Bootstrap 5
- JavaScript
- SMTP (Gmail/Mailtrap)

---

## Cấu trúc thư mục

```
roombooking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── AuthController.php
│   │   │   └── BookingController.php
│   │   └── Middleware/
│   │   └── Requests/
│   ├── Mail/
│   └── Models/
├── database/
│   └── migrations/
├── public/
│   ├── css/
│   └── js/
├── resources/
│   └── views/
│       ├── admin/
│       └── auth/
│       ├── emails/
│       ├── layouts/
│       ├── pages/
│       └── partials/
│       └── user/
└── routes/
    └── web.php
```

---

## ⚙️ Hướng dẫn cài đặt (Local)

``` bash
git clone <repo-url>
cd roombooking
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

👉 Truy cập: http://localhost:8000

---

## 🐳 Chạy bằng Docker (Port 8000)

### 1. Build và chạy container

``` bash
docker-compose up -d --build
```

### 2. Cài đặt bên trong container

``` bash
docker exec -it roombooking_app composer install
docker exec -it roombooking_app npm install
docker exec -it roombooking_app npm run build
docker exec -it roombooking_app php artisan key:generate
docker exec -it roombooking_app php artisan migrate --seed
```

👉 Truy cập: http://localhost:8000

---

### Lệnh Docker hữu ích

``` bash
docker-compose down
docker-compose down -v
docker ps
docker logs -f roombooking_app
docker-compose restart
```

---

## Cấu hình .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=roombooking_db
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your_email@gmail.com
    MAIL_PASSWORD=your_app_password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="no-reply@roombooking.com"
    MAIL_FROM_NAME="RoomBooking Signature"

---

## Route cơ bản

| Method | Route | Quyền | Mô tả |
|--------|------|------|------|
| GET | / | Public | Trang chủ |
| GET/POST | /login, /register | Guest | Xác thực |
| GET | /email/verify | Auth | Xác thực email |
| GET | /my-bookings | User | Xem lịch sử |
| POST | /room/{id}/book | User | Đặt phòng |
| POST | /my-bookings/{id}/request-cancel | User | Yêu cầu hủy |
| GET | /admin/rooms | Admin | Quản lý phòng |
| GET | /admin/bookings | Admin | Quản lý booking |
| POST | /admin/bookings/{id}/force-cancel | Admin | Ép hủy |
| GET | /admin/users | Admin | Quản lý user |
| PATCH | /admin/users/{id}/toggle-status | Admin | Khóa/mở user |

---

Ứng dụng được xây dựng theo kiến trúc Laravel MVC, đảm bảo rõ ràng, dễ mở rộng và bảo trì.
