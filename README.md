# Website-Private
# PrivateTeam - NHÓM: 16
# Phát triển ứng dụng web - IS207.O11.2 - GVHD: Trịnh Thị Thanh Trúc
Thành viên nhóm 16 
|  MSSV  |          HOTEN           |          GMAIL         |
|:------:|:------------------------:|:----------------------:|
|21522812|Nguyễn Triệu Vy - leader  |21522812@gm.uit.edu.vn  |
|21520086|Huỳnh Lê Phong            |21520086@gm.uit.edu.vn  |
|21521556|Nguyễn Quốc Trạng         |21521556@gm.uit.edu.vn  |

# Thông tin dự án
1. website giới thiệu nhóm: https://sites.google.com/view/nhom16-web/home?authuser=0
2. repository: https://github.com/NQTrang1801/Website-Private
3. drive: https://drive.google.com/drive/folders/1OFxRNZDL-Ie_FInNuQscq5JMUtzLimkc?usp=sharing
# Cài đặt project
1. Tạo thư mục mới C:\xampp\htdocs -> vào thư mục vừa tạo -> git clone https://github.com/NQTrang1801/Website-Private.git
2. Mở cmd tại thư mục webiste-private và thực hiện lần lượt các cài đặt sau:
    + composer install
    + npm install
    + copy .env.example .env
    + php artisan key:generate
3. Tạo databases
   + truy cập vào phpmyadmin -> tạo database mới tên là laravel
         -> chạy script tạo databases sau: https://drive.google.com/file/d/15N6dvxlNk40sDk4J2aMZm8ZH32hFRcsa/view?usp=drive_link
   + thay thế thư mục uploads trong thư mục public của project Website-private bằng thư mục được tải ở: https://drive.google.com/drive/folders/13ShlVrtiTSDRvH5NpFrvIfM320GoikcC?usp=sharing
4. Sau đó tiếp tục mở 2 cửa sổ cmd tại thư muc website-private
   + cửa sổ 1: chạy lệnh -> php artisan serve
   + cửa sổ 2: chạy lệnh -> npm run dev
5. truy cập website: localhost:8000
6. vào account -> đăng nhập bằng user Admin: admin@gmail.com / password: 12345678
