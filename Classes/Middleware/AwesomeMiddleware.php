<?php
namespace Allinone\Allinoneaccessibility\Middleware;

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
        $domain = $_SERVER['HTTP_HOST'];
        $projectName = end(explode("/",(Environment::getProjectPath())));
        //$hash = sha1(sha1("typo3_viber_" . preg_replace("/www\.|https?:\/\/|\/$|\/?\?.+|\/.+|^\./", '', $domain)) . "_script");
        //$script = '<script type="text/javascript" src="https://smartarget.online/loader.js?u=' . $hash . '&source=typo3_viber"></script>';
        $url = 'http://localhost/typo3/api.php';
        $hash = sha1($projectName."typo3_accessibility_". preg_replace("/www\.|https?:\/\/|\/$|\/?\?.+|\/.+|^\./", '', $domain));
        $post_data = [
            'hash_val' => $hash,
        ];
        $options = array(
            'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($post_data),
            ),
          );
          $context  = stream_context_create($options);
          $result = file_get_contents($url, false, $context);
          $getData = json_decode($result, true);
        /* ---- All in One accessibility script */
        $script .= "<script id='aioa-adawidget' src='https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=".$getData['color']."&token=".$getData['licensekey']."&position=".$getData['position'].".".$getData['icon_type'].".".$getData['icon_size']."' async='true'></script>";
		$html = $response->getBody();
        $html = str_replace("</body>","$script</body>",$html);

        $body = new Stream('php://temp', 'wb+');

        $body->write($html);
        $response = $response->withBody($body);

        return $response;
    }
}
