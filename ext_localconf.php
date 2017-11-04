<?php
defined('TYPO3_MODE') or die();

// Register the default page generator as well
$GLOBALS['TYPO3_CONF_VARS']['FE']['PageGenerators']['PAGE'] = \B13\Flight\PageGenerator\DefaultPageGenerator::class;
$GLOBALS['TYPO3_CONF_VARS']['FE']['PageGenerators']['FLUIDPAGE'] = \B13\Flight\PageGenerator\FluidPageGenerator::class;

/**
 * Register XCLASS to allow other page generators in TypoScript, until the Core supports this flexibility
 */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Core\TypoScript\TemplateService::class] = [
    'className' => \B13\Flight\Xclass\TemplateService::class
];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Core\TypoScript\ExtendedTemplateService::class] = [
    'className' => \B13\Flight\Xclass\ExtendedTemplateService::class
];

if (TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_FE) {
    \TYPO3\CMS\Core\Core\Bootstrap::getInstance()->registerRequestHandlerImplementation(\B13\Flight\Http\RequestHandler::class);
}