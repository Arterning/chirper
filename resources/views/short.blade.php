<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
</head>
<body>
    <h1>URL Shortener</h1>

    <form action="/shorten" method="POST">
        @csrf
        <label for="original_url">Enter a long URL:</label>
        <input type="url" name="original_url" required>
        <button type="submit">Shorten</button>
    </form>

    @if (session('short_url'))
        <p>Short URL: <a href="{{ session('short_url') }}">{{ session('short_url') }}</a></p>
    @endif
</body>
</html>
