<?php
session_start();
include 'auth.php'; // Xác thực người dùng
include 'db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Lấy thông tin người dùng từ cơ sở dữ liệu
$sql = "SELECT NAME, USERNAME, PHONE, EMAIL, ADDRESS, ROLE FROM user WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nameParts = explode(' ', $user['NAME'], 2);
    $firstName = $nameParts[0];
    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
} else {
    echo "Không tìm thấy thông tin người dùng.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Male Fashion | Trang Cá Nhân</title>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Trang cá nhân</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Trang chủ</a>
                            <span>Trang cá nhân</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <nav class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="profile-form" action="update-profile.php" method="post" class="needs-validation" novalidate onsubmit="return validateForm()">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($firstName); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ<span>*</span></p>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($lastName); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tài Khoản<span>*</span></p>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['USERNAME']); ?>" disabled>
                                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['USERNAME']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Mật Khẩu<span>*</span></p>
                                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Mật Khẩu Mới</p>
                                        <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Xác Nhận Mật Khẩu</p>
                                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Điện Thoại<span>*</span></p>
                                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['PHONE']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['EMAIL']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa Chỉ<span>*</span></p>
                                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['ADDRESS']); ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="primary-btn">Lưu Thay Đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Thông Tin Của Bạn</h4>
                                <ul class="checkout__total__products">
                                    <li>Tên: <span><?php echo htmlspecialchars($user['NAME']); ?></span></li>
                                    <li>Tài Khoản: <span><?php echo htmlspecialchars($user['USERNAME']); ?></span></li>
                                    <li>Điện Thoại: <span><?php echo htmlspecialchars($user['PHONE']); ?></span></li>
                                    <li>Email: <span><?php echo htmlspecialchars($user['EMAIL']); ?></span></li>
                                    <li>Địa Chỉ: <span><?php echo htmlspecialchars($user['ADDRESS']); ?></span></li>
                                </ul>
                                <div class="d-flex justify-content-center">
                                    <?php if ($user['ROLE'] === 'admin'): ?>
                                        <a href="admin-mau/index.php" class="primary-btn">Admin</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- Checkout Section End -->

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('update-profile.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: data.status === 'success' ? '#28a745' : '#ff5f6d',
                    }).showToast();
                })
                .catch(error => {
                    Toastify({
                        text: 'Có lỗi xảy ra, vui lòng thử lại.',
                        duration: 3000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '#ff5f6d',
                    }).showToast();
                });
        });

        function validateForm() {
            let isValid = true;
            const inputs = document.querySelectorAll('.checkout__input input');
            inputs.forEach(input => {
                if (input.required && !input.value) {
                    isValid = false;
                    input.classList.add('is-invalid');
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            return isValid;
        }
    </script>
</body>

</html>