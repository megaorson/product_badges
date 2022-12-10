/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * @api
 */
define([
    'uiElement',
    'uiRegistry',
    'uiLayout',
    'mageUtils',
    'underscore'
], function (Element, registry, layout, utils, _) {
    'use strict';

    return Element.extend({
        defaults: {
            buttonClasses: {},
            additionalClasses: {},
            displayArea: 'outsideGroup',
            displayAsLink: false,
            elementTmpl: 'Megaorson_ProductBadges/form/element/button',
            template: 'ui/form/components/button/simple',
            visible: true,
            disabled: false,
            url: '',
            title: '',
            buttonTextId: '',
            ariLabelledby: ''
        },

        /**
         * Initializes component.
         *
         * @returns {Object} Chainable.
         */
        initialize: function () {
            return this._super()
                ._setClasses()
                ._setButtonClasses();
        },

        /** @inheritdoc */
        initObservable: function () {
            return this._super()
                .observe([
                    'visible',
                    'disabled',
                    'title',
                    'childError'
                ]);
        },

        /**
         * Performs configured actions
         */
        action: function () {
            location.href = this.url;
        },

        /**
         * Create target component from template
         *
         * @param {Object} targetName - name of component,
         * that supposed to be a template and need to be initialized
         */
        getFromTemplate: function (targetName) {
            var parentName = targetName.split('.'),
                index = parentName.pop(),
                child;

            parentName = parentName.join('.');
            child = utils.template({
                parent: parentName,
                name: index,
                nodeTemplate: targetName
            });
            layout([child]);
        },

        /**
         * Extends 'additionalClasses' object.
         *
         * @returns {Object} Chainable.
         */
        _setClasses: function () {
            if (typeof this.additionalClasses === 'string') {
                if (this.additionalClasses === '') {
                    this.additionalClasses = {};

                    return this;
                }

                this.additionalClasses = this.additionalClasses
                    .trim()
                    .split(' ')
                    .reduce(function (classes, name) {
                        classes[name] = true;

                        return classes;
                    }, {}
                );
            }

            return this;
        },

        /**
         * Extends 'buttonClasses' object.
         *
         * @returns {Object} Chainable.
         */
        _setButtonClasses: function () {
            var additional = this.buttonClasses;

            if (_.isString(additional)) {
                this.buttonClasses = {};

                if (additional.trim().length) {
                    additional = additional.trim().split(' ');

                    additional.forEach(function (name) {
                        if (name.length) {
                            this.buttonClasses[name] = true;
                        }
                    }, this);
                }
            }

            _.extend(this.buttonClasses, {
                'action-basic': !this.displayAsLink,
                'action-additional': this.displayAsLink
            });

            return this;
        }
    });
});
