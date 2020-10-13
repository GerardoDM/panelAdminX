<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>Pivot</title>
</head>
<body>
    
    @include('includes.navbar')
    
    <main id = "app">
        <app-component></app-component>
        <pivot-component></pivot-component>
    </main>

</body>
<script src="{{mix('js/app.js')}}"></script>
</html>