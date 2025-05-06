![image](https://github.com/user-attachments/assets/19aa9e34-587d-4456-994e-40e9cccdf04d)# Student_Q-A_Forum
A Forum for students to post questions and receive comments as answers
# 🎓 Student Q&A Forum

## 📌 Project Title  
**A forum for students to post questions and receive comments as answers.**

## 📝 1. Project Description  
The Student Q&A Forum is a web application that allows students to post academic questions, interact with others through comments, and vote on posts. The platform supports full **CRUD functionality** for questions and provides two distinct roles: **Student** and **Admin**. Students can manage their own profiles and posts, while Admins have the ability to manage all users and content. Questions can be sorted by either **upvotes** or **time posted**, making it easier to surface trending or recent content.

---

## 🚀 2. Features

### 🔧 CRUD for Posts
- Create, Read, Update, Delete questions.

### 📈 Interaction Tools
- Upvote / Downvote questions  
- Post comments as answers  
- Add images to questions

### 👤 User Features
- View and edit own profile  
- View personal post history

### 🛠️ Admin Features
- View and delete any post  
- Add, edit, and delete users  
- Add, edit, and delete modules/tags

---
## 📦 Installation
### 1. Install XAMPP  
👉 [Download XAMPP](https://www.apachefriends.org/download.html)

### 2. Clone the GitHub Repository
```bash
# Go to htdocs directory of XAMPP
cd /path-to-xampp/htdocs

# Clone this repository
git clone https://github.com/MinhDucabc/Student_Q-A_Forum.git
```
### 3. Start MySQL Server

Open **XAMPP**, then:

- Click **Start** on the **MySQL** module  
  ![image](https://github.com/user-attachments/assets/149d3ead-c83e-48da-a84b-8f18c005674a)


- Click **Admin** to open the database interface  
  ![image](https://github.com/user-attachments/assets/9aae6c73-f718-46a6-81c1-f137702e01bd)


- Once in DataBase Interface, Click on **Import** and choose the **beginner_db (4).sql** file to load the whole database
  ![image](https://github.com/user-attachments/assets/ebe246de-7607-433e-af77-946319765de3)

  ![image](https://github.com/user-attachments/assets/e2fd3904-be11-470d-a75c-d88277e98906)


---

### 4. Start Apache Server

- In **XAMPP**, click **Start** on the **Apache** module
- ![image](https://github.com/user-attachments/assets/da2de15e-a34b-4ca8-9bd0-93d8f1027893)


- Click **Admin** to launch the browser and preview the project by accessing the cloned `Student Q&A` folder  
- ![image](https://github.com/user-attachments/assets/2f0b4f06-d607-4099-aeee-21d48e5f49ee)


---

## ❓ FAQ

**Q: Why does the browser show `Undefined variable $pdo in C:...`?**  
**A:** You must start the **MySQL Server** in XAMPP **before** loading the application in the browser to ensure database connectivity.

![PDO Error Example 1](readme_assets/image-3.png)  
![PDO Error Example 2](readme_assets/image-4.png)

---

## 💻 Technology Stack

- **Frontend:** HTML, CSS, JavaScript, Bootstrap  
- **Backend:** PHP  
- **Database:** MySQL  
- **Collaboration Tool:** Git  

---

## 🧭 App Navigation & Pages

### 🔐 Login / Signup
- Enables students to create an account and log in securely.
- 
![image](https://github.com/user-attachments/assets/426ced26-c09a-48e1-a9da-9bd98566a0c6)
![image](https://github.com/user-attachments/assets/1bab5f15-39fa-4dbd-9311-e9589e75dcd1)

### 🏠 Home
- Displays a list of all questions, sortable by upvotes or time posted. Users can upvote or downvote questions.
- 
![image](https://github.com/user-attachments/assets/2883aabe-dfdc-43b5-a93b-9907e79cbb50)

### ✍️ Create / Edit Question
- Authenticated users can create new questions or edit their existing ones (CRUD functionality).
- 
![image](https://github.com/user-attachments/assets/92e63c91-f07e-4aee-8f37-d771993bd518)
![image](https://github.com/user-attachments/assets/2437bf8b-c5e6-4b5b-80ff-7c6b52a31a22)


### ❓ Question Detail
- Shows a single question in full detail, including its content, comments (if implemented).
- 
![image](https://github.com/user-attachments/assets/e6c824b7-8685-413c-ada1-7c769a7abf9a)

### 👤 Profile
- Each user can view and edit their own profile, including personal information and list of posted questions.
- 
![image](https://github.com/user-attachments/assets/48e6338e-5966-4391-a078-7ed106492133)
![image](https://github.com/user-attachments/assets/487a3821-72d2-47d6-a71a-54f6cc2ce02a)

### 🛠️ Admin
- Allows admin users to manage the site—edit or delete any question or user, and maintain overall platform quality.

![image](https://github.com/user-attachments/assets/f7ea9b26-98bf-4c88-8c99-fbe0122a3b2f)

