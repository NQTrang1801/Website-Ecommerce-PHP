# Fashion Business Website
# Group: 16
# Web Application Development - IS207.O11.2 - Instructor: Trịnh Thị Thanh Trúc

## Team 16 Members

|  Student ID |         Full Name           |            Gmail           |
|:-----------:|:---------------------------:|:--------------------------:|
|  21522812   | Nguyễn Triệu Vy - Leader    | 21522812@gm.uit.edu.vn     |
|  21520086   | Huỳnh Lê Phong              | 21520086@gm.uit.edu.vn     |
|  21521556   | Nguyễn Quốc Trạng           | 21521556@gm.uit.edu.vn     |

## Project Information
1. Group introduction website: [Link](https://sites.google.com/view/nhom16-web/home?authuser=0)
2. Repository: [Link](https://github.com/NQTrang1801/Website-Private)
3. Drive: [Link](https://drive.google.com/drive/folders/1OFxRNZDL-Ie_FInNuQscq5JMUtzLimkc?usp=sharing)

## Project Setup
1. Create a new folder `C:\xampp\htdocs` -> go to the created folder -> run `git clone https://github.com/NQTrang1801/Website-Private.git`
2. Open CMD in the `website-private` folder and run the following commands:
    + `composer install`
    + `npm install`
    + `copy .env.example .env`
    + `php artisan key:generate`
3. Create databases:
   + Access phpMyAdmin -> create a new database named `laravel`
   + Run the database creation script: [Link](https://drive.google.com/file/d/15N6dvxlNk40sDk4J2aMZm8ZH32hFRcsa/view?usp=drive_link)
   + Replace the `uploads` folder in the `public` folder of the `Website-private` project with the folder downloaded from: [Link](https://drive.google.com/drive/folders/13ShlVrtiTSDRvH5NpFrvIfM320GoikcC?usp=sharing)
4. Open 2 CMD windows in the `website-private` folder:
   + Window 1: run the command -> `php artisan serve`
   + Window 2: run the command -> `npm run dev`
5. Access the website: `localhost:8000`
6. Go to the account section -> login with Admin user: `admin@gmail.com` / password: `12345678`

## Project Overview
In an increasingly evolving society, everything is constantly changing to adapt to the times, and the fashion industry is no exception. Previously, geographical limitations posed challenges for many individuals. However, with technological advancements, shopping has become more accessible and convenient through websites. Building a website not only supports business growth but also serves as an effective platform to introduce products to a wide audience.

## Objectives
Our project aims to enhance the shopping experience for customers while expanding the store on a larger scale. The comprehensive objectives include:

1. **Creating a user-friendly, easy-to-navigate website:** The design focuses on intuitive and engaging interfaces to facilitate easy navigation for users.
2. **Offering a diverse range of clothing and fashion accessories:** The website caters to various tastes and preferences, providing a wide selection of products.
3. **Establishing a secure and efficient payment system:** Ensuring that customers' financial transactions are safeguarded with robust security measures.
4. **Optimizing website functionality:** Guaranteeing a seamless browsing experience on both computers and mobile devices, enhancing accessibility and user satisfaction.

## Technologies Used

### Frameworks and Libraries:
- Laravel (PHP framework version 10.10+)
- PHPUnit (Unit Testing Framework)
- Intervention Image (Image Handling and Manipulation Library)
- Laravel Fortify (Controllers and scaffolding backend for authentication)
- Laravel Jetstream (Scaffolding Tailwind for Laravel framework)
- Livewire
- Bootstrap 5

### Architectural Model:
- MVC (Model-View-Controller) architecture in Laravel

### Development Tools:
- Visual Studio Code
- Word
- StarUML
- Github
- ChatGPT
- Google Dialogflow
- Xampp

### Languages:
- PHP (version 8.1+)
- JavaScript (including jQuery and Dropzone.js)
- HTML, CSS (for design)

### Database:
- MySQL

