/**
 * @author Developers-Alliance team
 * @copyright Copyright (c) 2023 Developers-alliance (https://www.developers-alliance.com)
 * @package Shipping Table Rates for Magento 2
 */
define([
    'Magento_Ui/js/grid/editing/record'
], function (Record) {
    'use strict';

    /**
     * Extended Record component to register custom editorType
     * So that region would be filtered by country in case of inlineEditing
     */
    return Record.extend({
        defaults: {
            templates: {
                fields: {
                    region: {
                        component: 'DevAll_TableRates/js/form/element/region',
                        template: 'DevAll_TableRates/form/element/select',
                        options: '${ JSON.stringify($.$data.column.options) }'
                    }
                }
            },
        },
    });
});
