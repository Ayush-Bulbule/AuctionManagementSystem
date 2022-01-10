<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

    <title>Admin-Login -eAuct!</title>
    <style>
        body {
            height: 100vh;
            background-color: #2e2e2e;
        }

        .login-icon {
            width: 100px;
            height: 100px;
            position: absolute;
            /* top: -50px; */
            left: 50%;
            right: 50%;
            transform: translate(-50%, -50%);
        }

        .btn-login {
            background-image: linear-gradient(to right, #f23fff 51%, #9e1aff 100%);
            box-shadow: 2px 1px 10px #bf66ffe5;
            color: white;
            font-weight: 500;
        }

        footer {
            margin-top: -20px;
        }
    </style>
</head>

<body>
    <div class="container h-100 d-flex justify-content-center ">
        <div class="row w-100 d-flex align-items-center">
            <div class="col-lg-4  mx-auto card p-3 shadow rounded">
                <img src="assets/key.png" alt="key-image" class="img-fluid login-icon rounded-circle">
                <form action="login_auth.php" method="POST">
                    <div class="mb-3 mt-5">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" name="submit" class="btn-login btn w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-center text-light">&copy; eAuct - Ayush Bulbule</p>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>