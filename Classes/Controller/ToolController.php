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
        //Eu Logic Start
        // EU script value fetch




    // ---------- FIRST API (ipapi) ----------
    $apiUrl1 = "https://ipapi.co/json/";

    $ch = curl_init($apiUrl1);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 5,
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

    // Check if valid response
    if ($httpCode === 200 && !empty($data) && isset($data['in_eu'])) {
        $isEU = $data['in_eu'] ? 1 : 0;
        
    } else {

        // ---------- SECOND API (ipwho) ----------
        $ip = $_SERVER['REMOTE_ADDR'];

        // Handle proxy / VPN / Cloudflare
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        }

        $apiUrl2 = "https://ipwho.is/" . trim($ip);

        $ch = curl_init($apiUrl2);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 5,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!empty($data) && isset($data['is_eu'])) {
            $isEU = $data['is_eu'] ? 1 : 0;
        } else {
            // Default fallback (if both APIs fail)
            $isEU = 0;
        }
    }

    // Your final logic
    $iseu = $isEU ? 0 : 1;



        //End Eu logic
        // Assign variables to the view
        $this->view->assignMultiple([
            'action' => 'chatSettings',
            'constant' => $this->constants,
            'username' => $user_name,
            'useremail' => $user_email,
            'domain' => $domain,
            'is_eu' => $iseu,
        ]);
    
        return $this->htmlResponse();
    }
}
