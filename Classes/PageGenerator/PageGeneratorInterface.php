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
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

interface PageGeneratorInterface
{
    /**
     * Initializes the page generation
     *
     * @param ServerRequestInterface $request
     * @param TypoScriptFrontendController $controller
     */
    public function initialize(ServerRequestInterface $request, TypoScriptFrontendController $controller);

    /**
     * Produces the content which should be returned
     *
     * @param array $pageConfiguration should be an option
     * @return string
     */
    public function generate(array $pageConfiguration);
}