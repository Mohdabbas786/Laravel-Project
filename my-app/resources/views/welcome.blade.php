<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; margin-top: 50px;">
    <h1>Welcome to My Laravel Application!</h1>
    <h2>Hello, {{ $name }}!</h2>
    <p>This message is rendered dynamically using Blade.</p>

    <hr style="margin: 30px auto; width: 50%;">

    <form action="/submit-name" method="POST">
        @csrf
        <label for="username">Enter your custom name:</label><br><br>
        <input type="text" id="username" name="username" placeholder="e.g. Alice" required style="padding: 8px;">
        <button type="submit" style="padding: 8px 16px;">Update</button>
    </form>
</body>
</html>