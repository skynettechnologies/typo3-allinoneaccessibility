<?php
namespace Skynettechnologies\Allinoneaccessibility\Controller;

use Skynettechnologies\Allinoneaccessibility\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
use Skynettechnologies\Allinoneaccessibility\Controller\ConstantClass;
/***
 *
 * This file is part of the "All in one Accessibility" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020
 *
 ***/

/**
 * ToolController
 */
class ToolController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * toolstyleRepository
     *
     * @var \Skynettechnologies\Allinoneaccessibility\Domain\Repository\ToolRepository
     */
    protected $toolstyleRepository = null;

    public function __construct(
        \Skynettechnologies\Allinoneaccessibility\Domain\Repository\ToolstyleRepository $toolstyleRepository
    ) {
        $this->toolstyleRepository = $toolstyleRepository;
    }

    protected $constantObj;

    protected $constants;

    /**
     * @var TypoScriptTemplateModuleController
     */
    protected $pObj;

    protected $contentObject = null;

    protected $pid = null;

    /**
     * Initializes this object
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->contentObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
       
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction(): void
{
    
    // Ensure that $this->constantObj is initialized before calling any methods on it
    if ($this->constantObj === null) {
        // Instantiate the ConstantClass object
        $this->constantObj = GeneralUtility::makeInstance(\Skynettechnologies\Allinoneaccessibility\Controller\ConstantClass::class);
    }

    // Now call the init method on the initialized object
    $this->constantObj->init($this->pObj);

    // Get the constants from the main method
    $this->constants = $this->constantObj->main();
}

    /**
     * action list
     *
     * @return ResponseInterface
     */
    public function mainAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

    /**
     * action chatSettingsAction
     *
     * @return ResponseInterface
     */
    public function chatSettingsAction(): ResponseInterface
    {
       
        $this->view->assign('action', 'chatSettings');
        $this->view->assign('constant', $this->constants);
        
        $host = GeneralUtility::locationHeaderUrl( '/' );
        $domain = parse_url($host, PHP_URL_HOST);
        
        // Query 'be_users' table
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');
        $result = $queryBuilder
            ->select('*')
            ->from('be_users')
            ->executeQuery()
            ->fetchAllAssociative();
    
        $user_name = $result[0]['username'] ?? '';
        $user_email = $result[0]['email'] ?? '';
    
        // Assign variables to the view
        $this->view->assignMultiple([
            'action' => 'chatSettings',
            'constant' => $this->constants,
            'username' => $user_name,
            'useremail' => $user_email,
            'domain' => $domain,
        ]);
    
        return $this->htmlResponse();
    }
}
