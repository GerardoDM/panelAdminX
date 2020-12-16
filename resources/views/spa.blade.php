<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Xvolution</title>
</head>
<body>
  
   
    <main id="app">
        <app-component :user={{ Auth::user() }} ></app-component>
  
    </main>

</body>
<script src="{{asset('js/app.js')}}"></script>
</html>