<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach ($files as $file)
            <img src="/storage/{{ $file }}">
        @endforeach
    </ul>
</body>
</html>
