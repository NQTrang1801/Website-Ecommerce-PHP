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
3. Tạo databases
   + truy cập vào phpmyadmin -> tạo database mới tên là laravel -> chạy script tạo databases sau: https://drive.google.com/file/d/15N6dvxlNk40sDk4J2aMZm8ZH32hFRcsa/view?usp=sharing
4. Sau đó tiếp tục mở 2 cửa sổ cmd tại thư muc website-private
   + cửa sổ 1: chạy lệnh -> php artisan serve
   + cửa sổ 2: chạy lệnh -> npm run dev
5. truy cập website: localhost:8000
6. note: để truy cập vào trang quản lý admin cần đăng nhập bằng user admin được đăng ký trong account sau đó truy cập vào databases -> db.laravel -> table.user -> sửa thuộc tính usertype = 1 của user vừa được đăng ký, sau đó truy cập localhost:8000/redirect
