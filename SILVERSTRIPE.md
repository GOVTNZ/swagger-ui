# Using Swagger in Silverstripe

&nbsp;

&nbsp;
## govtnz/swagger-ui
This package forks the current *swagger-ui* and makes the following changes: 
1. The addition of one paragraph at the top of the [README.md](README.md) document.
1. This *SILVERSTRIPE.md* document.
1. The *composer.json* file.
1. The */resources* folder and its contents.
1. The addition of *event.preventDefault()* to the *toggleOperationContent()* function in *swagger-ui.js*.

Govt.nz can merge new versions of the base *swagger-ui* repository by re-applying these changes.
 
This *govtnz/swagger-ui* package was intended as a companion to [govtnz/silverstripe-api](https://github.com/govtnz/silverstripe-api), but can be used on its own.

### Why fork the original repository?
*Swagger* is the world's most popular API definition/documentation specification, but it's not Silverstripe friendly.
Building it requires Docker, Bower and Travis, none of which is integrated with a default Silverstripe deployment.
Without the tweak in [5] above, Silverstripe insists on invoking page links intended for Javascript execution.
Otherwise this fork intentionally leaves the raw Swagger code alone, and makes use of the pre-compiled distribution.

&nbsp;

&nbsp;
## Installation
1. Add [github.com/govtnz/swagger-ui](https://github.com/govtnz/swagger-ui) to your *composer.json* file and run **composer update**.
1. Ensure there is browser access to the required files inside */vendor/govtnz/swagger-ui/dist*. See **.htaccess rules** below.
1. Create a new page type and corresponding template that include the Swagger code in the */resources/code* and */resources/templates* subdirectories.
 
By default, */govtnz/swagger-ui* expects to find *swagger.json* definition files structured by version in the following location. 
This is where *govtnz/silverstripe-api* creates them, if you're using that package.
```
/assets
    |
    |--api
    |   |--v1
    |   |   |--swagger.json
    |   |
    |   |--v2
    |   |   |--swagger.json
    
    ... etc  
```
However, you can add a setting in a *config.yml* file to change the location if you need to store your *swagger.json* files elsewhere. 
Note that **data_dir** is the equivalent of **/assets/api** in the above structure.
```
Swagger:
  data_dir: '/our-api/swagger'
```
Once you've completed these steps and have one or more *swagger.json* files in the right location and structure, navigating to an instance of your new page type should display your API in *swagger-ui*.
You can copy the contents of */resources/data* to your specified Swagger **data_dir** to test this. 

&nbsp;

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
Modifying the Swagger UI CSS with either of the above approaches is a pre-requisite to modifying the default fonts. 
If you don't use the default fonts, remember to remove the */govtnz/swagger-ui/dist/fonts* element from the *.htaccess* file entry.

You'll find it helpful to check the examples in the */resources* subdirectory and read the **.htaccess rules** section below.

&nbsp;

&nbsp;
## Customise functionality
Swagger UI's functionality is entirely written in Javascript.
It should not be necessary to edit the core Swagger UI files in */dist/lib*.
However, you might want to change some of the top-level behaviours, for which the key files are:
* */resources/api-swagger.js*
* */dist/swagger-ui.js*

You can copy these files to another location and edit them.
Remember to 

1. update the *Requirements::* statements in your page controller to reflect the new location, and 
1. remove from the *.htaccess* file entry any elements which are no longer required.

&nbsp;

&nbsp;
## Resources for govtnz/swagger-ui
The */resources* subdirectory contains:

1. An example swagger-ui page controller in */resources/code/SwaggerPage.php*. You can copy the key sections from this into your own page controller.
1. Swagger samples in */resources/data* which can be copied in full to the appropriate location to test your Swagger instance.
1. The */resources/javascript/api-swagger.js* file which must be included in your page template.
1. Four *.scss* files in */resources/sass* which can be copied and included if your site uses SASS and you want to modify Swagger's appearance.
1. An example swagger-ui page template in */resources/templates/SwaggerPage.ss*. Copy the marked section into your own page template.

&nbsp;

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

&nbsp;

&nbsp;