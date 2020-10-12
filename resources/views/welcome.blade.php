<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire prosjekt</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <livewire:styles>
</head>
<body>
    {{-- Binder :allPosts som er en variabel man sender med til Livewire/Posts controlleren og kommer fra routes/web.php filen. --}}
    <livewire:posts />
    <livewire:scripts/>
</body>
</html>