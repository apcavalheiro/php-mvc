<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/img/favicon.ico" rel="icon">
    <title>PHP-MVC - Internal Server Error</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/" class="navbar-brand">
                    PHP - MVC</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home <span class="sr-only">(current)</span></a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="jumbotron">
        <h1 class="text-center">Internal Server Error</h1>
        <h2 class="text-center">Error 500</h2>
        <h3 class="text-center">
            <?= $varMessage ?>
        </h3>
    </div>

    </div>
    </div>
    <footer>
        <p>&copy; 2019 Adriano Cavalheiro.</p>
    </footer>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</body>

</html>