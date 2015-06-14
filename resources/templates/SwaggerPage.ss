<h1>$Title</h1>
<% if Summary %>
    <p class="page-description">$Summary</p>
<% end_if %>
$Content

<div class="swagger-section">
    <div id="swagger-header">
        <div class="swagger-ui-wrap">
            <h2>Explore our API with Swagger</h2>
            <form id='api_selector'>
                <input type="hidden" id="input_baseUrl" name="baseUrl"  />
                <input type="hidden" id="input_apiKey" name="apiKey" value="api_key" />
                <!-- value="http://diadev/assets/swaggertest.js"
                <div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text" /></div>
                <div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
                <div class='input'><a id="explore" href="#">Explore</a></div>
                -->
            </form>
        </div>
    </div>

    <div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
    <div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</div>
