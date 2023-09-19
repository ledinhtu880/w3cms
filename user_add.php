<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>W3CMS</title>

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
          <span>Add User</span>
        </div>
        <div class="header__search">
          <div class="header__search-wrapped">
            <i class="fa-solid fa-search"></i>
            <input class="header__search-input" type="text" name="" id="" placeholder="Search here...">
          </div>
        </div>
      </div>
      <div class="main__content">
        <div class="content__top">
          <span class="content__title">New User Form</span>
        </div>
        <div class="content__body" style="padding-inline: 5rem;">
          <?php
          require_once './connect.php';
          $query = "select * from w3cms_users where id ='$id'";
          $users = mysqli_query($strConnection, $query);
          ?>
          <form action="/process_add.php" method="post" class="myForm" id="addUser-form">
            <div class="form__header">
              <div class="form__wrapped">
                <img class="form__avatar" src="./assets/images/default.jpg" alt="#">
                <div class="form__check">
                  <input type="checkbox" name="status" id="status">
                  <span>is active</span>
                </div>
              </div>
              <div class="form__wrapped">
                <div class="form__wrapped form__wrapped--row">
                  <div class="form__group">
                    <label for="first_name" class="form__label">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form__control" placeholder="First Name">
                  </div>
                  <div class="form__group">
                    <label for="last_name" class="form__label">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="form__control" placeholder="Last Name">
                  </div>
                </div>
                <div class="form__group">
                  <label for="username" class="form__label">Username<span class="mandatory">*</span></label>
                  <input type="text" name="username" id="username" class="form__control" placeholder="Username">
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="email" class="form__label">Email<span class="mandatory">*</span></label>
                  <input type="email" name="email" id="email" class="form__control" placeholder="Email">
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="phone_number" class="form__label">Phone Number<span class="mandatory">*</span></label>
                  <input type="text" name="phone_number" id="phone_number" class="form__control" placeholder="Phone Number">
                  <span class="form__message"></span>
                </div>
              </div>
            </div>
            <div class="form__body">
              <div class="form__wrapped form__wrapped--row">
                <div class="form__group">
                  <label for="role" class="form__label">Role</label>
                  <select class="form__control" name="roles" id="roles">
                    <option value="default">Select the Role</option>
                    <option value="role1">Manager</option>
                    <option value="role2">Customer</option>
                  </select>
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="gender" class="form__label">Gender<span class="mandatory">*</span></label>
                  <select class="form__control" name="gender" id="gender">
                    <option value="default">Choose gender</option>
                    <option value="gender1">Male</option>
                    <option value="gender2">Female</option>
                    <option value="gender3">Others</option>
                  </select>
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="dob" class="form__label">Date of Birth<span class="mandatory">*</span></label>
                  <input class="form__control" type="date" name="dob" id="dob" placeholder="dob">
                  <span class="form__message"></span>
                </div>
              </div>
              <div class="form__wrapped form__wrapped--row">
                <div class="form__group">
                  <label for="fb" class="form__label">Facebook URL</label>
                  <input class="form__control" type="text" name="fb" id="fb">
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="twitter" class="form__label">Twitter URL</label>
                  <input class="form__control" type="text" name="twitter" id="twitter">
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="linkedin" class="form__label">Linkedin URL</label>
                  <input class="form__control" type="text" name="linkedin" id="linkedin">
                  <span class="form__message"></span>
                </div>
              </div>
              <div class="form__group">
                <label class="form__label" for="about">About</label>
                <textarea class="form__control" name="about" id="" cols="30" rows="10" placeholder="Write About YourSelf..."></textarea>
                <span class="form__message"></span>
              </div>
              <div class="form__wrapped form__wrapped--row">
                <div class="form__group">
                  <label for="password" class="form__label">Password<span class="mandatory">*</span></label>
                  <input class="form__control" type="password" name="password" id="password" placeholder="Password">
                  <span class="form__message"></span>
                </div>
                <div class="form__group">
                  <label for="password_confirmation" class="form__label">Confirm Password<span class="mandatory">*</span></label>
                  <input class="form__control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
                  <span class="form__message"></span>
                </div>
              </div>
            </div>
            <div class="form__footer">
              <button class="btn btn--save">Save</button>
              <button class="btn btn--cancel">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- - End: Main content -->

    <?php include './layout/sidebar.php'; ?>
    <?php mysqli_close($strConnection); ?>
  </div>
  <script src="./assets/js/validator.js"></script>
  <script src="./assets/js/app.js"></script>
  <script>
    Validator({
      form: '#addUser-form',
      errorSelector: '.form__message',
      formGroupSelector: '.form__group',
      rules: [
        Validator.isRequired('#username'),
        Validator.isRequired('#phone_number'),
        Validator.isEmail('#email'),
        Validator.isRequired('#dob', 'Vui lòng nhập ngày sinh'),
        Validator.minLength('#password', 6),
        Validator.isRequired('#password_confirmation'),
        Validator.isConfirmed("#password_confirmation", function() {
          return document.querySelector('#addUser-form #password').value;
        }, 'Mật khẩu nhập lại không chính xác'),
      ],
    })
  </script>
</body>


</html>