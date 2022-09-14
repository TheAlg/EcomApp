<!DOCTYPE html>
<html>
    <head>
        <?= $this->partial('head') ?>
        <?= $this->assets->outputCss('headercss') ?>
        <?= $this->assets->outputJs('headerjs') ?>
    </head>
    <script>
    </script>
    <body>
        <?= $this->partial('header') ?>
        <?= $this->flash->output() ?>

        <?= $this->getContent() ?>
        <?= $this->partial('footer') ?>
        
        <?= $this->assets->outputJs('footerjs') ?>
    </body>
</html>
