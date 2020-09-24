<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>Document</title>
</head>
<body>
@include('sweet::alert')

    <h1>Form</h1>
    <main id = "app">
        <form-component></form-component>
        <prueba-component></prueba-component>
    </main>



</body>
<script src="{{mix('js/app.js')}}"></script>
</html>