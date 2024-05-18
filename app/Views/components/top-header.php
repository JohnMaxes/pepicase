<?php 
    use App\Models\CustomSession;
    $curr_session = new CustomSession(null);
    if (!$curr_session->isSessionSet())
    {
        $checker = $curr_session->fetch_session_cookie();
        if (!$checker) $id = null;
        else $id = $checker;
    }
    else $id = $curr_session->get_id();
?>
    
    </head>

    <body>
        <div class = "lexend-deca sales d-flex justify-content-center align-items-center" style ="height: 50px; font-size: 15px; background-color: black;
    color: white;">
            <div align = "center"><text>Free Shipping worldwide for<br>orders $30 or above</text></div>
            <div style="padding-left:165px; padding-right:165px;" align = "center"><text>ALL PHONE CASES: Limited-time<br>40% Off</text></div>
            <div align = "center"><text>30 days free replacements<br>for quality issues.</text></div>
        </div>

        <header>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-sm-4"></div>

                    <div class="col-sm-4 d-flex justify-content-center align-items-center">
                        <a style="text-decoration: none; font-weight: bold; font-size: 37px; color: black; font-family: 'Londrina Solid'; padding-bottom: 15px; padding-top: 10px" href="/pepicase/public/">pepicase</a>
                    </div>

                    <div class="col-sm-4 d-flex justify-content-center align-items-center">
                        <a href="/pepicase/public/<?php if($id !== null) echo 'testing'; else echo 'login';?>" style="color:black; text-decoration:none;">
                            <img style ="height: 30px; width: auto;" src="<?php if($id !== null) echo '/pepicase/public/pics/Vector (1).png'; else echo '/pepicase/public/pics/login.svg';?>" alt="">
                            <?php if($id !== null) echo 'User!'; else echo 'Guest!';?>
                        </a>
                        <a href="" style="margin-right: 20px;">
                            <img src="/pepicase/public/pics/Cart.png" alt="">
                        </a>
                        <a href="">
                            <img src="/pepicase/public/pics/Frame.png" alt="">
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>

                    <div class="col d-flex justify-content-center align-items-center">
                        <a style="font-family: 'Lexend'; color: black; text-decoration: none; font-size: 18px;" href="">Wishlist</a>
                    </div>

                    <div class="col d-flex justify-content-center align-items-center">
                        <a style="font-family: 'Lexend'; color: black; text-decoration: none; font-size: 18px;" href="/pepicase/public/product/">Products</a>
                    </div>

                    <div class="col d-flex justify-content-center align-items-center">
                        <a style="font-family: 'Lexend'; color: black; text-decoration: none; font-size: 18px;" href="/pepicase/public/collections">Collections</a>
                    </div>

                    <div class="col d-flex justify-content-center align-items-center">
                        <a style="font-family: 'Lexend'; color: black; text-decoration: none; font-size: 18px;" href="/pepicase/public/about-us/">About Us</a>
                    </div>

                    <div class="col"></div>
                    <div class="col"></div>
    
                </div>
            </div>
        </header>        