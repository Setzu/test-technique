<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test Antadis</title>
    <link type="text/css" href="../../../public/css/style.css" rel="stylesheet" media="all" />
    <link type="text/css" href="../../../public/css/bootstrap.min.css" rel="stylesheet" media="all" />
    <script type="text/javascript" src="../../../public/js/script.js"></script>
</head>
<body>
<div class="login container">
    <div class="row">
        <!-- Error messages -->
        <?= SessionManager::flashMessages(); ?>
        <div class="col-md-4 col-md-offset-4">
            <h2>Identification</h2>

            <div class="form-box">
                <form method="post" action="/index.php" class="login-form">
                    <fieldset>
                        <label for="username">
                            <input type="text" name="username" id="username" placeholder="utilisateur" />
                        </label>
                        <label for="password">
                            <input type="password" name="password" id="password" placeholder="mot de passe" />
                        </label>
                        <br>
                        <br>
                        <div class="col-sm-offset-7 col-sm-4">
                            <input type="submit" id="submit" value="Connexion" />
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

