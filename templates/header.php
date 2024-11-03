<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 50px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e7e7e7;
        background: linear-gradient(90deg, #A7C6FF 0%, #647799 100%);
    }

    .logo-name {
        font-size: 24px;
        font-weight: bold;
    }

    .menu ul, .social-media ul, .login-logout ul {
        list-style: none;
        display: flex;
        gap: 25px;
    }
    
    .menu ul li a, .social-media ul li a, .login-logout ul li a {
        text-decoration: none;
        color: #333;
    }

    .social-media ul li a i {
        font-size: 18px;
    }

    .login-logout ul li a {
        padding: 5px 10px;
        border: 1px solid #333;
        border-radius: 5px;
    }


</style>
<header>
    <div class="logo-name"> 
        <span>logo-name</span>
    </div>
    <div class="menu">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <div class="social-media">
        <ul>
            <li><a href="#"><i class="fa-brands fa-facebook"></a></i></li>
            <li><a href="#"><i class="fa-brands fa-twitter"></a></i></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></a></i></li>
        </ul>
    </div>
    <div class="login-logout">
        <ul>
            <li><a href="../">Login</a></li>
            <li><a href="#">Register</a></li>
        </ul>
    </div>
</header>