<style>
  * {
    font-family: 'Rajdhani';
  }

  .custom-style {
    width: 500px;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: black;">
  <div class="container">
    <a class="navbar-brand" style="font-weight: bold; font-size: 30px; color: #34ebe8;" href="index.php">Cy Vega Electronic Shop</a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="nav-item ms-auto custom-style">
      <form class="d-flex" action="search.php" method="GET">
        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit" value="Search">Search</button>
      </form>

    </div>


    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="categories.php"> Categories</a>
            </li>


            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="cart.php"></span>Cart</a>
            </li>
            <?php
            include("./functions/anti_xss.php");

            if (isset($_SESSION['auth'])) {
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Welcome
                  <?php echo sanitize($_SESSION['auth_user']['name']); ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  <li><a class="dropdown-item" href="myorders.php">My Orders</a></li>
                </ul>
          </ul>
          </li>
        <?php
            } else {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log in</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminlogin1.php"></a>
          </li>
        <?php
            }
        ?>
      </ul>
    </div>
  </div>
</nav>

<style>
  .nav-item:hover {

    color: white;
  }
</style>