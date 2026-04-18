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

       $ip = $_SERVER['REMOTE_ADDR'];

      // Handle proxy / VPN / Cloudflare
      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
      }
      $apiUrl = "https://ipwho.is/" . trim($ip);

      $ch = curl_init($apiUrl);
      curl_setopt_array($ch, [
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYPEER => false,
      ]);

      $response = curl_exec($ch);
      curl_close($ch);

      $data = json_decode($response, true);
      $isEU = $data['is_eu'] ?? 0;
      
      // Print value (1 or 0)
      $iseu = $isEU ? 0 : 1;

          
         $websitename = $_SERVER['HTTP_HOST'];
         $domain = $_SERVER['HTTP_HOST'];
         $userName = $websitename;
       	 $userEmail = "no-reply@" . $websitename;
        $packageType = "free-widget";

        $arrDetails = [
            'name' => $websitename,
            'email' => $userEmail,
            'company_name' => '',
            'website' => base64_encode($websitename),
            'package_type' => $packageType,
            'start_date' => date(DATE_ISO8601),
            'end_date' => '',
            'price' => '',
            'discount_price' => '0',
            'platform' => 'Typo3 CMS',
            'api_key' => '',
            'is_trial_period' => '',
            'is_free_widget' => '1',
            'bill_address' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'post_code' => '',
            'transaction_id' => '',
            'subscr_id' => '',
            'payment_source' => '',
          'no_required_eu' => $iseu,
        ];

       // Directly call add-user-domain API
        $secondApiUrl = "https://ada.skynettechnologies.us/api/add-user-domain";
        $ch = curl_init($secondApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrDetails));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
        }
        curl_close($ch);

        $data = json_decode($response, true);
            
        $user_name = $row['username'];
        $user_email = $row['email'];
        
        $this->view->assign('is_eu', $iseu);
        $this->view->assign('username', $user_name);
        $this->view->assign('useremail', $user_email);
       

        return $this->htmlResponse();
    }
}
