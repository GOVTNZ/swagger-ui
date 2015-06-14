# Using Swagger in Silverstripe

&nbsp;
## govtnz/swagger-ui
This package forks the current *swagger-ui* with the addition of one paragraph at the top of the [README.md](README.md) document and the addition of several new files:
* This *SILVERSTRIPE.md* documentation.
* The *composer.json* file.
* The */resources* folder and its content.

The structure and contents of the original *swagger-ui* repository are unchanged apart from the additional paragraph in the [README.md](README.md) document.
Govt.nz can merge new versions of the base *swagger-ui* repository by re-applying the above enhancements.
 
This *govtnz/swagger-ui* package was intended as a companion to [govtnz/silverstripe-api](https://github.com/govtnz/silverstripe-api), but can be used on its own.

&nbsp;
## Installation
1. Add [github.com/govtnz/swagger-ui](https://github.com/govtnz/swagger-ui) to your *composer.json* file and run **composer update**.
1. Ensure there is browser access to the required files inside */vendor/govtnz/swagger-ui/dist*. See **.htaccess rules** below.
1. Create a new page type and corresponding template that include the Swagger code in the */resources/code* and */resources/templates* subdirectories. 

&nbsp;
## Customise appearance
### Modify CSS
To modify the appearance of Swagger you can copy the Swagger UI CSS files from */dist/css* to another directory within your site and customise them.
If you do this you'll need to 

1. edit the corresponding *Requirements::* statements in the page controller, and possibly
1. remove the */govtnz/swagger-ui/dist/css* element from the *.htaccess* file entry.

### Use SASS
If you use SASS, the */resources* subdirectory includes SCSS files which were extracted from the original CSS using [css2scss](http://sebastianpontow.de/css2compass/).
You can move these to a directory that Compass is watching, then

1. remove the corresponding *Requirements::* statements in the page controller, and
1. remove the */govtnz/swagger-ui/dist/css* element from the *.htaccess* file entry.

### Change fonts
Modifying the Swagger UI CSS with either approach is a pre-requisite to modifying the default fonts. 
If you don't use the default fonts, remember to remove the */govtnz/swagger-ui/dist/fonts* element from the *.htaccess* file entry.

You'll find it helpful to check the examples in the */resources* subdirectory and read the **.htaccess rules** section below.

&nbsp;
## Customise functionality
Swagger UI's functionality is entirely written in Javascript.
It should not be necessary to edit the core Swagger UI files in */dist/lib*.
However, you might want to change some of the top-level behaviours, for which the key files are:
* */dist/swagger-ui.js*
* */resources/api-swagger.js*

You can copy these files to another location and edit them.
Remember to 

1. update the *Requirements::* statements in your page controller to reflect the new location, and 
1. remove from the *.htaccess* file entry any elements which are no longer required.

&nbsp;
## Resources for govtnz/swagger-ui
The */resources* subdirectory contains:

1. An example swagger-ui page controller in */resources/code/SwaggerPage.php*. You can copy the key sections from this into your own page controller.
1. The */resources/javascript/api-swagger.js* file which must be included in your page template.
1. Four *.scss* files in */resources/sass* which can be copied and used if your site uses SASS and you want to modify Swagger's appearance.
1. An example swagger-ui page template in */resources/templates/SwaggerPage.ss*. Copy the marked section into your own page template.

&nbsp;
## .htaccess rules
If your existing .htaccess rules restrict HTTP access to the */vendor* directory, you'll need to set up exceptions for the files required by *govtnz/swagger-ui*.
The essential files are:
* */dist/swagger-ui.js* (or */dist/swagger-ui.min.js*)
* */resources/javascript/api-swagger.js*
* The contents of */dist/lib*
* The contents of */dist/images* 

If you intend to use the default Swagger CSS and fonts, you'll also need to expose:
* The contents of */dist/css*
* The contents of */dist/fonts*

Here's an .htaccess rule that returns a 404 for all */vendor* files except the above six exceptions.
This rule should be modified if you customise your Swagger installation.

```
RedirectMatch 404 /vendor(?!/govtnz/resources/javascript/api-swagger.js|/govtnz/swagger-ui/dist/css|/govtnz/swagger-ui/dist/fonts|/govtnz/swagger-ui/dist/images|/govtnz/swagger-ui/dist/lib|/govtnz/swagger-ui/dist/swagger-ui\.js)
``` 

Alternatively you could use a combination of *RewriteCond* and *RewriteRule*.

### Why restrict access to /vendor?
It's good practice to prevent HTTP access to any file that doesn't need to be directly consumed by browsers.
This prevents security holes in this code being exploited by hackers, or the existence of certain packages offering clues to how your site can be compromised.
Typically the */vendor* directory contains code used by Silverstripe itself or by other packages within your Silverstripe installation, and doesn't need to be publicly exposed.

Each installation is different, however. The above .htaccess rule was good for our Silverstripe instance; your requirements may differ.

