<?php
require_once("include/initialize.php");

?>
<?php
// login confirmation
if (isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root . "index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
  .drawer {
    background-color: black;
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 550px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    transform: translateX(-100%);
    animation: slide-in 1s forwards;
  }
  @keyframes slide-in {
    to {
      transform: translateX(0);
    }
  }
  .slogan {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .slogan span {
    opacity: 0;
    animation: fade-in 1s forwards;
  }
  .slogan span:nth-child(1) {
    animation-delay: 0.5s;
  }
  .slogan span:nth-child(2) {
    animation-delay: 1s;
  }
  .slogan span:nth-child(3) {
    animation-delay: 1.5s;
  }
  @keyframes fade-in {
    to {
      opacity: 1;
    }
  }
</style>

</head>
<body class="bg-overlay flex items-center justify-center h-screen relative">
<div class="drawer flex flex-col items-center justify-center p-4">
  <img src="meals\uploaded_photos\urbanlogo1.png" alt="Urban Brew Logo" class="w-48 h-48 mb-24"> <!-- Adjust the path and size as needed -->
  <div class="slogan text-center">
    <h1 class="text-4xl font-bold text-white">Welcome To Urban-Brew</h1>
    <span class="text-2xl font-bold text-white mt-8">"Sip, Click, Repeat – "</span>
    <span class="text-2xl font-bold text-white">The Urban Brews Way."</span>
  </div>
</div>
  <div class="container mx-auto max-w-md shadow-lg rounded-lg bg-white p-8 ml-auto ">
    <section id="content">
      <?php check_message(); ?>
      <form action="" method="POST" class="space-y-6">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-4">Urban-Brew</h1>
        <div>
          <input type="text" placeholder="Username" required id="username" name="user_email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" />
        </div>
        <div>
          <input type="password" placeholder="Password" required id="password" name="user_pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" />
        </div>
        <div>
          <input type="submit" name="btnLogin" value="Log in" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600" />
        </div>
      </form>
    </section>
  </div>
  <script src="js/index.js"></script>
</body>
</html>

<?php

if (isset($_POST['btnLogin'])) {
    $email = trim($_POST['user_email']);
    $upass  = trim($_POST['user_pass']);
    $h_upass = sha1($upass);

    if ($email == '' OR $upass == '') {

        message("Invalid Username or Password!", "error");
        redirect("login.php");

    } else {
        //it creates a new objects of member
        $user = new User();
        //make use of the static function, and we passed to parameters
        $res = $user::userAuthentication($email, $h_upass);
        if ($res == true) {
            message("You logon as " . $_SESSION['ROLE'] . ".", "success");
            if ($_SESSION['ROLE'] == 'Administrator' || $_SESSION['ROLE'] == 'Cashier') {

                $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
                $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'];
                $_SESSION['ADMIN_USERNAME'] = $_SESSION['USERNAME'];
                $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];

                unset($_SESSION['USERID']);
                unset($_SESSION['FULLNAME']);
                unset($_SESSION['USERNAME']);
                unset($_SESSION['PASS']);
                unset($_SESSION['ROLE']);

                redirect(web_root . "index.php");
            }
        } else {
            message("Account does not exist! Please contact Administrator.", "error");
            redirect(web_root . "login.php");
        }
    }
}
?>