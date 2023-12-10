<!DOCTYPE html>
<html>
<head>
    <title>Your Page</title>
</head>
<body>

    {{-- Вывод уведомления --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- Остальное содержимое вашей страницы --}}
    <h1>Welcome to Your Page!</h1>

    {{-- Другой HTML-код и контент вашей страницы --}}

</body>
</html>
