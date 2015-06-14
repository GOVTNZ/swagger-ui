# Resources for govtnz/swagger-ui

&nbsp;
## .htaccess rules
If your existing .htaccess rules restrict HTTP access to the */vendor* directory, you'll need to set up exceptions for the files required by *govtnz/swagger-ui*.
The essential files are:
* */dist/swagger-ui.js* (or */dist/swagger-ui.min.js*)
* The contents of */dist/lib*
* The contents of */dist/images* 

If you intend to use the default Swagger CSS and fonts, you'll also need to expose:
* The contents of */dist/css*
* The contents of */dist/fonts*

Here's an .htaccess rule that returns a 404 for all */vendor* files except the above five exceptions.
You can modify this to reflect your own Swagger integration.

```
RedirectMatch 404 /vendor(?!/govtnz/swagger-ui/dist/css|/govtnz/swagger-ui/dist/fonts|/govtnz/swagger-ui/dist/images|/govtnz/swagger-ui/dist/lib|/govtnz/swagger-ui/dist/swagger-ui\.js)
``` 

Alternatively you could use a combination of *RewriteCond* and *RewriteRule*.

### Why do this?
It's good practice to prevent HTTP access to any file that doesn't need to be directly consumed by browsers.
This prevents security holes in this code being exploited by hackers, or the existence of certain packages offering clues to how your site can be compromised.
Typically the */vendors* directory contains code used by Silverstripe itself or by other packages within your Silverstripe installation, and doesn't need to be publicly exposed.

Each installation is different, however. The above .htaccess rule was good for our Silverstripe instance; your requirements may differ.