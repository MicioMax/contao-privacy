<?php

$GLOBALS['TL_DCA']['tl_privacy_protocol_archive'] = [
    'config'      => [
        'dataContainer'     => 'Table',
        'ctable'            => ['tl_privacy_protocol_entry'],
        'switchToEdit'      => true,
        'enableVersioning'  => true,
        'onload_callback'   => [
            ['HeimrichHannot\Privacy\Backend\ProtocolArchive', 'checkPermission'],
        ],
        'onsubmit_callback' => [
            ['HeimrichHannot\Haste\Dca\General', 'setDateAdded'],
        ],
        'sql'               => [
            'keys' => [
                'id' => 'primary'
            ]
        ]
    ],
    'list'        => [
        'label'             => [
            'fields' => ['title'],
            'format' => '%s'
        ],
        'sorting'           => [
            'mode'         => 1,
            'fields'       => ['title'],
            'headerFields' => ['title'],
            'panelLayout'  => 'filter;search,limit'
        ],
        'global_operations' => [
            'all' => [
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            ],
        ],
        'operations'        => [
            'edit'       => [
                'label' => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['edit'],
                'href'  => 'table=tl_privacy_protocol_entry',
                'icon'  => 'edit.gif'
            ],
            'editheader' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['editheader'],
                'href'            => 'act=edit',
                'icon'            => 'header.gif',
                'button_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolArchive', 'editHeader']
            ],
            'copy'       => [
                'label'           => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['copy'],
                'href'            => 'act=copy',
                'icon'            => 'copy.gif',
                'button_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolArchive', 'copyArchive']
            ],
            'delete'     => [
                'label'           => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['copy'],
                'href'            => 'act=delete',
                'icon'            => 'delete.gif',
                'attributes'      => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm']
                    . '\'))return false;Backend.getScrollOffset()"',
                'button_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolArchive', 'deleteArchive']
            ],
            'show'       => [
                'label' => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ],
        ]
    ],
    'palettes'    => [
        '__selector__' => [
            'addCodeProtocol',
            'addReferenceEntity',
            'addEntryTypeToReferenceFieldOnChange',
        ],
        'default'      => '{general_legend},title;{config_legend},personalFieldsExplanation,personalFields,titlePattern,skipIpAnonymization,addCodeProtocol,addReferenceEntity;'
    ],
    'subpalettes' => [
        'addCodeProtocol'           => 'codeFields',
        'addReferenceEntity' => 'referenceFieldTable,referenceFieldForeignKey,referenceFieldProtocolForeignKey,createInstanceOnChange,referenceTimestampField,addEntryTypeToReferenceFieldOnChange',
        'addEntryTypeToReferenceFieldOnChange' => 'referenceEntryTypeField'
    ],
    'fields'      => [
        'id'                               => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'                           => [
            'label' => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['tstamp'],
            'sql'   => "int(10) unsigned NOT NULL default '0'"
        ],
        'dateAdded'                        => [
            'label'   => &$GLOBALS['TL_LANG']['MSC']['dateAdded'],
            'sorting' => true,
            'flag'    => 6,
            'eval'    => ['rgxp' => 'datim', 'doNotCopy' => true],
            'sql'     => "int(10) unsigned NOT NULL default '0'"
        ],
        'title'                            => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['title'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''"
        ],
        'personalFieldsExplanation'        => [
            'inputType' => 'explanation',
            'eval'      => [
                'text'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['personalFieldsExplanation'], // this is a string, not an array
                'class'    => 'tl_info',
                'tl_class' => 'long'
            ]
        ],
        'personalFields'                   => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['personalFields'],
            'exclude'          => true,
            'inputType'        => 'checkbox',
            'options_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolEntry', 'getPersonalFieldsAsOptions'],
            'eval'             => ['multiple' => true, 'tl_class' => 'w50 clr'],
            'sql'              => "blob NULL",
        ],
        'titlePattern'                     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['titlePattern'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['maxlength' => 128, 'tl_class' => 'w50', 'mandatory' => true],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
        'skipIpAnonymization'              => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['skipIpAnonymization'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'addCodeProtocol'                  => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['addCodeProtocol'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50', 'submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'codeFields'                       => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['codeFields'],
            'exclude'          => true,
            'inputType'        => 'checkbox',
            'options_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolEntry', 'getCodeFieldsAsOptions'],
            'eval'             => ['multiple' => true, 'tl_class' => 'w50 clr', 'mandatory' => true],
            'sql'              => "blob NULL",
        ],
        'addReferenceEntity'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['addReferenceEntity'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50', 'submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'referenceFieldTable'              => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['referenceFieldTable'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => ['HeimrichHannot\Haste\Dca\General', 'getDataContainers'],
            'eval'             => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'submitOnChange' => true, 'chosen' => true],
            'sql'              => "varchar(64) NOT NULL default ''"
        ],
        'referenceEntryTypeField'                   => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['referenceEntryTypeField'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => function (\Contao\DataContainer $dc) {
                if (!($table = $dc->activeRecord->referenceFieldTable)) {
                    return [];
                }

                return \HeimrichHannot\Haste\Dca\General::getFields($table, false);
            },
            'eval'             => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "varchar(64) NOT NULL default ''"
        ],
        'referenceFieldProtocolForeignKey' => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['referenceFieldProtocolForeignKey'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => ['HeimrichHannot\Privacy\Backend\ProtocolEntry', 'getPersonalFieldsAsOptions'],
            'eval'             => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "varchar(64) NOT NULL default ''"
        ],
        'referenceFieldForeignKey'         => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['referenceFieldForeignKey'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => function (\Contao\DataContainer $dc) {
                if (!($table = $dc->activeRecord->referenceFieldTable)) {
                    return [];
                }

                return \HeimrichHannot\Haste\Dca\General::getFields($table, false);
            },
            'eval'             => ['tl_class' => 'w50 clr', 'mandatory' => true, 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "varchar(64) NOT NULL default ''"
        ],
        'createInstanceOnChange' => [
            'label'                   => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['createInstanceOnChange'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50'],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'addEntryTypeToReferenceFieldOnChange'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['addEntryTypeToReferenceFieldOnChange'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50', 'submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'referenceTimestampField'                   => [
            'label'            => &$GLOBALS['TL_LANG']['tl_privacy_protocol_archive']['referenceTimestampField'],
            'exclude'          => true,
            'filter'           => true,
            'inputType'        => 'select',
            'options_callback' => function (\Contao\DataContainer $dc) {
                if (!($table = $dc->activeRecord->referenceFieldTable)) {
                    return [];
                }

                return \HeimrichHannot\Haste\Dca\General::getFields($table, false);
            },
            'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true, 'chosen' => true],
            'sql'              => "varchar(64) NOT NULL default ''"
        ],
    ]
];