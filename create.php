<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Create Post</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="/store.php" method="POST">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                

                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Add post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>