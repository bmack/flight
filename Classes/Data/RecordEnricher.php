<?php
namespace BMack\Flight\Data;

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

use B13\Flight\PageGenerator\PageGeneratorInterface;
use TYPO3\CMS\Backend\FrontendBackendUserAuthentication;
use TYPO3\CMS\Core\Error\Http\ServiceUnavailableException;
use TYPO3\CMS\Core\FrontendEditing\FrontendEditingController;
use TYPO3\CMS\Core\Http\RequestHandlerInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\View\AdminPanelView;

/**
 *
 * TODO
 *
 *
 * TCA logic:
 *
 * Takes a record (tablename + full row)
 * and sees if the record can be enriched with prepared data
 *
 * - Getting the label of a flat <select>
 * - Replacing the t3:// links with real final links
 * - Resolves images (sys_file_reference)
 *
 * Future:
 * - Resolves other inline child records
 */
class RecordEnricher
{

    public function enrichRecord(string $table, array $row): array
    {
        if (!is_array($GLOBALS['TCA'][$table])) {
            throw new \InvalidArgumentException('The selected table ' . $table . ' is not defined in TCA', 1508524678);
        }
        $enrichedRow = $row;
        foreach ($GLOBALS['TCA'][$table]['columns'] as $columnName => $columnDetails) {
            if (!isset($enrichedRow[$columnName])) {
                continue;
            }
            $enrichedRow[$columnName] = $this->enrichField($columnName, $enrichedRow[$columnName], $columnDetails['config']);
        }
    }

    protected function enrichField(string $fieldName, $fieldValue, array $configuration)
    {
        switch ($configuration['type']) {
            case 'inline':

            case 'select':

            case 'group':

            default:
                // go on the renderType
        }
        return $fieldValue;
    }
}