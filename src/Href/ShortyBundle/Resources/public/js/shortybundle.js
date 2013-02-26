/**
 * HRF.li - a simple Symfony App to shorten URLs
 *
 * @module hrf
 */

var HRF = {};

/**
 * Ad-hoc testing of the application logic
 *
 * @namespace   HRF
 * @class       helpers
 */

HRF.helpers = {

    /**
     * Parse JSON string into and object
     *
     * @method  handleJson
     * @param   {String}    json_object     The json object to parse
     * @return  {Object}                    Javascript object
     */
    handleJson: function(json_object) {

        return jQuery.parseJSON(json_object);

    },

    /**
     * Make the AJAX call
     *
     * @method  ajaxCall
     * @param   {String}    url          The URL to call to
     * @param   {String}    method       The Method to use
     * @param   {Object}    parameters   Optional parameters
     */
    ajaxCall: function(url, method, parameters) {

        jQuery.ajax({
            url: url,
            type: method,
            data: parameters,
            success: function(data) {
                console.log(DSAFPlatform.testStuff.handleJson(data));
            }
        });

    }

};

