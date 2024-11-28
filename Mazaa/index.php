<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech2etc Ecommerce Tutorial</title>
    <script src="https://kit.fontawesome.com/90c079449c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="java.js" defer></script>
    <script type="text/javascript" src="script.js" defer></script>
    <title>Нэвтрэх</title>
</head>

<body>

    <section id="header">
        <a href="#"><img src="logo2.png" class="logo" alt=""></a>

        <div>
           <ul id="navbar">
                <li><a href="index.html">Home</a></li>
               <li><a class="active" href="index.html">Sign Up</a></li>
               <a href="#" id="close"><i class="fa-solid fa-square-xmark"></i></a>
           </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

   <section>
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Бүртгүүлэх</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <label for="fname">Нэр</label>
                <i class="fa-regular fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="Нэр">
                <label for="fname">Нэр</label>
            </div>
            <div class="input-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Овог">
                <label for="lname">Овог</label>
            </div>
            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">
            ----------or--------
        </p>
        <div class="icons">
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-facebook"></i>
        </div>
        <div class="links">
            <p></p>
            <button id="signInButton">Нэвтрэх</button>
        </div>
    </div>
    <div class="container" id="signIn">
        <h1 class="form-title">Нэвтрэх</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
            <p class="recover">
                <a href="#">Password сэргээх</a>
            </p>
        </form>
        <p class="or">
            ----------or--------
        </p>
        <div class="icons">
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-facebook"></i>
        </div>
        <div class="links">
            <p></p>
            <button id="signUpButton">Бүртгүүлэх</button>
        </div>
    </div>
   </section>

</body>
</html>
