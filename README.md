# inventory-management-system-web-application-third-year
Web-based Inventory Management System developed for a fictional demo company, CTG Limited, featuring role-based authentication, inventory management, product and stock management, production processing, soap costing, purchase orders, wholesaler orders, user management, and database integration.

---

## Setup Guide

## Installation Steps

### Download and Setup Project
- Download or clone the repository
- Extract the downloaded ZIP file
- Open the extracted repository folder
- Copy the folder named inventory-management-system-web-application-third-year into your XAMPP htdocs directory

**Final path should be:**
xampp/htdocs/inventory-management-system-web-application-third-year

### Start XAMPP Server
Open XAMPP Control Panel and start:
Apache ✔
MySQL ✔

### Create Database  
Open browser  
Go to: http://localhost/phpmyadmin  
Click New  
Create database:  **ctg_inven_db**

### Import Database File  
Open the created database ctg_inven_db  
Click Import  
Click Choose File  
**Locate the database file at:**  
xampp/htdocs/inventory-management-system-web-application-third-year/ctg_inven_db.sql  
Select  **ctg_inven_db.sql**  
Click Go

### Run the Project  
Open browser and go to:  
http://localhost/inventory-management-system-web-application-third-year  

The system will take you to the CTG IMS login page.

## Login Credentials

### System Administrator  
- Username: Admin  
- Password: veralok001  
- Role: System Administrator  
### Production Manager  
- Username: Chris22  
- Password: chrisalba7777  
- Role: Production Manager  
### Warehouse Manager  
- Username: Lia_1981  
- Password: lijones80  
- Role: Warehouse Manager  
### Wholesaler  
- Username: Jordan_14  
- Password: henderson99  
- Role: Wholesaler  

Note: **These credentials are provided for testing and demonstration of the different role-based features of the system.**
