Mini WebShop

A simple PHP & MySQL-based e-commerce web application featuring user registration, login, shopping cart, checkout, and an admin panel for product management.

Features
For Regular Users

Browse products

Add products to a shopping cart

Remove items from cart

Checkout and place orders

User registration and login system

For Admin

Add, edit, and delete products

Admin panel with simplified navigation

View all products in a table with images, price, and actions

Technologies Used

PHP

MySQL

HTML, CSS

JavaScript

XAMPP (for local development)

Installation

Clone the repository:

git clone https://github.com/Kerim0011/WebShop.git


Copy the project to your local web server folder (e.g., C:/xampp/htdocs/WebShop)

Import database.sql into your MySQL database.

Update includes/db.php with your MySQL credentials.

Open your browser and go to http://localhost/WebShop/.

Admin Access

Admin panel: http://localhost/WebShop/admin/

Only users with role admin can access it.

Notes

Passwords are hashed using PHP's password_hash() function.

Cart uses PHP sessions to track items.

Checkout will insert orders and order items into the database.
