Here is a **clean, formatted, ready-to-copy-paste README.md** for your GitHub repo **AllenSuport** 👇
(No extra text — just copy & paste.)

---

```markdown
# AllenSuport

AllenSuport is a web–based Complaint & Feedback Management System designed for educational institutions.  
It allows users to submit complaints, while admins and sub-admins manage, track, and resolve them with a clear workflow.

---

## 🚀 Features

### 📌 Fixed Complaint Categories
1. SC/ST Committee  
2. Anti-Ragging Committee  
3. Examination Grievance Redressal Committee  
4. Internal Complaint Committee  
5. Sexual Harassment Committee  
6. Student Welfare Committee  
7. Finance Grievance Redressal Committee  
8. Department Discipline Redressal Committee  

### 👥 Role-Based Access
- **Admin**
  - Create and manage Sub-Admins  
  - Assign category to sub-admins  
  - View all complaints  
- **Sub-Admin**
  - Login and view complaints for their assigned category  
  - Add remarks and communicate with user  
  - Close complaint after user satisfaction  

### 📝 Complaint Workflow
- User submits complaint  
- Auto-routed to the respective category’s sub-admin  
- Multiple remarks/replies supported  
- Complaint resolution stored permanently  

---

## 📂 Folder Structure

```

/admin/        → Admin panel, sub-admin management
/css/          → Stylesheets
/db/           → Database scripts (SQL files)
/feedback/     → Complaint submission & user pages
/fonts/        → Font files
/images/       → Images and icons
/img/          → Additional image assets
/js/           → JavaScript files
/users/        → User-side login and dashboard pages
index.html     → Main entry page
grawise.html   → Additional module/page

````

---

## 🛠 Installation Guide

### 1. Clone the repository  
```bash
git clone https://github.com/Rishabh7973/AllenSuport.git
````

### 2. Set up local server

Use **XAMPP / WAMP / LAMP** and place project inside `htdocs` or `www`.

### 3. Create Database

* Open phpMyAdmin
* Create a new database
* Import SQL file from `/db/` folder

### 4. Configure DB Connection

Update your database connection file (e.g., `config.php` or similar) with:

* Host
* Username
* Password
* Database name

### 5. Run the project

Open in browser:

```
http://localhost/AllenSuport
```

---

## ⚙️ How It Works (Flow)

1. **Admin logs in** → adds Sub-Admins → assigns categories
2. **User submits complaint** → selects category
3. **Sub-Admin assigned to that category** views complaint
4. Sub-Admin adds **remarks**, updates progress
5. Loop continues until **user is satisfied**
6. Complaint marked **Closed**

---

## 🎨 Customisation Options

* Change categories in frontend + database
* Update UI from `/css/` + `/images/`
* Add email/SMS notifications (future enhancement)
* Add more user roles (Reviewer, HOD, etc.)

---

## 🤝 Contributing

Contributions are welcome!
Steps:

1. Fork the repository
2. Create a feature branch
3. Commit changes
4. Push to GitHub
5. Open a pull request

---

## 📄 License

You may add any license here (MIT recommended).

---

## 🙏 Acknowledgements

Thanks for exploring AllenSuport!
Special thanks to open-source tools and libraries used in this project.

```

---

If you want, I can also:  
✅ Add screenshots  
✅ Add badges (Stars, Forks, PHP version, Status)  
✅ Add installation GIF or flowchart  

Just tell me!
```
