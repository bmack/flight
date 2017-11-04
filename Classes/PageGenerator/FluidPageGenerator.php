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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3\CMS\Frontend\Page\PageGenerator;

/**
 * Implements FLUIDPAGE object that automatically loads configuration
 *
 */
class FluidPageGenerator implements PageGeneratorInterface
{
    /**
     * @var TypoScriptFrontendController
     */
    protected $controller;

    /**
     * @var StandaloneView
     */
    protected $view;

    /**
     * The TypoScript array
     * @var array
     */
    protected $pageConfiguration;

    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * Initializes the view etc
     *
     * @param ServerRequestInterface $request
     * @param TypoScriptFrontendController $controller
     * @return mixed|void
     */
    public function initialize(ServerRequestInterface $request, TypoScriptFrontendController $controller)
    {
        $this->request = $request;
        $this->controller = $controller;
        $this->view = GeneralUtility::makeInstance(StandaloneView::class);
    }

    /**
     * @param ViewInterface $view
     * @return void
     */
    public function initializeView(ViewInterface $view)
    {
        $view->getRenderingContext()->getTemplatePaths()->fillFromConfigurationArray(
            GeneralUtility::removeDotsFromTS($this->pageConfiguration['paths.'])
        );

        if (isset($this->pageConfiguration['format'])) {
            $view->setFormat($this->pageConfiguration['format']);
        }
        $view->getRenderingContext()->setControllerName('Pages');
        $view->assignMultiple([
            'request' => $this->request,
            'page' => $this->controller->page,
            'language' => $this->controller->sys_language_content,
            'locale' => $this->controller->sys_language_isocode,
            'settings' => GeneralUtility::removeDotsFromTS($this->controller->tmpl->setup_constants),
            'rootLine' => $this->controller->rootLine,
            'layout' => $this->controller->cObj->getData('pagelayout')
        ]);
    }

    /**
     * @param array $pageConfiguration
     * @return string
     */
    public function generate(array $pageConfiguration)
    {
        $template = $this->controller->cObj->getData('pagelayout');
        if (!empty($template)) {
            // backend layouts from DB table "backend_layouts"
            if (MathUtility::canBeInterpretedAsInteger($template)) {
                $template = 'Page' . $template;
            } else {
                if (stripos($template, 'pagets__') === 0) {
                    $template = substr($template, 8);
                }
                $template = GeneralUtility::underscoredToLowerCamelCase($template);
            }
        }
        $this->pageConfiguration = $pageConfiguration;
        $this->initializeView($this->view);

        // render <body> tag
        $pageContent = $this->view->render($template ? ucfirst($template) : 'Default');

        if ($this->controller->pSetup['stdWrap.']) {
            $pageContent = $this->controller->cObj->stdWrap($pageContent, $this->controller->pSetup['stdWrap.']);
        }
        // PAGE HEADER (after content - maybe JS is inserted!
        // if 'disableAllHeaderCode' is set, all the header-code is discarded!
        if ($this->controller->config['config']['disableAllHeaderCode']) {
            return $pageContent;
        } else {
            PageGenerator::renderContentWithHeader($pageContent);
            return $GLOBALS['TSFE']->content;
        }
    }

}