/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */
define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select'
], function (_, registry, Select) {
    'use strict';

    /**
     * Extended default select component
     * to filter out region by selected countries
     */
    return Select.extend({
        defaults: {
            imports: {
                selectedCountry: '${ $.parentName }.dest_country_id:value'
            }
        },

        /**
         * {@inheritdoc}
         */
        initialize: function () {
            this._super().observe(
                'selectedCountry'
            );
            // //initial filter for selected country
            this.options(this.initialOptions.filter(option => option.country_id === this.selectedCountry()));
            this.initSubscribers();
            return this;
        },

        /**
         * Update region list each time country is changed
         */
        initSubscribers: function () {
            var self = this;
            self.selectedCountry.subscribe(
                function (selectedCountry) {
                    self.options(self.initialOptions.filter(option => option.country_id === selectedCountry));
                }
            );
        }
    });
});
