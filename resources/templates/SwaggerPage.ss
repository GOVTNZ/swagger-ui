<div class="title">
    <h1>$Title</h1>
    <% if Summary %>
        <p class="page-description">$Summary</p>
    <% end_if %>
</div>

<div class="content">
    $Content

    <!-- ----------------------------------------------------------------------
    This is the section you must include in your page template ...
    ----------------------------------------------------------------------- -->

    <div class="swagger-section">
        <div id="swagger-header">
            <div class="swagger-ui-wrap">
                <h2>Explore our API with Swagger</h2>
                <form id='api_selector'>
                    <% if $APIVersions %>
                        <label for="api_version">API Version</label>
                        <select id="api_version">
                            <% loop $APIVersions %>
                                <option value="$Path" $Selected>$Name</option>
                            <% end_loop %>
                        </select>
                    <% end_if %>
                    <input type="hidden" id="api_data_dir" value="$APIDir" />
                    <input type="hidden" id="input_apiKey" name="apiKey" value="api_key" />
                </form>
            </div>
        </div>

        <div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
        <div id="swagger-ui-container" class="swagger-ui-wrap"></div>
    </div>

    <!-- ----------------------------------------------------------------------
    ... include ends
    ----------------------------------------------------------------------- -->


</div>
