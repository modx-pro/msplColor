miniShop2.plugin.color = {
    getFields: function () {
        return {
            color: {
                xtype: 'minishop2-combo-autocomplete',
                description: '<b>[[+color]]</b><br />' + _('ms2_product_color_help')
            }
        }
    },
    getColumns: function () {
        return {
            color: {
                width: 50,
                sortable: false,
                editor: {
                    xtype: 'minishop2-combo-autocomplete',
                    name: 'color'
                }
            }
        }
    }
};