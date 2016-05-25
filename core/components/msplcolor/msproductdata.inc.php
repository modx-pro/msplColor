<?php

return array(
    'fields' => array(
        'color' => null,
    ),
    'fieldMeta' => array(
        'color' => array(
            'dbtype' => 'varchar',
            'precision' => '255',
            'phptype' => 'string',
            'null' => true,
            'default' => null,
        ),
    ),
    'indexes' => array(
        'color' => array(
            'alias' => 'color',
            'primary' => false,
            'unique' => false,
            'type' => 'BTREE',
            'columns' => array(
                'color' => array(
                    'length' => '',
                    'collation' => 'A',
                    'null' => false,
                ),
            ),
        ),
    ),
);