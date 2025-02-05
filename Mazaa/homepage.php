<?php
session_start();
include 'C:\xampp\secure\connect.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech2etc Ecommerce Tutorial</title>
    <script src="https://kit.fontawesome.com/90c079449c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="java.js" defer></script>
    <script>
        let userId = <?php echo json_encode($_SESSION['user_id']); ?>;
        // Fetch user-specific cart data when the page loads
        const fetchUserCartData = async (userId) => {
            try {
                const response = await fetch(`fetch_user_cart.php?userId=${userId}`);
                const result = await response.json();
                if (result.success) {
                    localStorage.setItem("data", JSON.stringify(result.data));
                    console.log('User cart data retrieved successfully');
                } else {
                    console.error('Failed to retrieve user cart data');
                }
            } catch (error) {
                console.error('Error retrieving user cart data:', error);
            }
        };

        // Call the function with the user ID
        fetchUserCartData(userId);
    </script>
</head>


<body>
    <section id="header">
        <a href="#"><img src="logo2.png" class="logo" alt=""></a>

        <div>
           <ul id="navbar">
                <li><a class="active" href="index.html">Home</a></li>
               <li><a href="shop.html">Shop</a></li>
               <li><a href="blog.html">Blog</a></li>
               <li><a href="about.html">About</a></li>
               <li><a href="contact.html">Contact</a></li>
               <li id="ig-bag"><a href="cart.html"><i class="fa-solid fa-shop"></i></a></li>
               <a href="#" id="close"><i class="fa-solid fa-square-xmark"></i></a>
           </ul>
        </div>
        <div id="mobile">
            <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section id="hero">
        <h2>MAZAALAI</h2>
        <h1>Make Your Beauty With Us</h1>
        <p></p>
        <button onclick="window.location.href='shop.html'">Shop Now</button>
    </section>


    <section id="feature" class="section-p1">
       <div class="fe-box">
         <img src="22.jpg" alt="">
         <h6>Үнэгүй хүргэлт</h6>
       </div>
       <div class="fe-box">
        <img src="9.jpg" alt="">
        <h6>Арьс арчилгаа</h6>
      </div>
      <div class="fe-box">
        <img src="8.png" alt="">
        <h6>Чанартай бараа</h6>
      </div>
      <div class="fe-box">
        <img src="10.jpg" alt="">
        <h6>Найдвартай компани</h6>
      </div>
      <div class="fe-box">
        <img src="11.jpg" alt="">
        <h6>Цаг хугацаа хэмнэлт</h6>
      </div>

    </section>

    <section id="product1" class="section-p1">
        <h1>Манай Бүтээгдэхүүнүүд</h1>
        <p>Toner</p>
        <div class="pro-container">
            <div class="pro">
                <img src="14.jpg" alt="">
                <div class="des">
                    <span>Cosrx</span>
                    <h5>Advannced Snail 96 Mucin Power Essence</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>36000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="16.png" alt="">
                <div class="des">
                    <span>Aromatica</span>
                    <h5>Rosemary Active V</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>84000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="15.webp" alt="">
                <div class="des">
                    <span>Aromatica</span>
                    <h5>Tea Tree Purifying Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>84000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="17.png" alt="">
                <div class="des">
                    <span>isoi</span>
                    <h5>1st Control Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>128000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="18.png" alt="">
                <div class="des">
                    <span>isoi</span>
                    <h5>Blerrish Care Tonic Essence</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>136000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="19.png" alt="">
                <div class="des">
                    <span>Kundal</span>
                    <h5>Head Spa & Scalp Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>56000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="20.png" alt="">
                <div class="des">
                    <span>Anua</span>
                    <h5>Heartleaf 77% Soothing Toner</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>54000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="21.png" alt="">
                <div class="des">
                    <span>TIRTIR</span>
                    <h5>Milk Skin Toner</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>85000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
        </div>
    </section>

    <section id="banner" class="section-m1">
      <h4>Нэмэлт Мэдээлэл (Additional info) </h4>
      <h1> Halloween Sale <span>30%</span> 10 сарын 31 дуустал.</h1>
      <button class="normal">Explore More</button>
    </section>

    <section id="product1" class="section-p1">
        <h1>New Arrivals</h1>
        <p>Шинэ Бүтээгдэхүүнүүд</p>
        <div class="pro-container">
            <div class="pro"  onclick="window.location.href='sproduct.html'">
                <img src="14.jpg" alt="">
                <div class="des">
                    <span>Cosrx</span>
                    <h5>Advannced Snail 96 Mucin Power Essence</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>36000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro"  onclick="window.location.href='sproduct1.html'">
                <img src="16.png" alt="">
                <div class="des">
                    <span>Aromatica</span>
                    <h5>Rosemary Active V</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>84000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="15.webp" alt="">
                <div class="des">
                    <span>Aromatica</span>
                    <h5>Tea Tree Purifying Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>84000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="17.png" alt="">
                <div class="des">
                    <span>isoi</span>
                    <h5>1st Control Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>128000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="18.png" alt="">
                <div class="des">
                    <span>isoi</span>
                    <h5>Blerrish Care Tonic Essence</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>136000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="19.png" alt="">
                <div class="des">
                    <span>Kundal</span>
                    <h5>Head Spa & Scalp Tonic</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>56000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="20.png" alt="">
                <div class="des">
                    <span>Anua</span>
                    <h5>Heartleaf 77% Soothing Toner</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>54000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
            <div class="pro">
                <img src="21.png" alt="">
                <div class="des">
                    <span>TIRTIR</span>
                    <h5>Milk Skin Toner</h5>
                    <div class="star">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h4>85000₮</h4>
                    
                </div>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
            </div>
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Хямдралтай Бүтээгдэхүүнүүд</h4>
            <h1>Halloween Sale</h1>
            <span>Чанартай бүтээгдэхүүнийг таны гарт хүргэнэ.</span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Өвлийн Багц</h4>
            <h1>upcoming season</h1>
            <span>Улирал Бүр Шинийг. </span>
            <button class="white">Collection</button>
        </div>
    </section>
    <section id="newsletter" class="section-p1">
      <div class="newstext">
        <h4> Sign Up For Newsletters</h4>
        <p> E-mail-ээ бүртгүүлэн шинэ мэдээллээс <span>бүү хоцроорой.</span></p>

      </div>
      <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
      </div>
    </section>

    <footer class="section-p1">
     <div class="col">
        <img class="logo" src="logo2.png" alt="">
        <h4>Contact Info</h4>
        <p><strong>Phone:</strong>&nbsp;&nbsp;80008446 <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;91005499</p>
        <p><strong>Ажиллах Цаг:</strong> 9:00 - 22:00</p>
        <div class="follow">
           <h4>Follow Us</h4>
           <div class="icon">
            <i ><a href="https://www.instagram.com/mazaalai_skin_care/profilecard/?igsh=ZWM5OXAzYXNsN3p6" class="fa-brands fa-instagram"></a></i>
            <i class="fa-brands fa-facebook"></i>
           </div>
        </div>
     </div>
     <div class="col">
       <h4>About</h4>
       <li><a href="about.html">About us</a></li>
       <a href="#">Хүргэлт</a>
       <a href="#">Privacy Policy</a>
       <a href="#">Terms & Condition</a>
       <a href="#">Бидэнтэй холбогдох</a> 

     </div>

     <div class="col">
        <h4>My Account</h4>
        <a href="#">Sign In</a>
        <a href="#">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Хүргэлтийн Мэдээлэл</a>
        <a href="#">Help</a> 
 
      </div>
      <div class="col install">
        <h4>Install App</h4>
        <p>From App store or Google Play</p>
        <div class="row">
             <img src="33.jpg" alt="">
             <img src="34.jpg" alt="">

        </div>
        <p>Secured Payment Gateways </p>
        <img src="OIP%20(2).jpg" alt="">
      </div>

      <div class="copyright">
      <p>© 2024, Tech2 etc -HTML CSS Ecommerce Template</p>
      </div>
    </footer>
    <?php 
    if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
    $query=mysqli_query($conn, "SELECT users.* FROM users WHERE users.email='$email'");
    while($row=mysqli_fetch_array($query)){
     echo $row['firstName'].''.$row['lastName'];
    };
}
?>
</body>
</html>