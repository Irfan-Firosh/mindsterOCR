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

            $('#display-desc-name').click(function() {
                if($(this).is(':checked')) {
                    var desc  = $(this).data('desc');
                    $('#desc').val(desc);
                } else {
                    $('#desc').val('');
                }
            });
        });
    </script>
    
    <div class="row">
        <div class="col">
            <form action="{{route('upload')}}" method="POST" class="mt-5 mx-5" enctype="multipart/form-data">
                @csrf
                <input class="form-control" name="file" type="file">
                @error('file')
                <div class="mx-3">
                    <span class="" style="color:red;">{{$message}}</span>
                </div>
                @enderror
                <div class="form-group mt-3">
                    <label for="dropdown">Choose Type:</label>
                    <select class="form-control" id="type" name="type">
                        <option value="">Choose an option</option>
                        <option value="title">Title</option>
                        <option value="price">Price</option>
                        <option value="desc">Description</option>
                    </select>
                    @error('type')
                    <div class="mx-3">
                        <span class="" style="color:red;">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload</button>
            </form>
        </div>
        <div class="col">
            <div class="mx-5 p-3">
                <div class="row mb-2">
                    <div class="col">
                        <div class="d-flex">
                            <label for="name" class="me-3">Name: </label>
                        </div>
                        <input type="text" id="name" class="form-control">
                        <div class="d-flex mt-2">
                            <input type="checkbox" id="display-text-name" class="form-check-input" data-name="{{$title}}"> <p class="mx-3">Auto</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex">
                            <label for="price" class="me-3">Price: </label>
                        </div>
                        <input type="text" id="price" class="form-control">
                        <div class="row">
                            <div class="d-flex mt-2 col">
                                <input type="checkbox" id="display-text-price" class="form-check-input" data-price="{{$price}}"> <p class="mx-3">Auto</p>
                            </div>
                            <div class="d-flex col mt-2">
                                <input type="checkbox" id="display-offer-price" class="form-check-input" data-price="{{$price}}"> <p class="mx-3">Keep Offer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="desc">Description: </label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    <div class="d-flex mt-2 col">
                        <input type="checkbox" id="display-desc-name" class="form-check-input" data-desc="{{$desc}}"> <p class="mx-3">Auto</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
