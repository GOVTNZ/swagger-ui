# Using Swagger in Silverstripe

&nbsp;
## govtnz/swagger-ui
This package forks the current *swagger-ui* with the addition of one paragraph at the top of the [README.md](README.md) document.
It does add several new files:
* This *SILVERSTRIPE.md* documentation.
* The *composer.json* file.
* The */resources* folder and its content.

The structure and contents of the original *swagger-ui* repository are unchanged apart from the additional paragraph in the [README.md](README.md) document.
Govt.nz can merge new versions of the base *swagger-ui* repository by re-applying the above enhancements.
 
This *govtnz/swagger-ui* package was intended as a companion to [govtnz/silverstripe-api](https://github.com/govtnz/silverstripe-api), but can be used on its own.

&nbsp;
## Installation
1. Add [github.com/govtnz/swagger-ui](https://github.com/govtnz/swagger-ui) to your *composer.json* file and run **composer update**.
1. Ensure there is browser access to the required files inside */vendor/govtnz/swagger-ui/dist*. See **.htaccess rules** in [/resources/HTACCESS.md](/resources/HTACCESS.md) for examples.
1. Move the *api-swagger.js* file from the */resources* subdirectory to an appropriate location in your Silverstripe instance.
1. Create a new page type and corresponding template that include the Swagger code in the */resources* subdirectory. 
Note that the path to *api-swagger.js* has to match the location selected in the previous step.

&nbsp;
## Customise appearance
### Modify CSS
To modify the appearance of Swagger you can copy the Swagger UI CSS files from */dist/css* to another directory within your site and customise them.
If you do this you'll need to 
1. edit the corresponding *Requirements::* statements in the page controller, and possibly
1. remove the */govtnz/swagger-ui/dist/css* element from the *.htaccess* file entry.

### Use SASS
If you use SASS, the */resources* subdirectory includes SCSS files which were extracted from the original CSS using [css2scss](http://sebastianpontow.de/css2compass/).
You can move this to a directory that Compass is watching, then
1. remove the corresponding *Requirements::* statements in the page controller, and
1. remove the */govtnz/swagger-ui/dist/css* element from the *.htaccess* file entry.

### Change fonts
Modifying the Swagger UI CSS with either approach is a pre-requisite to modifying the default fonts. 
If you don't use the default fonts, remember to remove the */govtnz/swagger-ui/dist/fonts* element from the *.htaccess* file entry.

You'll find it helpful to check the examples in the */resources* subdirectory and read **.htaccess rules** in [/resources/HTACCESS.md](/resources/HTACCESS.md).

&nbsp;
## Customise functionality
Swagger UI's functionality is entirely written in Javascript.
It should not be necessary to edit the core Swagger UI files in */dist/lib*.
However, you might want to change some of the top-level behaviours, for which the key files are:
* */dist/swagger-ui.js* (or */dist/swagger-ui.min.js*)
* */resources/api-swagger.js*, in whatever location you've copied it to

You can freely amend your copy of */resources/api-swagger.js*, and you can copy */dist/swagger-ui.js* to another location and edit that.
Remember to 
1. update the *Requirements::* statements in your page controller to reflect the new location, and 
1. remove from the *.htaccess* file entry any elements which are no longer required.

