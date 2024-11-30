<?php
include('../auth.php');
include('../db.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $idpayment = $_POST['idpayment'];
    $idtransport = $_POST['idtransport'];
    $orders_date = $_POST['orders_date'];
    $iduser = $_POST['iduser'];
    $total_money = $_POST['total_money'];
    $notes = $_POST['notes'];
    $recipient_name = $_POST['recipient_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "UPDATE orders SET IDPAYMENT = ?, IDTRANSPORT = ?, ORDERS_DATE = ?, IDUSER = ?, TOTAL_MONEY = ?, NOTES = ?, RECIPIENT_NAME = ?, ADDRESS = ?, PHONE = ? WHERE ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iisiissssi", $idpayment, $idtransport, $orders_date, $iduser, $total_money, $notes, $recipient_name, $address, $phone, $id);

        if (!$stmt->execute()) {
            $message = 'Execute failed: (' . $stmt->errno . ') ' . $stmt->error;
        } else {
            $message = 'Order updated successfully!';
        }

        $stmt->close();
    } else {
        $message = 'Prepare failed: (' . $conn->errno . ') ' . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT IDPAYMENT, IDTRANSPORT, ORDERS_DATE, IDUSER, TOTAL_MONEY, NOTES, RECIPIENT_NAME, ADDRESS, PHONE FROM orders WHERE ID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php"><img
                    src="../img/logo.png" alt="">
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang Chủ</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Chức Năng
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin-mau/Category.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Quản Lý Danh Mục</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin-mau/Orders.php">
                    <i class="fa-brands fa-shopify"></i>
                    <span>Quản Lý Đơn Hàng</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../admin-mau/Products.php">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>Quản Lý Sản Phẩm</span>
                </a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../admin-mau/Users.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Quản Lý Người Dùng</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../admin-mau/Transports.php">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                    <span>Quản Lý Vận Chuyển</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../admin-mau/Payments.php">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Quản Lý Thanh Toán</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../admin-mau/Feedbacks.php">
                    <i class="fa-solid fa-file"></i>
                    <span>Thống Kê Đánh Giá</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($username): ?>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($username); ?></span>
                                <?php endif; ?>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Trang Cá Nhân
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cài Đặt
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Hoạt Động
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng Xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Bảng</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Bảng Đơn Hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="add-button mb-3">
                                        <a href="Orders.php">
                                            Đơn Hàng
                                            <i class="fa-solid fa-folder-open"></i>
                                        </a>
                                    </div>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>IDPAYMENT</th>
                                                <th>IDTRANSPORT</th>
                                                <th>ORDERS_DATE</th>
                                                <th>IDUSER</th>
                                                <th>TOTAL_MONEY</th>
                                                <th>NOTES</th>
                                                <th>RECIPIENT_NAME</th>
                                                <th>ADDRESS</th>
                                                <th>PHONE</th>
                                                <th>UPDATE</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>IDPAYMENT</th>
                                                <th>IDTRANSPORT</th>
                                                <th>ORDERS_DATE</th>
                                                <th>IDUSER</th>
                                                <th>TOTAL_MONEY</th>
                                                <th>NOTES</th>
                                                <th>RECIPIENT_NAME</th>
                                                <th>ADDRESS</th>
                                                <th>PHONE</th>
                                                <th>UPDATE</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="form-control" type="text" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="idpayment" value="<?php echo htmlspecialchars($order['IDPAYMENT']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="idtransport" value="<?php echo htmlspecialchars($order['IDTRANSPORT']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="orders_date" value="<?php echo htmlspecialchars($order['ORDERS_DATE']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="iduser" value="<?php echo htmlspecialchars($order['IDUSER']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="total_money" value="<?php echo htmlspecialchars($order['TOTAL_MONEY']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="notes" value="<?php echo htmlspecialchars($order['NOTES']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="recipient_name" value="<?php echo htmlspecialchars($order['RECIPIENT_NAME']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="address" value="<?php echo htmlspecialchars($order['ADDRESS']); ?>" required>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="number" name="phone" value="<?php echo htmlspecialchars($order['PHONE']); ?>" required>
                                                </td>
                                                <td>
                                                    <button type="submit" name="submit" class="btn btn-outline-success">
                                                        Sửa Đơn Hàng
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Male Fashion</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng rời đi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng Xuất" bên dưới nếu bạn đã sẵn sàng để kết thúc phiên đăng nhập.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href="../logout.php">Đăng Xuất</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function showToast(message) {
            const toast = document.createElement('div');
            toast.style.position = 'fixed';
            toast.style.bottom = '20px';
            toast.style.right = '20px';
            toast.style.padding = '10px 20px';
            toast.style.backgroundColor = '#333';
            toast.style.color = '#fff';
            toast.style.borderRadius = '5px';
            toast.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.1)';
            toast.innerText = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => document.body.removeChild(toast), 500);
            }, 3000);
        }

        window.onload = function() {
            <?php if (!empty($message)) : ?>
                showToast("<?php echo $message; ?>");
            <?php endif; ?>
        };
    </script>

</body>

</html>