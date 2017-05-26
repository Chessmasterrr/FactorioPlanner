<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="Site.css">
        <title><?php echo $lang['header'] ?></title>
    </head>
    <body>
        <div class="container-fluid">
            <form method="POST" action="index.php">
                <div class="row page-header">
                    <div class="col-xs-11">
                        <h1><?php echo $lang['header'] ?> <small><?php echo $lang['headerSmall'] ?> <a href="https://www.factorio.com/">Factorio</a>.</small></h1>
                    </div>
                    <div class="col-xs-1 text-right">
                        <select name="language" class="form-control language-selection" onchange="this.form.submit()">
                            <?php
// set languages dropdown
                            foreach ($languageHelper->getAvailableLanguages() as $langString) {
                                if (strcmp($language, $langString) === 0) {
                                    echo "                          <option value='{$langString}' selected='true'>{$langString}</option>\r\n";
                                } else {
                                    echo "                          <option value='{$langString}'>{$langString}</option>\r\n";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
