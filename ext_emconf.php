<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "flight".
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title'            => 'Flight: Fluid for everything',
    'description'      => 'Provides a way to work with zero TypoScript and everything fluid-based.',
    'category'         => 'fe',
    'version'          => '0.1.0',
    'state'            => 'stable',
    'uploadfolder'     => false,
    'createDirs'       => '',
    'clearcacheonload' => true,
    'author'           => 'Benni Mack',
    'author_email'     => '',
    'author_company'   => '',
    'constraints'      =>
        [
            'depends'   =>
                [
                    'typo3' => '8.7.0-9.0.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests'  =>
                [
                ],
        ],
];

