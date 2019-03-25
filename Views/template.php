<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Teste PHP" name="description" />
    <meta content="Guilherme Gaspar" name="author" />
    <title><?=PROJECT_TITLE?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/app.css">

    <!-- JS -->
    <script src="<?=BASE_URL?>/assets/plugins/jquery/jquery-3.3.1.js"></script>
    <script src="<?=BASE_URL?>/assets/plugins/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="conteudo">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="jumbotron mt-4">
                        <h1 class="display-4 text-center">Batalha da Sociedade do Anel</h1>
                    </div>
                </div>
            </div>

            <?php $this->loadView($viewName, $viewData); ?>
        </div>
    </div>

</body>
</html>