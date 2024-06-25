<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <script>
        $(document).ready(function() {
            $('#display-text-name').click(function() {
                var name = $(this).data('name');
                if($(this).is(':checked')) {
                    $('#name').val(name);
                } else {
                    $('#name').val('');
                }
            });

            $('#display-text-price').click(function() {
                if($(this).is(':checked')) {
                    var price  = $(this).data('price');
                    $('#price').val(price);
                } else {
                    $('#price').val('');
                }
            });
        });
    </script>
    
    <div class="container">
        <div class="d-flex">
            <label for="name" class="me-3">Name: </label>
            <input type="checkbox" id="display-text-name" class="form-check-input" data-name="{{$text}}">
        </div>
        <input type="text" id="name" class="form-control" readonly>
    </div>
    <div class="container">
        <div class="d-flex">
            <label for="price" class="me-3">Price: </label>
            <input type="checkbox" id="display-text-price" class="form-check-input" data-price="{{$price}}">
        </div>
        <input type="text" id="price" class="form-control" readonly>
    </div>
</body>
</html>
