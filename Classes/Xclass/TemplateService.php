<?php
namespace B13\Flight\Xclass;

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

/**
 * Ugly XCLASS to allow more than just "PAGE" as page renderers
 */
class TemplateService extends \TYPO3\CMS\Core\TypoScript\TemplateService
{

    /**
     * Generates the configuration array by replacing constants and parsing the whole thing.
     * Depends on $this->config and $this->constants to be set prior to this! (done by processTemplate/runThroughTemplates)
     *
     * @return void
     * @see \TYPO3\CMS\Core\TypoScript\Parser\TypoScriptParser, start()
     */
    public function generateConfig()
    {
        parent::generateConfig();
        unset($this->setup['types.']);
        if (!is_array($this->setup)) {
            return;
        }
        foreach ($this->setup as $key => $value) {
            if (is_string($value) && isset($GLOBALS['TYPO3_CONF_VARS']['FE']['PageGenerators'][$value])) {
                // Set the typeNum of the current page object:
                if (isset($this->setup[$key . '.']['typeNum'])) {
                    $typeNum = $this->setup[$key . '.']['typeNum'];
                    $this->setup['types.'][$typeNum] = $key;
                    $this->setup['types.'][$typeNum . '.'] = [
                        'key'                => $key,
                        'pageGenerationType' => $value,
                    ];
                } elseif (!isset($this->setup['types.'][0]) || !$this->setup['types.'][0]) {
                    $this->setup['types.'][0] = $key;
                    $this->setup['types.']['0' . '.'] = [
                        'key'                => $key,
                        'pageGenerationType' => $value,
                    ];
                }
            }
        }
    }
}