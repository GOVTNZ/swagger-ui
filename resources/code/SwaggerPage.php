<?php

/**
 * Source: https://github.com/govtnz/swagger-ui.git
 * Author: Govt.nz
 *
 * This class demonstrates how to include Swagger within Silverstripe.
 */

class SwaggerPage extends Page {

    private static $db = array();
    private static $allowed_children = array();
    private static $can_be_root = true;

    private static $singular_name = 'Swagger page';
    private static $plural_name = 'Swagger page';
    private static $description = 'Create a page with an embedded Swagger user interface';


}

class SwaggerPage_Controller extends Page_Controller {

    public function init(){
        parent::init();

        // --------------------------------------------------------------------
        // CSS
        // --------------------------------------------------------------------

        Requirements::css('vendor/govtnz/swagger-ui/dist/css/reset.css', 'print,screen');
        Requirements::css('vendor/govtnz/swagger-ui/dist/css/typography.css', 'print,screen');
        Requirements::css('vendor/govtnz/swagger-ui/dist/css/print.css', 'print');
        Requirements::css('vendor/govtnz/swagger-ui/dist/css/screen.css', 'screen');

        $print = array(
            'vendor/govtnz/swagger-ui/dist/css/reset.css',
            'vendor/govtnz/swagger-ui/dist/css/typography.css',
            'vendor/govtnz/swagger-ui/dist/css/print.css'
        );
        Requirements::combine_files('swagger-print.css', $print, 'print');

        $screen = array(
            'vendor/govtnz/swagger-ui/dist/css/reset.css',
            'vendor/govtnz/swagger-ui/dist/css/typography.css',
            'vendor/govtnz/swagger-ui/dist/css/screen.css'
        );
        Requirements::combine_files('swagger-screen.css', $screen, 'screen');

        // --------------------------------------------------------------------
        // Javascript
        // --------------------------------------------------------------------

        parent::init();

        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.slideto.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.wiggle.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.ba-bbq.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/handlebars-2.0.0.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/underscore-min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/backbone-min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/swagger-ui.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/highlight.7.3.pack.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/marked.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/swagger-oauth.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/resources/javascript/api-swagger.js');

        Requirements::combine_files(
            'swagger.js',
            array(
                'vendor/govtnz/swagger-ui/dist/lib/jquery.slideto.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/jquery.wiggle.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/jquery.ba-bbq.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/handlebars-2.0.0.js',
                'vendor/govtnz/swagger-ui/dist/lib/underscore-min.js',
                'vendor/govtnz/swagger-ui/dist/lib/backbone-min.js',
                'vendor/govtnz/swagger-ui/dist/swagger-ui.js',
                'vendor/govtnz/swagger-ui/dist/lib/highlight.7.3.pack.js',
                'vendor/govtnz/swagger-ui/dist/lib/marked.js',
                'vendor/govtnz/swagger-ui/dist/lib/swagger-oauth.js',
                'vendor/govtnz/swagger-ui/resources/javascript/api-swagger.js'
            )
        );
    }

    private static $allowed_actions = array();

    public function APIDir(){
        $dir = Director::absoluteURL(Config::inst()->get('Swagger', 'data_dir'));
        return (isset($dir)) ? $dir : Director::absoluteURL("assets/api");
    }

    public function APIVersions(){
        // Populate the available API versions, selecting the most recent as the default
        $dir = Director::baseFolder().Config::inst()->get('Swagger', 'data_dir');
        $api_data_dir = (isset($dir)) ? $dir : Director::baseFolder()."/assets/api";
        if (file_exists($api_data_dir)){
            $dirlist = array();
            foreach (new DirectoryIterator($api_data_dir) as $subdir) {
                if($subdir->isDir() && !$subdir->isDot())
                    $dirlist[] = strtolower($subdir->getFileName());
            }
            if (count($dirlist) > 0){
                sort($dirlist);
                $out = new ArrayList();
                for ($pos = 0; $pos < count($dirlist); $pos++){
                    $out->push(new ArrayData(array(
                        "Path" => $dirlist[$pos],
                        "Name" => str_replace('v', 'version ', $dirlist[$pos]),
                        "Selected" => (($pos === count($dirlist) - 1) ? 'selected' : '')
                    )));
                }
                return $out;
            }
        }
        return null;
    }

}