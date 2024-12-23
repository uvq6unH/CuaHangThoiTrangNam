<?php
session_start();
include "auth.php";
include "db.php";

// Function to fetch products based on a query
function fetchProducts($conn, $query)
{
    $result = mysqli_query($conn, $query);
    return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
}

// Fetch default products (bestsellers)
$defaultQuery = "SELECT * FROM product WHERE ISACTIVE = 1 ORDER BY RATING DESC LIMIT 8";
$products = fetchProducts($conn, $defaultQuery);

// Handle AJAX request
if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    $filter = $_GET['filter'] ?? 'bestsellers';
    switch ($filter) {
        case 'newarrivals':
            $query = "SELECT * FROM product WHERE ISACTIVE = 1 AND NEWARRIVALS = 1 LIMIT 8";
            break;
        case 'hotsales':
            $query = "SELECT * FROM product WHERE ISACTIVE = 1 ORDER BY SALE DESC LIMIT 8";
            break;
        default:
            $query = "SELECT * FROM product WHERE ISACTIVE = 1 ORDER BY RATING DESC LIMIT 8";
            break;
    }

    $products = fetchProducts($conn, $query);
    if (!empty($products)) {
        foreach ($products as $product) {
            $classString = implode(' ', array_filter([
                $product['RATING'] == 5 ? 'best-sellers' : '',
                $product['NEWARRIVALS'] == 1 ? 'new-arrivals' : '',
                $product['SALE'] >= 50 ? 'hot-sales' : ''
            ]));
            $imageSrc = 'img/product/' . htmlspecialchars($product['IMAGE']);
?>
            <div class="col-lg-3 col-md-6 col-sm-6 mix <?php echo htmlspecialchars($classString); ?>">
                <div class="product__item" data-id="<?php echo htmlspecialchars($product['ID']); ?>">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo $imageSrc; ?>">
                        <img src="<?php echo $imageSrc; ?>" alt="<?php echo htmlspecialchars($product['NAME']); ?>" onerror="this.onerror=null; this.src='img/default-placeholder.png';">
                        <ul class="product__hover">
                            <li><a href="#"><img src="img/icon/heart.png" alt="Add to favorites"></a></li>
                            <li><a href="#"><img src="img/icon/compare.png" alt="Compare"> <span>Compare</span></a></li>
                            <li><a href="#"><img src="img/icon/search.png" alt="Search"></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><?php echo htmlspecialchars($product['NAME']); ?></h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <?php
                            $fullStars = floor($product['RATING']);
                            $halfStar = $product['RATING'] - $fullStars >= 0.5;
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $fullStars) {
                                    echo '<i class="fa fa-star"></i>';
                                } elseif ($halfStar && $i == $fullStars) {
                                    echo '<i class="fa fa-star-half-o"></i>';
                                    $halfStar = false;
                                } else {
                                    echo '<i class="fa fa-star-o"></i>';
                                }
                            }
                            ?>
                        </div>
                        <h5>$<?php echo number_format($product['PRICE'], 2); ?></h5>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo '<p>No products found.</p>';
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male Fashion | Trang chủ</title>

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
                            <li class="active"><a href="./index.php">Trang chủ</a></li>
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
                            <li><a href="./blog.php">Bài viết</a></li>
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

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ Sưu Tập Mùa Hạ</h6>
                                <h2>Hạ - Thu Collections 2030</h2>
                                <p>Một nhãn hiệu chuyên nghiệp tạo ra những sản phẩm thiết yếu sang trọng, cam kết không ngừng về chất lượng vượt trội.</p>
                                <a href="shop.php" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Bộ Sưu Tập Mùa Đông</h6>
                                <h2>Đông - Xuân Collections 2030</h2>
                                <p>Một nhãn hiệu chuyên nghiệp tạo ra những sản phẩm thiết yếu sang trọng, cam kết không ngừng về chất lượng vượt trội.</p>
                                <a href="shop.php" class="primary-btn">Mua ngay <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Bộ Sưu Tập 2030</h2>
                            <a href="shop.php">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Phụ Kiện</h2>
                            <a href="shop.php">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Giày Xuân 2030</h2>
                            <a href="shop.php">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="bestsellers">Bán Chạy</li>
                        <li data-filter="newarrivals">Sản Phẩm Mới</li>
                        <li data-filter="hotsales">Khuyến Mãi</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter" id="product-container">
                <?php
                ?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Quần Áo <br /> <span>Bộ Sưu Tập Túi</span> <br /> Phụ Kiện</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Giảm giá</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Ưu Đãi Trong Tuần</span>
                        <h2>Túi vải quai dây</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>7</span>
                                <p>Ngày</p>
                            </div>
                            <div class="cd-item">
                                <span>4</span>
                                <p>Giờ</p>
                            </div>
                            <div class="cd-item">
                                <span>47</span>
                                <p>Phút</p>
                            </div>
                            <div class="cd-item">
                                <span>7</span>
                                <p>Giây</p>
                            </div>
                        </div>
                        <a href="shop.php" class="primary-btn">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>"Khơi nguồn phong cách lịch lãm, chúng tôi mang đến thời trang nam đẳng cấp, tôn vinh bản lĩnh và sự tự tin của quý ông hiện đại.".</p>
                        <h3>#Male_Fashion</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Bản tin mới nhất</span>
                        <h2>Xu Hướng Thời Trang Mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-1.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 16 Tháng 2, 2020</span>
                            <h5>Lợi Ích Của Việc Uống Cà Phê</h5>
                            <a href="#">Đọc Thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-2.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 21 Tháng 2, 2020</span>
                            <h5>Máy Uốn Tóc Nào Là Tốt Nhất</h5>
                            <a href="#">Đọc Thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="img/blog/blog-3.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 28 Tháng 2, 2020</span>
                            <h5>Tác Động Của Môi Trường Xung Quanh</h5>
                            <a href="#">Đọc Thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

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
    <script>
        $(document).ready(function() {
            // Hàm để gán sự kiện click cho sản phẩm
            function attachProductClickEvent() {
                const productItems = document.querySelectorAll('.product__item');

                productItems.forEach(item => {
                    item.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        if (productId) {
                            window.location.href = 'shop-details.php?id=' + productId;
                        }
                    });
                });
            }

            // Gán sự kiện click cho các sản phẩm sau khi tải sản phẩm
            $('.filter__controls li').click(function() {
                var filter = $(this).data('filter');
                $('.filter__controls li').removeClass('active');
                $(this).addClass('active');

                $.ajax({
                    url: 'index.php',
                    type: 'GET',
                    data: {
                        ajax: '1',
                        filter: filter
                    },
                    success: function(response) {
                        $('#product-container').html(response);
                        attachProductClickEvent(); // Gọi hàm gán sự kiện click
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                    }
                });
            });

            // Gán sự kiện click cho các sản phẩm ban đầu
            attachProductClickEvent();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productItems = document.querySelectorAll('.product__item');

            productItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    // Chỉ thực hiện chuyển hướng nếu không nhấp vào phần lớp phủ
                    const productId = this.getAttribute('data-id');
                    if (productId) {
                        window.location.href = 'shop-details.php?id=' + productId;
                    }
                });
            });

            const productHovers = document.querySelectorAll('.product__hover');
            productHovers.forEach(hover => {
                hover.addEventListener('click', function(event) {
                    event.stopPropagation(); // Ngăn chặn sự kiện click bên ngoài .product__hover
                    console.log("Hover actions triggered");
                });
            });
        });
    </script>
</body>

</html>