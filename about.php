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
    <title>Male Fashion | Chi Tiết</title>

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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Về chúng tôi</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Trang chủ</a>
                            <span>Về chúng tôi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about__pic">
                        <img src="img/about/about-us.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi là ai ?</h4>
                        <p>Các chương trình quảng cáo đôi khi cũng có những chính sách nghiêm ngặt cần phải tuân thủ.
                            Hãy lấy Google làm ví dụ.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Chúng tôi làm những gì ?</h4>
                        <p>Trong thời đại kỹ thuật số này, khi thông tin có thể dễ dàng có được chỉ trong vài giây,
                            danh thiếp vẫn giữ được tầm quan trọng của nó.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="about__item">
                        <h4>Tại sao nên chọn chúng tôi ?</h4>
                        <p>Một ngôi nhà hai hoặc ba tầng là cách lý tưởng để tận dụng tối đa diện tích đất mà ngôi nhà của chúng ta tọa lạc.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="testimonial__text">
                        <span class="icon_quotations"></span>
                        <p>“Vẻ đẹp không nằm trên gò má của thiếu nữ, mà nằm trong phong cách của người đàn ông.”
                        </p>
                        <div class="testimonial__author">
                            <div class="testimonial__author__pic">
                                <img src="img/about/who.jpg" alt="">
                            </div>
                            <div class="testimonial__author__text">
                                <h5>Josée</h5>
                                <h6>Tôi không nói thế!!!</h6>
                                <p>Phát triển website</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="testimonial__pic set-bg" data-setbg="img/about/testimonial-pic.jpg"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

    <!-- Counter Section Begin -->
    <section class="counter spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>Chi nhánh <br />Của chúng tôi</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">30</h2>
                        </div>
                        <span>Tổng cộng <br />Danh mục</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">102</h2>
                        </div>
                        <span>Trong <br />Quốc gia</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="counter__item">
                        <div class="counter__item__number">
                            <h2 class="cn_num">98</h2>
                            <strong>%</strong>
                        </div>
                        <span>Khách hàng <br />Hạnh phúc</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->

    <!-- Team Section Begin -->
    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Đội ngũ của chúng tôi</span>
                        <h2>Gặp gỡ</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="img/about/ah.jpg" alt="">
                        <h4>Nguyễn Anh Huy</h4>
                        <span>Thiết kế thời trang</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="img/about/ah.jpg" alt="">
                        <h4>Nguyễn Anh Huy</h4>
                        <span>Giám đốc Điều hành</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="img/about/ah.jpg" alt="">
                        <h4>Nguyễn Anh Huy</h4>
                        <span>Quản lý</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="team__item">
                        <img src="img/about/ah.jpg" alt="">
                        <h4>Nguyễn Anh Huy</h4>
                        <span>Vận chuyển</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Client Section Begin -->
    <section class="clients spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Đối tác</span>
                        <h2>Happy Clients</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-1.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-2.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-3.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-4.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-5.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-6.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-7.png" alt=""></a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4 col-6">
                    <a href="#" class="client__item"><img src="img/clients/client-8.png" alt=""></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Client Section End -->

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