<?php
namespace Skynettechnologies\Allinoneaccessibility\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Core\Environment;

class AwesomeMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
            $response = $handler->handle($request);

                /* -------------------------------------------
                GET DOMAIN & CALL ADA API
                ----------------------------------------------*/
                $domain =  $_SERVER['HTTP_HOST'] ?? '';
                
                $domain_base64 = base64_encode($domain);

                $apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";
                $postData = ['website_url' => $domain];

                $ch = curl_init($apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $responseApi = curl_exec($ch);
                curl_close($ch);

                $apiResponse = json_decode($responseApi, true);

                // 0 = load EU script | 1 = load normal AIO script
                $no_required_eu = $apiResponse['Data']['no_required_eu'] ?? '1';

                /* -------------------------------------------
                BUILD SCRIPT BASED ON EU FLAG
                ----------------------------------------------*/

                $debugScript = "
                <script>
                    console.log('ADA Full API Response:', " . json_encode($apiResponse) . ");
                    console.log('ADA no_required_eu:', '{$no_required_eu}');
                </script>
                ";
                $color      = !empty($color) ? $color : '#420083';
                $position   = !empty($position) ? $position : 'bottom_right';
                $icon_type  = !empty($icon_type) ? $icon_type : 'aioa-icon-type-1';
                $icon_size  = !empty($icon_size) ? $icon_size : 'aioa-small-icon';
                $licensekey = !empty($licensekey) ? $licensekey : '';
                if ($no_required_eu == '0') {

                    // EU SCRIPT (with delay)
                    $widgetScript = "
                    <script>
                        setTimeout(function () {
                            let aioa_script = document.createElement('script');
                            aioa_script.id = 'aioa-adawidget';
                            aioa_script.src = 'https://eu.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode={$color}&token={$licensekey}&position={$position}';
                            aioa_script.defer = true;
                            document.body.appendChild(aioa_script);
                        }, 3000);
                    </script>
                    ";

                } else {

                    // NORMAL AIO SCRIPT
                    $widgetScript = "
                    <script id='aioa-adawidget'
                        src='https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode={$color}&token={$licensekey}&position={$position}.{$icon_type}.{$icon_size}'
                        async='true'>
                    </script>
                    ";
                }

                /* -------------------------------------------
                INJECT SCRIPT BEFORE </body>
                ----------------------------------------------*/

                $html = $response->getBody();
                $html = str_replace(
                    "</body>",
                    $debugScript . $widgetScript . "</body>",
                    $html
                );

                $body = new Stream('php://temp', 'wb+');
                $body->write($html);

                $response = $response->withBody($body);

                return $response;

    }
}
