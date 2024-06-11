<style>
    .sub-menu-wrap {
        position: fixed;
        top: 9%;
        right: -1%;
        width: 320px;
        max-height: 0;
        overflow: hidden;
        margin-right: 20px;
        margin-top: 70px;
        transition: max-height 0.5s;
        z-index: 100;
    }

    .sub-menu-wrap.open-menu {
        max-height: 400px;
    }

    .sub-menu {
        background: #fff;
        padding: 20px;
        margin: 10px;
        border-bottom-right-radius: 16px;
        border-bottom-left-radius: 16px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info h3 {
        font-weight: 500;
    }

    .user-info img {
        width: 60px;
        border-radius: 50%;
        margin-right: 15px;
    }

    .sub-menu hr {
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 10px;
    }

    .sub-menu-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #525252;
        margin: 12px 0;
    }

    .sub-menu-link p {
        width: 100%;
    }

    .sub-menu-link img {
        width: 40px;
        background: #e5e5e5;
        border-radius: 50%;
        padding: 8px;
        margin-right: 15px;
    }

    .sub-menu-link span {
        font-size: 22px;
        transition: transform 0.5s;
    }

    .sub-menu-link:hover span {
        transform: translateX(5px);
    }

    .sub-menu-link:hover p {
        font-weight: 600;
    }

    .link_btn {
        background-color: brown;
        padding: 6px;
        border-radius: 10px;
        margin-left: 10px;
        color: white;
        font-weight: 500;
    }
</style>


<?php  



?>
<!-- Topbar Start -->
<div class="container-fluid">
      
      <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
          <div class="col-lg-4">
              <a href="index.php" class="text-decoration-none">
                  <span class="h1 text-uppercase text-primary bg-dark px-2">Eat</span>
                  <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">own</span>
              </a>
          </div>
          <div class="col-lg-4 col-6 text-left">
       <!-- search_form.php -->

<form action="search.php" method="post">
    <div class="input-group">
        <input type="text" class="form-control" name="search_box" placeholder="Search for products">
        <div class="input-group-append">
            <button type="submit" name="search_btn" class="input-group-text bg-transparent text-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>


              
          </div>
          
          <div class="col-lg-4 col-6 text-right">
              <p class="m-0">Customer Service</p>
              <h5 class="m-0">+92 304 2534678</h5>
          </div>
      </div>
  </div>
  <!-- Topbar End -->



  <div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Welcome Home</h6>
            </a>
        </div>
        <div class="col-lg-9">  
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="cart.php" class="nav-item nav-link">Cart</a>
                        <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>

                    <!-- Right-aligned user info and logout -->
                    <div class="navbar-nav ml-auto py-0">
                  
<?php
  // ...

  // Check if the user is logged in
  if (isset($_SESSION['user_name'])) {
    echo '<div class="user-links">';
    echo '<img style="height:40px; margin-left:10px; cursor: pointer;" src="img/3135715-removebg-preview.png" class="user-pic" onclick="toggleSubMenu()" >';
    echo '</div>';

    // Submenu content
    echo '<div class="sub-menu-wrap" id="subMenu">';
    echo '<div class="sub-menu">';
    
    // Display user information if logged in
    echo '<div class="user-info">';
    echo '<img src="img/3135715-removebg-preview.png" >';
    echo '<div class="user-info" style="display:block;">';
    echo '<h3 style="text-align:left;">Hello, ' . $_SESSION['user_name'] . '</h3>';
    echo '<h6>' . $_SESSION['user_email'] . '</h6>';
    echo '</div>';
    echo '</div>';
    echo '<hr />';
    
    // Other submenu links
    $menuLinks = [
        ['href' => 'cart.php', 'text' => 'Cart'],
        ['href' => 'contact.php', 'text' => 'Contact Us'],
        ['href' => 'order.php', 'text' => 'History']
    ];
    
    foreach ($menuLinks as $link) {
        echo '<a href="' . $link['href'] . '" class="sub-menu-link">';
        echo '<p style="text-align:left;">' . $link['text'] . '</p>';
        echo '<br>';
        echo '</a>';
    }
    
    // Display logout link if logged in
    echo '<a href="logout.php" class="sub-menu-link">';
    echo '<p style="background-color: red; border-radius:8px; text-align:center; color:white; font-weight:600; margin-top:5px; padding:5px;">Logout</p>';
    echo '</a>';
    
    echo '</div>';
    echo '</div>';
  } else {
    echo '<div class="user-links">';
    echo '<a class="btn btn-primary text-decoration-none me-2" href="login.php">Login</a>';
    echo '<a class="btn btn-primary text-decoration-none" href="register.php">Register</a>';
    echo '</div>';
  }
?>                   </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
  function toggleSubMenu() {
    var subMenu = document.getElementById('subMenu');
    subMenu.classList.toggle('open-menu');
  }
</script>


