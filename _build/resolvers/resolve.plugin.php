<?php

/** @var xPDOTransport $transport */
/** @var array $options */
if ($transport->xpdo) {
    /** @var modX $modx */
    $modx =& $transport->xpdo;
    /** @var miniShop2 $miniShop2 */
    if (!$miniShop2 = $modx->getService('miniShop2')) {
        $modx->log(modX::LOG_LEVEL_ERROR, '[msplColor] Could not load miniShop2');

        return false;
    }
    if (!property_exists($miniShop2, 'version') || version_compare($miniShop2->version, '2.4.0-beta2', '<')) {
        $modx->log(modX::LOG_LEVEL_ERROR,
            '[msplColor] You need to upgrade miniShop2 at least to version 2.4.2-beta2');

        return false;
    }

    $update = false;
    $manager = $modx->getManager();
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $miniShop2->addPlugin('msplColor', '{core_path}components/msplcolor/index.php');
            $miniShop2->loadMap();

            $manager->alterField('msProductData', 'color');
            $manager->addIndex('msProductData', 'color');
            $modx->removeCollection('msProductOption', array('key' => 'color'));
            $update = true;
            break;

        //case xPDOTransport::ACTION_UPGRADE:

        case xPDOTransport::ACTION_UNINSTALL:
            $miniShop2->removePlugin('msplColor');
            unset($modx->map['msProductData']);
            $modx->loadClass('msProductData', $miniShop2->config['modelPath'] . 'minishop2/');

            $manager->removeIndex('msProductData', 'color');
            $manager->alterField('msProductData', 'color');
            $update = true;
            break;
    }

    if ($update) {
        $c = $modx->newQuery('msProductData');
        $c->command('UPDATE');
        $c->set(array('color' => null));
        $c->prepare();
        $c->stmt->execute();
    }
}
return true;
