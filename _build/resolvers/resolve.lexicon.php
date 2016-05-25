<?php
/** @var xPDOTransport $transport */
/** @var array $options */
if ($transport->xpdo) {
    /** @var modX $modx */
    $modx =& $transport->xpdo;

    $entries = array(
        'ru' => array(
            'ms2_product_color' => 'Цвет',
            'ms2_product_color_help' => 'Цвет товара',
        ),
        'en' => array(
            'ms2_product_color' => 'Color',
            'ms2_product_color_help' => 'Color of a product',
        ),
    );

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            foreach ($entries as $lang => $values) {
                foreach ($values as $key => $value) {
                    if (!$modx->getCount('modLexiconEntry', array('name' => $key, 'language' => $lang))) {
                        /** @var modLexiconEntry $entry */
                        $entry = $modx->newObject('modLexiconEntry', array(
                            'name' => $key,
                            'topic' => 'product',
                            'namespace' => 'minishop2',
                            'language' => $lang,
                            'value' => $value,
                        ));
                        $entry->save();
                    }
                }
            }
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            foreach ($entries as $lang => $values) {
                foreach ($values as $key => $value) {
                    /** @var modLexiconEntry $entry */
                    $entry = $modx->getObject('modLexiconEntry', array(
                        'name' => $key,
                        'language' => $lang,
                        'value' => $value,
                    ));
                    if ($entry) {
                        $entry->remove();
                    }
                }
            }
            break;
    }
}
return true;