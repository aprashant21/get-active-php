<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="box form-box">

        <style>
            .logo{
                height: 61px;
                width: 100px;
                object-fit: cover;
            }
            header {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
            }

            .form-box {
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 300px;
                margin: 0 auto;
            }

            .field {
                margin-bottom: 15px;
            }

            .input label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .input input {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }

            .btn {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 10px;
                cursor: pointer;
                width: 100%;
            }

            .btn:hover {
                background-color: #0056b3;
            }

            .links {
                margin-top: 15px;
                text-align: center;
            }

            .links a {
                color: #007bff;
                text-decoration: none;
            }

            .links a:hover {
                color: #0056b3;
            }
        </style>

        <div class="container">
            <div class="box form-box">
                <header>
                    <img src="../assets/images/logo.png" alt="Logo" class="logo">
                </header>

                <header>Sign Up</header>
                <form action="../controllers/signupController.php" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Register" required>
                    </div>
                    <div class="links">
                        Already a member? <a href="login.php">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>
