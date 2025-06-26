<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="Style.css" rel="stylesheet" >
</head>
<body>
    <header>
        <h1>Welcome To Admin Login Page </h1>
    </header>
    <div class="container">
        <div class="content">
            <h2>Login</h2>
            <form action="loginAct.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <button type="submit" value="login" name="login">Submit</button><br>
            </form>
        </div>
    </div>

</body>
</html>