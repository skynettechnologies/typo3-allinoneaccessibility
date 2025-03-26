<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('allinoneaccessibility', 'Configuration/TypoScript', '[NITSAN] Tool');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_allinoneaccessibility_domain_model_tool', 'EXT:allinoneaccessibility/Resources/Private/Language/locallang_csh_tx_allinoneaccessibility_domain_model_whatsapp.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_allinoneaccessibility_domain_model_tool');
