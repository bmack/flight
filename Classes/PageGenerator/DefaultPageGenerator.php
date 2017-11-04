<?php
namespace B13\Flight\PageGenerator;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Frontend\Page\PageGenerator;

/**
 * Wrapper for calling the core's PageGenerator as of TYPO3 v8
 */
class DefaultPageGenerator implements PageGeneratorInterface
{
    /**
     * @param ServerRequestInterface $request
     * @param TypoScriptFrontendController $controller
     * @return void
     */
    public function initialize(ServerRequestInterface $request, TypoScriptFrontendController $controller)
    {
    }

    /**
     * @param array $pageConfiguration
     * @return mixed
     */
    public function generate(array $pageConfiguration)
    {
        PageGenerator::renderContent();
        return $GLOBALS['TSFE']->content;
    }
}