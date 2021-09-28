<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URL_ROOT; ?>">
            <img src="<?php echo URL_ROOT . '/img/logo.svg' ?>" width="30" height="30" alt=" logo" class="d-inline-block align-text-top">
            Sharepost Web
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">

            <!--Show elements if user is logged-->
            <?php if (isset($_SESSION['user_id'])) : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>">Home</a>
                    </li>
                </ul>
                <div class="navbar-nav profile dropdown">
                    <div class="photo">
                        <img class="user-profile-img" src="<?php echo URL_ROOT . '/app/views/users/img/' . $_SESSION['user_name'] . '.png'; ?>">
                    </div>
                    <a href="<?php echo URL_ROOT . '/users/profile/' . $_SESSION['user_id']; ?> " class="nav-link d-md-none">
                        <?php echo $_SESSION['user_name'] ?>
                    </a>
                    <a href="#" class="nav-link dropdown-toggle btn-sm d-none d-md-block " data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user_name'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo URL_ROOT . '/users/profile/' . $_SESSION['user_id']; ?> ">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo URL_ROOT; ?>/users/logout">Logout</a></li>
                    </ul>
                </div>
                <div class="navbar-nav d-md-none">
                    <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/logout">Logout</a>
                </div>
            <?php else : ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="<?php echo URL_ROOT; ?>/users/register">Register</a>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login">Login</a>
                </div>
            <?php endif; ?>
            <!--<form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>-->
        </div>
    </div>
</nav>