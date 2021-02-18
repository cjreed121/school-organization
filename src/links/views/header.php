<html>

<head>
    <title>School Organization</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="menubar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/links/home">School Organization</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/links/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/links/about">About</a>
                    </li>
                    <?php
                    if(isset($_SESSION['loggedin'])){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/links/classes">Classes</a>
                    </li>
                    <?php
                    }
                    ?>
                    </ul>
                <?php if(!isset($_SESSION['loggedin'])){?>
                <a class="btn btn-secondary" href="/links/register">Register</a>
                <a class="btn btn-primary ml-2" href="/links/login">Log In</a>
                <?php } else { ?>
                    <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['name']; ?>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/links/profile">My Profile</a>
                    <a class="dropdown-item" href="/links/logout">Log Out</a>
                </div>
                </div>
                <?php } ?>
            </div>
            
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container">