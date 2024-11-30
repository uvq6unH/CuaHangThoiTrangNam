<?php
@session_start();
include 'auth.php'; // Xác thực người dùng
include 'db.php'; // Kết nối cơ sở dữ liệu

// Khởi tạo biến thông báo
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Kiểm tra các trường không được để trống
    if (empty($username) || empty($password) || empty($address) || empty($email) || empty($phone)) {
        $message = 'All fields are required!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email format!';
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) { // Ví dụ cho số điện thoại Việt Nam
        $message = 'Phone number must be 10 digits!';
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/', $password)) { // Kiểm tra mật khẩu
        $message = 'Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one special character!';
    } else {
        // Kiểm tra xem tên đăng nhập, email hoặc số điện thoại đã tồn tại chưa
        $checkUsername = $conn->prepare("SELECT * FROM user WHERE USERNAME = ? OR EMAIL = ? OR PHONE = ?");
        $checkUsername->bind_param("sss", $username, $email, $phone);
        $checkUsername->execute();
        $result = $checkUsername->get_result();

        if ($result->num_rows > 0) {
            $message = 'Username, Email, or Phone number already exists! Please choose another.';
        } else {
            // Hash mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Lưu thông tin người dùng vào cơ sở dữ liệu
            $sql = "INSERT INTO user (USERNAME, PASSWORD, ADDRESS, ROLE, EMAIL, PHONE, CREATED_DATE, ISACTIVE ) VALUES (?, ?, ?, 'user', ?, ?, NOW(), 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $hashedPassword, $address, $email, $phone); // Lưu mật khẩu đã băm

            if ($stmt->execute()) {
                $message = 'Sign up successfully!';
                // Đặt lại các giá trị input
                $username = $password = $address = $email = $phone = ''; // Làm rỗng các biến
            } else {
                $message = 'Something went wrong: ' . $stmt->error;
            }

            $stmt->close();
        }

        $checkUsername->close();
    }

    $conn->close();
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
    <title>Male Fashion | Đăng Ký</title>

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
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
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

    <section>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Tạo Tài Khoản</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
        <!--================login_part Area =================-->
        <section class="login_part section_padding ">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_text text-center">
                            <div class="login_part_text_iner">
                                <h2>Bạn là Khách hàng mới?</h2>
                                <p>Thời trang nam là một biểu hiện sôi động của cá tính, từ những bộ suit lịch lãm đến trang phục đường phố năng động.
                                    Nó luôn thay đổi, cho phép nam giới tự tin định hình phong cách riêng của mình.</p>
                                <a href="login-male.php" class="btn_3">Đã có Tài Khoản?</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="login_part_form">
                            <div class="login_part_form_iner">
                                <h3>Tạo mới ngay</h3>
                                <form class="row contact_form" action="" method="POST" novalidate="novalidate" onsubmit="return validateForm()">
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username (*)" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password (*)" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Address (*)" value="<?php echo htmlspecialchars($address ?? '', ENT_QUOTES); ?>" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email (*)" value="<?php echo htmlspecialchars($email ?? '', ENT_QUOTES); ?>" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone (*)" value="<?php echo htmlspecialchars($phone ?? '', ENT_QUOTES); ?>" required>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <button type="submit" value="submit" class="btn_3">Đăng Ký</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================login_part end =================-->
    </section>

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
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        var phpMessage = <?php echo json_encode($message ?? ''); ?>;

        if (phpMessage) {
            Toastify({
                text: phpMessage,
                duration: 3000,
                gravity: 'top',
                position: 'right',
                backgroundColor: 'linear-gradient(to right, #ff5f6d, #ffc371)'
            }).showToast();

            // Nếu đăng ký thành công, chuyển hướng sau 2 giây
            if (phpMessage === 'Sign up successfully!') {
                setTimeout(function() {
                    window.location.href = 'login-male.php';
                }, 1000);
            }
        }

        function validateForm() {
            let isValid = true;
            const inputs = document.querySelectorAll('.contact_form .form-control');
            let emptyFields = false;

            inputs.forEach(input => {
                if (input.required && !input.value) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    emptyFields = true; // Đánh dấu rằng có ít nhất một trường rỗng
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (emptyFields) {
                Toastify({
                    text: 'Please fill all required fields!',
                    duration: 3000,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#ff4444'
                }).showToast();
            }

            return isValid;
        }
    </script>

</body>

</html>