# CSE703048-1-2-25-N01-Nhom_5
# 🎓 BÁO CÁO BÀI TẬP LỚN

## MÔN HỌC: PHÂN TÍCH VÀ THIẾT KẾ PHẦN MỀM

### **ĐỀ TÀI: PHÁT TRIỂN PHẦN MỀM QUẢN LÝ CỰU SINH VIÊN**

---

## 🏫 Thông tin học phần

- **Môn học:** Phân tích và Thiết kế Phần mềm (N01)  
- **Tên đề tài:** Phát triển phần mềm Quản lý Cựu Sinh Viên  
- **Nhóm:** 5  
- **Giảng viên hướng dẫn:** **TS. Mai Thúy Nga**

---

## 👥 Thành viên thực hiện

| Họ và tên | Mã sinh viên | Gmail |
|-----------|--------------|--------------------------------|
| Hoàng Việt Anh | 23010117 | 23010117@st.phenikaa-uni.edu.vn |
| Nguyễn Quốc Quang Anh | 23010173 | 23010173@st.phenikaa-uni.edu.vn |
| Nguyễn Thế Cường | 23010176 | 23010176@st.phenikaa-uni.edu.vn |

---


## Cài đặt

### 1. Clone hoặc tải mã nguồn
```bash
git clone https://github.com/QuangAnh28/Quanlycuusinhvien.git
```

### 2. Cài đặt Composer dependencies
```bash
composer install
```

### 3. Cấu hình môi trường
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Cấu hình database trong `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<name_db_local>
DB_USERNAME=root
DB_PASSWORD=<pass_db_local>
```

### 5. Chạy migrations và seeders
```bash
php artisan migrate
```

### 6. Cài đặt npm dependencies
```bash
npm install && npm run build
```

### 7. Khởi động server
```bash
php artisan serve
```
## Cấu trúc thư mục chính

```
app
 ├── Http
 │    ├── Controllers
 │    └── Middleware
 ├── Models

resources
 └── views

routes
 └── web.php

database
 └── migrations
```

---


