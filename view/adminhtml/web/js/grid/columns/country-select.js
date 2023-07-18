/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */
define([
    'Magento_Ui/js/grid/columns/select',
    'escaper'
], function (Select, escaper) {
    'use strict';

    /**
     * Extended component of grid's select type column
     * Adds Method for retrieving flag icon url in the view.
     */
    return Select.extend({
        defaults: {
            flagImagePath: 'DevAll_TableRates/css/images/country-flags/'
        },

        /**
         * Get Flag icon url for the grid record
         *
         * @param {Object} record - data from the grid row.
         * @returns {String}
         */
        getFlagUrl: function (record) {
            let flagFileName = record.dest_country_id.toLowerCase() + '.png';
            let flagImageUrl = require.toUrl(this.flagImagePath + flagFileName);

            return escaper.escapeHtml(flagImageUrl);
        }
    });
});
