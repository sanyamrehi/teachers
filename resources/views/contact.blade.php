<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Send</button>
    </form>
</body>
</html>
    