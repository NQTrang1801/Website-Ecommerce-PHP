# Website-Private
# PrivateTeam - NHÓM: 16
# Phát triển ứng dụng web - IS207.O11.2 - GVHD: Trịnh Thị Thanh Trúc
Thành viên nhóm 16 
|  MSSV  |          HOTEN           |          GMAIL         |
|:------:|:------------------------:|:----------------------:|
|21522812|Nguyễn Triệu Vy - leader  |21522812@gm.uit.edu.vn  |
|21520086|Huỳnh Lê Phong            |21520086@gm.uit.edu.vn  |
|21521556|Nguyễn Quốc Trạng         |21521556@gm.uit.edu.vn  |

# Cài đặt project
1. Tạo thư mục mới C:\xampp\htdocs -> vào thư mục vừa tạo -> git clone https://github.com/NQTrang1801/Website-Private.git
2. Mở cmd tại thư mục webiste-private và thực hiện lần lượt các cài đặt sau:
    + composer install
    + npm install
    + copy .env.example .env
    + php artisan key:generate
    + php artisan migrate
3. Sau đó tiếp tục mở 2 cửa sổ cmd tại thư muc website-private
   + cửa sổ 1: chạy lệnh -> php artisan serve
   + cửa sổ 2: chạy lệnh -> npm run dev
4. truy cập website: localhost:8000
5. note: để truy cập vào trang quản lý admin cần đăng nhập bằng user admin được đăng ký trong account sau đó truy cập vào databases -> db.laravel -> table.user -> sửa thuộc tính usertype = 1 của user vừa được đăng ký
