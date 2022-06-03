<!DOCTYPE html>
<html>
    <head>
        {{ partial('head') }}
        {{ assets.outputCss('headercss') }}
        {{ assets.outputJs('headerjs') }}
    </head>
    <body>
        {{ partial('header') }}
        {{ flash.output() }}

        {{ content() }}
        {{ partial('footer') }}
        
        {{ assets.outputJs('footerjs') }}
    </body>
</html>
