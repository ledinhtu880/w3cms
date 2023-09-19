<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>W3CMS</title>
  <link rel="shortcut icon" href="./assets/images/logo.png" type="image/x-icon">

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Template CSS Style -->
  <link rel="stylesheet" href="./assets/css/base.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="./assets/icons-1.11.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/fontawesome-free-6.4.0-web/css/all.min.css">

</head>

<body>
  <div class="container">
    <?php include './layout/navigation.php'; ?>

    <!-- - Start: Main content -->
    <div class="main">
      <div class="header">
        <div class="header__title">
          <a href="#"><i class="bi bi-list"></i></a>
          <span>Users</span>
        </div>
        <div class="header__search">
          <div class="header__search-wrapped">
            <i class="fa-solid fa-search"></i>
            <input class="header__search-input" type="text" name="" id="" placeholder="Search here...">
          </div>
        </div>
      </div>
      <div class="main__filter">
        <div class="filter__top">
          <span class="filter__title">Filter</span>
          <button class="btn btn--circle btn--primary filter__btn"></button>
        </div>
        <form action="">
          <div class="filter__body">
            <div class="filter__body-left">
              <input class="filter__control" type="email" name="" id="" placeholder="Email">
              <input class="filter__control" type="number" name="" id="" placeholder="Mobile">
              <select class="filter__control" name="role">
                <option disabled hidden selected value="default">Select Group</option>
                <option>Admin</option>
                <option>Manager</option>
                <option>Customer</option>
              </select>
            </div>
            <div class="filter__body-right">
              <button class="btn btn--primary"><i class="bi bi-search"></i>Filter</button>
              <button class="btn btn--white js-btnClear">Clear</button>
            </div>
        </form>
      </div>
    </div>
    <div class="main__content">
      <div class="content__top">
        <span class="content__title">Users</span>
        <div class="content__top--wrapped">
          <button class="btn btn--white">Delete</button>
          <a href="./user_add.php" class="content__btn">
            ADD USER
            <span><i class="fa-solid fa-plus"></i></span>
          </a>
        </div>
      </div>
      <div class="content__body">
        <?php
        require_once './connect.php';

        // - Pagination
        $query = "select count(*) from w3cms_users";

        $result = mysqli_query($strConnection, $query);
        $array = mysqli_fetch_array($result);
        $totalItems = $array['count(*)']; // - Tổng số người dùng 
        $itemsPerPage = 7;  // - Số người dùng mỗi trang
        $totalPages = ceil($totalItems / $itemsPerPage);  // - Tổng số trang
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // - Trang hiện tại

        // - Giới hạn hiển thị số liên kết phân trang
        $maxLinks = 3; // Số liên kết phân trang tối đa hiển thị
        $startPage = max($currentPage - floor($maxLinks / 2), 1);
        $endPage = min($startPage + $maxLinks - 1, $totalPages);
        $offset = $itemsPerPage * ($currentPage - 1);

        $query = "select * from w3cms_users ORDER BY ID DESC LIMIT $itemsPerPage offset $offset";
        $users = mysqli_query($strConnection, $query);
        ?>
        <table class="table" width="100%">
          <thead>
            <tr>
              <th><input class="primary__checkbox" type="checkbox" name="" id=""></th>
              <th>Full Name </th>
              <th>Email</th>
              <th>Gender</th>
              <th style="text-align: center">Groups</th>
              <th style="text-align: center">Mobile</th>
              <th>Date Of Birth</th>
              <th>Status</th>
              <th style="text-align: center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user) {
              $user['stt'] == 1 ? $status = '<i class="fa-solid fa-circle stt-active"></i>' : $status = '<i class="fa-solid fa-circle"></i>';
            ?>
              <tr>
                <td><input class="content_checkbox" type="checkbox" name="" id=""></td>
                <td><a href="#"><img src="<?= $user['image'] ?>" alt="#"><?= $user['first_name'] . ' ' . $user['last_name'] ?></a></td>
                <td><strong class="text-start"><?= $user['email'] ?></strong></td>
                <td><?= $user['gender'] ?></td>
                <td><span class="highlight"><?= $user['role'] ?></span></td>
                <td><?= $user['phone_number'] ?></td>
                <td><span class="text-start"><?= $user['dob'] ?></span></td>
                <td><?= $status ?></td>
                <td>
                  <ul class="content__menu">
                    <li><a style="background-color: #4CBC9A" href="#"><i class=" fa-solid fa-shield-halved"></i></a></li>
                    <li><a style="background-color: #ff6a59" href="./user_edit.php?id=<?= $user['id'] ?>"><i class="fa-solid fa-pencil"></i></a></li>
                    <li>
                      <a class="js-modal__btn" style="background-color: #f75a5b" href="#"><i class="fa-solid fa-trash"></i></a>
                      <div class="modal">
                        <div class="modal__container">
                          <div class="modal__wrapped">
                            <div class="modal__header">
                              <div class="modal__close"><i class="bi bi-x-lg"></i></div>
                            </div>
                            <div class="modal__body">
                              <h4>Are you sure?</h4>
                              <p>Do you really want to delete this user?<br> This process cannot be undone.</p>
                            </div>
                            <div class="modal__footer">
                              <a class="btn btn--primary btn--modal" href="./process_delete.php?id=<?= $user['id'] ?>">Delete</a>
                              <a class="btn btn--primary btn--modal js-modal-close" href="#">Cancel</a>
                            </div>
                            <a href="#" class="modal__quit js-modal-close"><i class="fa-solid fa-close"></i></a>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="content__footer">
        <div class="footer__left">
          <span>Page <?= $currentPage ?> of <?= $totalPages ?>.</span>
          <!-- <?= 'Total items = ' . $totalItems; ?> -->
        </div>
        <div class="footer__right">
          <a href="?page=<?= $currentPage - 1 ?>" class="btn"><i class="fa-solid fa-chevron-left"></i></a>
          <?php for ($page = $startPage; $page <= $endPage; $page++) {
            if ($currentPage == $page) { ?>
              <a href="?page=<?= $page ?>" class="btn active"><?= $page ?></a>
            <?php
            } else { ?>
              <a href="?page=<?= $page ?>" class="btn"><?= $page ?></a>
          <?php
            }
          }
          ?>
          <a href="?page=<?= $currentPage + 1 ?>" class="btn"><i class="fa-solid fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- - End: Main content -->

  <?php include './layout/sidebar.php'; ?>
  </div>

  <script src="./assets/js/app.js"></script>
</body>

<?php mysqli_close($strConnection); ?>


</html>