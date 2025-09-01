Mini WebShop 🛒






A simple e-commerce web application built with PHP, MySQL, and HTML/CSS, featuring a user shopping experience and an admin panel for product management.

🚀 Features
User

Browse products with images, price, and description

Add products to a shopping cart

Remove items from cart

Checkout and view order confirmation

User registration and login system

Admin

Admin panel to add, edit, and delete products

View all products in a table with images and prices

Only admin users can access admin features

🛠 Tech Stack

PHP (server-side)

MySQL (database)

HTML, CSS, JavaScript

XAMPP (for local development)

⚡ Installation

Clone the repository:

git clone https://github.com/Kerim0011/WebShop.git


Move the project to your web server folder (e.g., C:/xampp/htdocs/WebShop)

Import database.sql into your MySQL database

Update includes/db.php with your database credentials

Open your browser and go to:

http://localhost/WebShop/

🔑 Admin Access

Admin panel: http://localhost/WebShop/admin/

Only users with role admin can access this panel

💡 Notes

Passwords are hashed with password_hash()

Cart is stored in PHP sessions

Checkout creates orders and order items in the database
