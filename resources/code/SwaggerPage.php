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

    /**
     * Replace the [PATH] placeholder for the final entry in both the following code blocks with the location where
     * you've copied the api-swagger.js file.
     */
    public function init(){
        parent::init();

        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.slideto.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.wiggle.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/jquery.ba-bbq.min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/handlebars-2.0.0.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/underscore-min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/backbone-min.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/highlight.7.3.pack.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/marked.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/lib/swagger-oauth.js');
        Requirements::javascript('vendor/govtnz/swagger-ui/dist/swagger-ui.js');
        Requirements::javascript('[PATH]/javascript/api-swagger.js');

        Requirements::combine_files(
            'swagger.js',
            array(
                'vendor/govtnz/swagger-ui/dist/lib/jquery.slideto.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/jquery.wiggle.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/jquery.ba-bbq.min.js',
                'vendor/govtnz/swagger-ui/dist/lib/handlebars-2.0.0.js',
                'vendor/govtnz/swagger-ui/dist/lib/underscore-min.js',
                'vendor/govtnz/swagger-ui/dist/lib/backbone-min.js',
                'vendor/govtnz/swagger-ui/dist/lib/highlight.7.3.pack.js',
                'vendor/govtnz/swagger-ui/dist/lib/marked.js',
                'vendor/govtnz/swagger-ui/dist/lib/swagger-oauth.js',
                'vendor/govtnz/swagger-ui/dist/swagger-ui.js',
                '[PATH]/javascript/api-swagger.js'
            )
        );
    }

    private static $allowed_actions = array();

}