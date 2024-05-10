<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>pepicase</title>
        <link rel="stylesheet" href="/pepicase/signup/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Tera:wght@100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/pepicase/fonts.css">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class = "lexend-deca sales d-flex justify-content-center align-items-center" style ="height: 50px; font-size: 15px;">
            <div align = "center"><text>Free Shipping worldwide for<br>orders $30 or above</text></div>
            <div style="padding-left:165px; padding-right:165px;" align = "center"><text>ALL PHONE CASES: Limited-time<br>40% Off</text></div>
            <div align = "center"><text>30 days free replacements<br>for quality issues.</text></div>
        </div>

        <header>
            <div class="header">
                <div class="top_header">
                    <nav class="d-flex justify-content-between" >
                        <a href="" id="search">
                            <img src="/pepicase/pics/Search.png" alt="">
                        </a>
                        <h2 class="name"><a href="/pepicase/index.php" style = "color:inherit; text-decoration:none;">pepicase</a></h2>
                        <div class="logo_right">
                            <a href="" style="margin-right:20px; text-decoration: none; color:white;">
                                <img src="/pepicase/pics/Vector (1).png" alt="">
                            </a>
                            <a href="" style="margin-right: 20px; text-decoration: none; color:white;">
                                <img src="/pepicase/pics/Cart.png" alt="">
                            </a>
                            <a href="">
                                <img src="/pepicase/pics/Frame.png" alt="">
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="bottom_header">
                    <nav class="container">
                        <ul id="main_menu">
                            <li><a style="font-family: 'Lexend';" href="">New & Featured</a></li>

                            <li><a style="font-family: 'Lexend';" href="/pepicase/product/product.php">Products</a></li>

                            <li><a style="font-family: 'Lexend';" href="">Collections</a></li>

                            <li><a style="font-family: 'Lexend';" href="/pepicase/about_us/about-us.php">About Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <div class="d-flex align-items-center justify-content-center">
            <form action="">
                <h2 class="title" style="margin: 0px;"><b>SIGN UP</b></h2>

                <div class="input_box">
                    <p><b>Email</b></p>
                    <input style="width: 100%" type="email" name="Email" placeholder="Abc123@gmail.com" required>
                </div>

                <div class="input_box">
                    <p><b>Password</b></p>
                    <div class="form_search">
                        <input type="password" name="Password" id="password_input" placeholder="Abc12345" required>
                        <button type="password" class="eye" id="toggle_password">
                            <img src="/pepicase/pics/Ellipse.svg" alt="">
                        </button>
                    </div>
                </div>

                <div class="input_box">
                    <p><b>Confirm password</b></p>
                    <div class="form_search">
                        <input type="password" name="Confirm_password" id="confirm_password_input" placeholder="Abc12345" required>
                        <button type="password" class="eye" id="toggle_confirm_password">
                            <a href="#"><img src="/pepicase/pics/Ellipse.svg" alt=""></a>
                        </button>
                    </div>
                </div>
                
                <div class="sign_up">
                    <input style="width: 100%" type="button" name="Sign_up" value="SIGN UP" onclick="checkpassword()">
                </div>

                <div class="d-flex">
                    <hr class="before">
                    <text style="padding: 5px;">OR</text>
                    <hr class="last">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="https://www.facebook.com/login">
                        <button type="button" class="button">
                            <img src="/pepicase/pics/Facebook_icon.svg" alt="Facebook">Facebook</button>
                    </a>
                    <a href="https://accounts.google.com/v3/signin/identifier?authuser=0&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ec=GAlAFw&hl=en&service=mail&flowName=GlifWebSignIn&flowEntry=AddSession&dsh=S1107958247%3A1715339486806763&ddm=0">
                        <button type="button" class="button">
                            <img src="/pepicase/pics/Google_Icons-09-512.webp" alt="Google">Google</button>
                    </a> 
                </div>

                <div class="d-flex" id="check_account">
                    <p style="color: #A7A7A7; margin-right: 8px">Have an account?</p>
                    <a style="color: #844700;" href="/pepicase/login.php">Login</a>
                </div>
            </form>
        </div>

        <footer class="footer">
        <div class = "main-content">
            <div class = "rows">
                <div class = "column">
                    <p class="title">Policy</p>
                    <div class="footer-links">
                        <a href="">Trading conditions</a><br>
                        <a href="">Protect user information</a><br>
                        <a href="">Secure customer transactions</a><br>
                        <a href="">Product warranty policy</a><br>
                        <a href="">Payment policies and regulations</a>
                    </div>
                </div>
                <div class = "column">
                    <p class="title">Customer Support</p>
                    <div class="footer-links">
                        <a href="">Shopping guide</a><br>
                        <a href="">Electronic bill</a><br>
                        <a href="">Shipping and delivery</a><br>
                        <a href="">Payment methods</a><br>
                        <a href="">Look up orders</a>
                    </div> 
                </div>
                <div class = "column">
                    <p class="title">Address</p>
                    <div class="footer-a">
                        <a href=""><img src="/pepicase/pics/location.svg" alt="location-icon"></a><br>
                        <a href=""><img src="/pepicase/pics/sms.svg" alt="sms-icon"></a><br>
                        <a href=""><img src="/pepicase/pics/call.svg" alt="call-icon"></a>
                    </div>
                </div>
            </div>
        </div>

            <div class ="icons d-flex justify-content-center align-items-center" style = "height: 250px; padding-bottom: 30px;">
                <a href=""><img src="/pepicase/pics/Facebook Icon.png" class = "img-rounded" alt="facebook-icon" style ="margin-right: 40px;"></a>
                <a href=""><img src="/pepicase/pics/Group 1.png" class = "img-rounded" alt="facebook-icon"></a>
                <a href=""><img src="/pepicase/pics/x.png" class = "img-rounded" alt="facebook-icon" style ="margin-left: 40px;"></a>
            </div>

            <div class = "bottom-nav lexend" style = "margin-left: 45px; padding-bottom: 20px; font-size: 20px;">
                <a href="">TERMS OF USE</a>
                <a href="">PRIVACY POLICY</a>
                <a href="">PR/COLLAB</a>
                <a href="">COPYRIGHT INFO</a>
                <a href="">FAQs</a>
                <a href="">HELP</a>
            </div>
        </footer>

        <script>
            document.getElementById('toggle_password').addEventListener('click', function() {
                var passwordInput = document.getElementById('password_input');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });

            document.getElementById('toggle_confirm_password').addEventListener('click', function() {
                var passwordInput = document.getElementById('confirm_password_input');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            });

            function checkpassword() {
        // Lấy giá trị của password và confirm password
        var password = document.getElementById("password_input").value;
        var confirm_password = document.getElementById("confirm_password_input").value;

        // So sánh password và confirm password
        if (password === confirm_password) {
            // Nếu trùng khớp, hiển thị thông báo thành công
            alert("Sign up thành công!");
        } else {
            // Nếu không trùng khớp, hiển thị thông báo lỗi
            alert("Password và Confirm password không trùng khớp.");
        }
    }
        </script>
    </body>
</html>