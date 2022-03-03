<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login Page </title>
    <style>
        Body {
            font-family: Calibri, Helvetica, sans-serif;
            background-color: pink;
        }

        button {
            background-color: #4CAF50;
            width: 50%;
            color: orange;
            padding: 15px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
        }

        form {
            border: 3px solid #f1f1f1;
            width:40%;
            margin:auto;
        }

        input[type=text], input[type=password] {
            width: 100%;
            margin: 8px 0;
            padding: 12px 20px;
            display: inline-block;
            border: 2px solid green;
            box-sizing: border-box;
        }

        button:hover {
            opacity: 0.7;
        }
        .container {
            padding: 25px;
            background-color: lightblue;
        }
    </style>
</head>
<body>
<div style="text-align: center;"><h1> user Login Form </h1></div>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="container">
        <label>Username : </label>
        <label>
            <input type="text" placeholder="Enter Username" name="username" required>
        </label>
        <label>Password : </label>
        <label>
            <input type="password" placeholder="Enter Password" name="password" required>
        </label>
        <button type="submit">Login</button>
        <label>
            <input type="checkbox" <?= $inputs['remember_me'] ?? '' ?>>
        </label> Remember me
    </div>
</form>
</body>
</html>


