# Event-management-system

🚀 **Live Demo**: [Event Management System (Deployed on InfinityFree)](http://sadiashakibaphp.infinityfreeapp.com/)  

## **📌 Project Overview**  
The **Event Management System** is a **Core PHP-based web application** that enables users to manage and participate in events seamlessly. It offers **event browsing, registration, user role management, and administrative controls** for a streamlined experience.  

✅ **Registered Users & Admins** get:

- Events Dashboard
- Register for events (limited capacity)
- Create, edit, delete, and view events
- Search events using AJAX-powered search

✅ **Admins Only**:

- Manage user roles (update/delete users)
- Download event attendees list as CSV  

---

## **🎯 Features**  

### 🔹 **User Features**  
✔ Register/Login/Logout functionality  
✔ Browse all events (with search functionality using AJAX)  
✔ Register for events (limited capacity)  
✔ Create, edit, delete, and view events  
✔ User dashboard with events details  

### 🔹 **Admin Features**  
✔ **Admin Dashboard** with event details (**filterable, sortable, paginated**)  
✔ **User Management** – Update user roles and delete users  
✔ **Event Management** – Add, edit, delete, and view events  
✔ **Event Registration Management** – View registered attendees  
✔ **Download Attendee List** – Export attendees list as a **CSV file**  
✔ **Search functionality** for events and attendees using AJAX  

### 🔹 **Json API Endpoint**  
Users can **fetch event details programmatically** using the following **JSON API endpoint**:  
```
http://sadiashakibaphp.infinityfreeapp.com/admin/eventapi/event-api.php?event_id=1
```
📌 Replace `event_id=1` with the actual event ID to get event details in **JSON format**.  

Example Response:
```
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "Ekushey Book Fair 2025 📚",
    "image": "1738217562_event1.jpg",
    "description": "📍 Location: Bangla Academy...
    "date": "2025-02-01",
    "time": "10:00:00",
    "capacity": 2,
    "registered": 2
  }
}
```

❌ Error Response (Event Not Found)

```
{
  "status": "error",
  "message": "Event not found"
}
```

📌 Explanation:

"status": "error" → Indicates failure.
"message": "Event not found" → No event exists with the given event_id.


---

## **📥 Installation Instructions**  

### **1️⃣ Prerequisites**  
🔹 Install **XAMPP (v3.2.2 or later)**  
🔹 Enable **Apache & MySQL** from the XAMPP Control Panel  

### **2️⃣ Project Setup**  
📌 Extract and place the **`event_management_system`** folder into:  
```
C:\xampp\htdocs\
```

### **3️⃣ Database Setup**  
📌 Open **phpMyAdmin** in your browser:  
```
http://localhost/phpmyadmin/
```
📌 Create a new database:  
```sql
CREATE DATABASE event_management_system;
```
📌 Import the `.sql` file:  
- Go to **Import**  
- Choose the file located at:  
  ```
  C:\xampp\htdocs\event_management_system\event_management_system.sql
  ```
- Click **Go**  

Now your database is set up with all necessary tables! 🎉  

### **4️⃣ Update Database Credentials**  
📌 In `config/database.php`, update database credentials as per your XAMPP setup:  

```php
$host = "localhost";
$port = "4306";
$dbname = "event_management_system";
$username = "root";
$password = "";
```

### **5️⃣ Run the Project**  
📌 Open your browser and navigate to:  
```
http://localhost/event_management_system/
```

---

## **🔑 Login Credentials for Testing**  

### **Admin Login**  
📌 **Email**: `sadia.shakiba26@gmail.com`  
📌 **Password**: `12345678`  

### **User Login**  
📌 **Email**: `nadira@gmail.com`  
📌 **Password**: `nadira123`  

---

## **🌍 Deployment**  
🚀 The project is deployed on **InfinityFree** and can be accessed here:  
🔗 **[Live Website](http://sadiashakibaphp.infinityfreeapp.com/)**  

---

## **📜 License**  
This project is for educational and demonstration purposes. Feel free to modify and improve it!  
