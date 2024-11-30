<?php
session_start();
include 'auth.php'; // Xác thực người dùng
include 'db.php'; // Kết nối cơ sở dữ liệu
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male Fashion | Chi tiết bài viết</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php if ($username): ?>
                    <a href="logout.php"><?php echo htmlspecialchars($username); ?></a>
                <?php else: ?>
                    <a href="login-male.php">Đăng nhập</a>
                <?php endif; ?>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Miễn phí vận chuyển, trả lại hàng hoặc hoàn tiền trong 30 ngày.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Miễn phí vận chuyển, trả lại hàng hoặc hoàn tiền trong 30 ngày.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php if ($username): ?>
                                    <div class="dropdown">
                                        <a><?php echo htmlspecialchars($username); ?></a>
                                        <ul class="dropdown-content">
                                            <li><a href="profile.php">Trang cá nhân</a></li>
                                            <li><a href="logout.php">Đăng xuất</a></li>
                                        </ul>
                                    </div>
                                <?php else: ?>
                                    <a href="login-male.php">Đăng nhập</a>
                                <?php endif; ?>
                                <a href="#">FAQs</a>
                            </div>
                            <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>VND</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li><a href="./index.php">Trang chủ</a></li>
                            <li><a href="./shop.php">Cửa hàng</a></li>
                            <li><a href="">Trang</a>
                                <ul class="dropdown">
                                    <li><a href="./about.php">Về chúng tôi</a></li>
                                    <li><a href="./shop-details.php">Chi tiết sản phẩm</a></li>
                                    <li><a href="./shopping-cart.php">Giỏ Hàng</a></li>
                                    <li><a href="./checkout.php">Thanh toán</a></li>
                                    <li><a href="./blog-details.php">Chi tiết bài viết</a></li>
                                </ul>
                            </li>
                            <li class="active"><a href="./blog.php">Bài viết</a></li>
                            <li><a href="./contact.php">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                        <a href="#"><img src="img/icon/heart.png" alt=""></a>
                        <a class="shopping-cart" href="shopping-cart.php">
                            <img src="img/icon/cart.png" alt="">
                            <span class="cart-count">0</span>
                        </a>
                        <div class="price total-price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Blog Details Hero Begin -->
    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>Bạn có phải là một trong hàng ngàn người dùng iPhone không biết gì không?</h2>
                        <ul>
                            <li>Đăng bởi Deercreative</li>
                            <li>21 Tháng 2, 2019</li>
                            <li>8 Bình luận</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="img/blog/details/blog-details.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">
                        <div class="blog__details__share">
                            <span>Chia sẻ</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="blog__details__text">
                            <p>Hydroderm là loại kem chống lão hóa được ưa chuộng nhất hiện nay. Huyết thanh này hạn chế
                                sự xuất hiện của các dấu hiệu lão hóa sớm trên da và giữ cho làn da trẻ trung hơn, săn chắc hơn và
                                khỏe mạnh hơn. Nó làm giảm nếp nhăn và tình trạng da chảy xệ. Loại kem này nuôi dưỡng làn da
                                và mang lại vẻ rạng rỡ đã mất trong những năm tháng bận rộn.</p>
                            <p>Thành phần thiết yếu nhất làm nên hiệu quả của hydroderm là Vyo-Serum, một
                                sản phẩm của các protein được lựa chọn tự nhiên. Chất cô đặc này hoạt động tích cực trong việc mang lại
                                vẻ tươi trẻ tự nhiên cho làn da. Nó làm săn chắc da cùng với tác dụng dưỡng ẩm
                                cho da. Thành phần quan trọng khác làm nên hiệu quả của hydroderm là
                                “collagen biển” cùng với Vyo-Serum giúp phục hồi làn da.</p>
                        </div>
                        <div class="blog__details__quote">
                            <i class="fa fa-quote-left"></i>
                            <p>“Khi thiết kế quảng cáo cho một sản phẩm cụ thể,
                                cần phải nghiên cứu nhiều yếu tố như nơi sản phẩm đó sẽ được trưng bày.”</p>
                            <h6>_ John Smith _</h6>
                        </div>
                        <div class="blog__details__text">
                            <p>Vyo-Serum cùng với việc làm săn chắc da cũng làm giảm các nếp nhăn nhỏ biểu hiện sự lão hóa của
                                da. Các vấn đề như quầng thâm, bọng mắt và vết chân chim có thể được kiểm soát từ
                                tác dụng mạnh mẽ của huyết thanh này.</p>
                            <p>Hydroderm là sản phẩm đa chức năng giúp giảm cellulite và mang lại cho cơ thể vóc dáng săn chắc,
                                đồng thời giúp làm sạch da từ gốc và không để
                                lỗ chân lông bị tắc nghẽn, tuy nhiên cũng giúp loại bỏ nếp nhăn và mọi dấu hiệu lão hóa
                                từ vùng da nhạy cảm gần mắt.</p>
                        </div>
                        <div class="blog__details__option">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__author">
                                        <div class="blog__details__author__pic">
                                            <img src="img/blog/details/blog-author.jpg" alt="">
                                        </div>
                                        <div class="blog__details__author__text">
                                            <h5>Aiden Blair</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__tags">
                                        <a href="#">#Fashion</a>
                                        <a href="#">#Trending</a>
                                        <a href="#">#2020</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="" class="blog__details__btns__item">
                                        <p><span class="arrow_left"></span> Bài viết trước đó</p>
                                        <h5>Nó được phân loại cách sử dụng các trang web quảng cáo phân loại miễn phí</h5>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <a href="" class="blog__details__btns__item blog__details__btns__item--next">
                                        <p>Bài viết tiếp theo <span class="arrow_right"></span></p>
                                        <h5>Mẹo chọn son bóng hoàn hảo cho đôi môi của bạn</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h4>Để lại bình luận</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <input type="text" placeholder="Name">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <input type="text" placeholder="Email">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <input type="text" placeholder="Phone">
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <textarea placeholder="Comment"></textarea>
                                        <button type="submit" class="site-btn">Bình luận</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Footer Section Begin -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Khách hàng là trọng tâm trong mô hình kinh doanh độc đáo của chúng tôi, bao gồm cả thiết kế.</p>
                        <a href="#"><img src="img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Nhóm trưởng</h6>
                        <ul>
                            <li><a href="#">Nguyễn Tuấn Hưng</a></li>
                            <li><a href="#">04-01-2003</a></li>
                            <li><a href="#">21103100251</a></li>
                            <li><a href="#">DHTI15A3HN</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Thành viên</h6>
                        <ul>
                            <li><a href="#">Nguyễn Dương Ninh</a></li>
                            <li><a href="#">04-03-2003</a></li>
                            <li><a href="#">21103100262</a></li>
                            <li><a href="#">DHTI15A3HN</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Thành viên</h6>
                        <ul>
                            <li><a href="#">Nguyễn Anh Huy</a></li>
                            <li><a href="#">12-11-2003</a></li>
                            <li><a href="#">21103100270</a></li>
                            <li><a href="#">DHTI15A3HN</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Tin tức</h6>
                        <div class="footer__newslatter">
                            <p>Hãy là người đầu tiên biết về hàng mới về, danh mục sản phẩm, chương trình khuyến mãi và bán hàng!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>