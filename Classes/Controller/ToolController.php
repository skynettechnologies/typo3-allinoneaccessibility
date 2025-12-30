<?php
namespace Skynettechnologies\Allinoneaccessibility\Controller;

use Skynettechnologies\Allinoneaccessibility\AdaConstantModule\TypoScriptTemplateConstantEditorModuleFunctionController;
use Skynettechnologies\Allinoneaccessibility\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Tstemplate\Controller\TypoScriptTemplateModuleController;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
        $this->constantObj = GeneralUtility::makeInstance(TypoScriptTemplateConstantEditorModuleFunctionController::class);
    }

    /**
     * Initialize Action
     *
     * @return void
     */
    public function initializeAction()
    {

        //GET CONSTANTs
        $this->constantObj->init($this->pObj);
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');

        $query = $queryBuilder
            ->select('*')
            ->from('be_users');

        $result = $query->execute()->fetchAll();
        foreach($result as $row){
        
        }


        $this->view->assign('action', 'chatSettings');
        $this->view->assign('constant', $this->constants);
        // EU script value fetch

        session_start();

        /* -------------------------------------------
        GET VISITOR DATA (SESSION LIKE JS)
        ----------------------------------------------*/

        if (!empty($_SESSION['visitor_data'])) {

            // Fetch from session
            $visitorData = $_SESSION['visitor_data'];
            error_log('[AIOA] Visitor data fetched from SESSION');

        } else {

            error_log('[AIOA] Visitor data NOT found in session. Calling ipapi.');

            $apiUrl = "https://ipapi.co/json/";

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $response) {

                $data = json_decode($response, true);

                $visitorData = [
                    'country_code' => $data['country_code'] ?? 'Unknown',
                    'in_eu'        => $data['in_eu'] ?? false
                ];

            } else {

                // Fallback
                $visitorData = [
                    'country_code' => 'Unknown',
                    'in_eu'        => false
                ];
            }

            // Save to session
            $_SESSION['visitor_data'] = $visitorData;
        }

        /* -------------------------------------------
        EU LOGIC (ONLY VALUE YOU NEED)
        ----------------------------------------------*/

        $inEU = $visitorData['in_eu'] ?? false;

        /**
         * SAME AS JS:
         * in_eu = true  → is_eu = 0
         * in_eu = false → is_eu = 1
         */
        $is_eu = $inEU ? 0 : 1;
            
        $user_name = $row['username'];
        $user_email = $row['email'];
        
        $this->view->assign('is_eu', $is_eu);
        $this->view->assign('username', $user_name);
        $this->view->assign('useremail', $user_email);
       

        return $this->htmlResponse();
    }
}
