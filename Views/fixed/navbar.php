
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">ShippingApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">Tracking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'create_shipment.php' ? 'active' : '' ?>" href="create_shipment.php">Create shipment</a>
                </li>
<!--                <li class="nav-item dropdown">-->
<!--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">-->
<!--                        More-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a class="dropdown-item" href="create_shipment.php">Create Shipment</a></li>-->
<!--                        <li><a class="dropdown-item" href="track.php">Track Shipment</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>

            <!-- Right Side (User Info & Logout) -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['UserName'])): ?>
                    <li class="nav-item">
                        <a class="nav-link">Welcome, <?= $_SESSION['UserName']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="../app/Handlers/UserHandler.php?type=logout" class="nav-link btn btn-danger btn-sm text-white">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-white" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
