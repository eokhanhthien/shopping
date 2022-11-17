# Cấu hình cho shopping-tech
# Bước 1: Tải file zip về  và giải nén vào trong thư mục httdoc (Xampp) hoặc clone vào thư mục httdoc (Xampp)
# Bước 2: Đổi tên file vừa giải nén về thành "shopping"
# bước 3: Trong thư mục "shopping" vừa giải nén có file CSDL "shopping.sql" --> tiến hành import vào mySQL --> Đặt tên CSDL là "shopping"
# bước 4: Cấu hình cho  "C:\xampp\apache\conf\extra\httpd-vhosts.conf" :

        <VirtualHost *:80>
        DocumentRoot "C:/xampp/htdocs"
        ServerName localhost
        # Set access permission
        <Directory "C:/xampp/htdocs">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
        </Directory>
        </VirtualHost>
        
# Bước 5: truy cập vào "http://localhost/shopping/" để xem kết quả

