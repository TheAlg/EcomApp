<?php
declare(strict_types=1);

namespace Base\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Assets\Manager;
use Phalcon\Html\TagFactory;
use Phalcon\Html\Escaper;


class AssetsProvider implements ServiceProviderInterface
{
    protected const VERSION = "1.0.0";
    /**
     * @var string
     */
    protected $providerName = 'assets';

    /**
     * @param DiInterface $di
     *
     * @return void
     */
    public function register(DiInterface $di): void
    {
        $escaper = new Escaper;
        $tag = new TagFactory($escaper);
        $assetManager = new Manager($tag);
        $di->setShared($this->providerName, function () use ($assetManager) {

            $assetManager
                ->collection('headerjs')
                ->addJs('assets/js/plugins/jquery-3.6.0.min.js', true)
                ->addJs('assets/js/plugins/nouislider.min.js', true)
                ->addJs('assets/js/plugins/wNumb.js', true)
                ->addJs('assets/js/plugins/pagination.js', true)
                ->addJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', false)
                ->addJs('assets/js/main.js', true); //main


            $assetManager
            ->collection('headercss')
                ->addCss('assets/css/bootstrap.min.css',true)
                ->addCss('assets/css/style.css', true) // main
                //skins
                ->addCss('assets/css/demos/demo-13.css', true)
                ->addCss('assets/css/skins/skin-demo-13.css', true)

                //->addCss('assets/css/main.min.css', true)
                ->addCss('assets/css/plugins/owl-carousel/owl.carousel.css',true)
                ->addCss('assets/css/plugins/magnific-popup/magnific-popup.css',true)
                ->addCss('assets/css/plugins/jquery.countdown.css', true)
                ->addCss('assets/css/plugins/nouislider/nouislider.css',true);

        //JS footer
            $assetManager
            ->collection('footerjs')
                ->addJs('assets/js/app/main.js', true)
                ->addJs('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', false)
                //->addJs('assets/js/plugins/demos/demo-2.js', true)
                ->addJs('assets/js/plugins/superfish.min.js', true)
                ->addJs('assets/js/plugins/owl.carousel.min.js', true)
                ->addJs('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', false)
                ->addJs('assets/js/plugins/bootstrap.bundle.min.js', true)
                ->addJs('assets/js/plugins/jquery.waypoints.min.js', true)
                ->addJs('assets/js/plugins/jquery.plugin.min.js', true)
                ->addJs('assets/js/plugins/jquery.magnific-popup.min.js', true)
                ->addJs('assets/js/plugins/jquery.countdown.min.js', true)
                ->addJs('assets/js/plugins/jquery.hoverIntent.min.js', true)
                ->addJs('assets/js/plugins/bootstrap-input-spinner.js', true)

                ->addJs('assets/js/demos/demo-13.js', true);

                




            return $assetManager;
        });
    }
}
