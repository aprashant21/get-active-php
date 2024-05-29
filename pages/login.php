<!DOCTYPE html>
<html>
<head></head>
<body>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #myForm {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 10px;
        text-decoration: none;
        color: #007bff;
    }

    a:hover {
        color: #0056b3;
    }

    .logo-container {
        text-align: center;
        margin-bottom: 20px; /* Adjust the margin as needed */
    }

    .logo{
        height: 61px;
        width: 100px;
        object-fit: cover;
    }
</style>




<div id="myForm">
    <form action='usercon.php' method='post'>
        <h1>Login</h1>

        <div class="logo-container">
            <img src="../assets/images/logo.png" alt="Logo" class="logo">
        </div>

        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required><br>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required><br>

        <input type="submit" value="Login"><br>

    </form>
</div>

</body>
</html>