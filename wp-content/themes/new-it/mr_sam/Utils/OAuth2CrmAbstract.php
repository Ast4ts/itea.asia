<?php

require_once(__DIR__.'/../Models/OAuthModel.php');
require_once('Response.php');


abstract class OAuth2CrmAbstract
{
    protected $apiType;
    protected $urlToken;
    protected $urlOrder;
    protected $urlCallbackOrder;
    protected $urlForResume;
//    protected $urlTildaForm;

    protected $apiId;
    protected $login;
    protected $password;
    protected $accessToken;
    protected $refreshToken;
    protected $accessLifetime;
    protected $refreshLifetime;

    /**
     * OAuth2CrmAbstract constructor.
     * @param string $apiType
     * @param string $urlToken
     * @param string $urlOrder
     * @param string $urlCallbackOrder
     * @param string $urlForResume
     * @throws Exception
     */
//    protected function __construct($apiType, $urlToken, $urlOrder, $urlCallbackOrder, $urlForResume, $urlTildaForm)
    protected function __construct($apiType, $urlToken, $urlOrder, $urlCallbackOrder, $urlForResume)
    {
        createOrUpdateOAuthTable();
        $stack = getOAuth($apiType);

        if (empty($stack)) {
            throw new Exception();
        } else {
            $this->apiType = $apiType;
            $this->urlToken = $urlToken;
            $this->urlOrder = $urlOrder;
            $this->urlCallbackOrder = $urlCallbackOrder;
            $this->urlForResume = $urlForResume;
//            $this->urlTildaForm = $urlTildaForm;

            $this->apiId = $stack->id;
            $this->login = $stack->login;
            $this->password = $stack->password;
            $this->accessToken = $stack->access_token;
            $this->refreshToken = $stack->refresh_token;
            $this->accessLifetime = $stack->access_lifetime;
            $this->refreshLifetime = $stack->refresh_lifetime;
        }
    }

    /**
     * @return bool
     */
    abstract protected function getAccesses();

    /**
     * @return bool
     */
    final protected function checkAccesses()
    {
        $connectionStatus = true;

        if (empty($this->accessToken) || $this->accessLifetime < time() + 5) {
            $connectionStatus = $this->getAccesses();
        }

        return $connectionStatus;
    }

    /**
     * @param array $params
     * @return Response
     */
    final public function sendOrder($params)
    {
        try {
            $result = '';
            $responseCode = 0;

            $this->checkAccesses();

            for ($shot = 0; $shot < 2; $shot++) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->urlOrder);
                // curl_setopt($ch, CURLINFO_HEADER_OUT, true); //enable headers
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    [
                        "Authorization: Bearer {$this->accessToken}",
                        'X-DEPARTMENT: af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
                    ]
                );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE

//            @todo Should be uncommented for debug error
//                $error = curl_errno($ch);
//                error_log(
//                    'NOTICE Send Proposal pull to '.$this->urlOrder.' (in '.__FILE__.' on '.__LINE__.' line): CURL result: '.(is_array($result) ? json_encode(
//                        $result
//                    ) : $result).'; response code is '.$responseCode.'; error - '.(is_array($error) ? json_encode(
//                        $error
//                    ) : $error).'. ',
//                    0
//                );

                curl_close($ch);

                if ($responseCode == 401) {
                    $this->getAccesses();
                } else {
                    break;
                }
            }

            //session_worm
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;".($_SESSION['worm_counter']++).") -> IN method <b>sendOrder()</b> of <i>OAuth2CrmAbstract.php</i>
<small style='color:orange;'>&#9;&#9;{
&#9;&#9;&nbsp;<b>responseCode</b>=$responseCode;
&#9;&#9;&nbsp;<b>result</b>=$result;
&#9;&#9;&nbsp;<b>apiType</b>=$this->apiType;
&#9;&#9;&nbsp;<b>urlToken</b>=$this->urlToken;
&#9;&#9;&nbsp;<b>urlOrder</b>=$this->urlOrder;
&#9;&#9;&nbsp;<b>apiId</b>=$this->apiId;
&#9;&#9;&nbsp;<b>login</b>=$this->login;
&#9;&#9;&nbsp;<b>accessToken</b>=$this->accessToken;
&#9;&#9;&nbsp;<b>refreshToken</b>=$this->refreshToken;
&#9;&#9;&nbsp;<b>accessLifetime</b>=$this->accessLifetime;
&#9;&#9;}</small>";

            return new Response($responseCode, $result);
        } catch (Exception $e) {
            error_log($e->getMessage().' ('.$e->getCode().'); ', 0);
        }
    }

    /**
     * @param array $params
     * @return Response
     */

    final public function sendResume($params)
    {
        try {
            $result = '';
            $responseCode = 0;

            $this->checkAccesses();

            for ($shot = 0; $shot < 2; $shot++) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $this->urlForResume);

                // curl_setopt($ch, CURLINFO_HEADER_OUT, true); //enable headers
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                    [
                        "Authorization: Bearer {$this->accessToken}",
                        'X-DEPARTMENT: af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
                    ]
                );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE
                curl_close($ch);

                if ($responseCode == 401) {

                    $this->getAccesses();
                } else {
                    break;
                }
            }
            return new Response($responseCode, $result);
        } catch (Exception $e) {
            error_log($e->getMessage().' ('.$e->getCode().'); ', 0);
        }
    }

    /**
     * @param array $params
     * @return Response
     */
    final public function sendCallbackOrder($params)
    {
        $result = '';
        $responseCode = 0;

        $this->checkAccesses();

        for ($shot = 0; $shot < 2; $shot++) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->urlCallbackOrder);
            // curl_setopt($ch, CURLINFO_HEADER_OUT, true); //enable headers
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                [
                    "Authorization: Bearer {$this->accessToken}",
                    'X-DEPARTMENT: af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
                ]
            );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE

//            @todo Should be uncommented for debug error
//            $error = curl_errno($ch);
//            error_log(
//                'NOTICE Send Callback to '.$this->urlCallbackOrder.' (in '.__FILE__.' on '.__LINE__.' line): CURL result: '.(is_array($result) ? json_encode(
//                    $result
//                ) : $result).'; response code is '.$responseCode.'; error - '.(is_array($error) ? json_encode(
//                    $error
//                ) : $error).'. ',
//                0
//            );

            curl_close($ch);

            if ($responseCode == 401) {
                $this->getAccesses();
            } else {
                break;
            }
        }

        return new Response($responseCode, $result);
    }

    /**
     * @param array $params
     * @return Response
     */
    final public function sendTildaFormToCrmSymfony($params, $city)
    {
        $result = '';
        $responseCode = 0;
        if ($city['city'] == 'kharkiv') {
            $this->urlToken = 'https://api.itea.ua/oauth/v2/token';
            $this->urlOrder = 'https://api.itea.ua/api/v1/proposal-pull/';
        }
        $this->checkAccesses();

        for ($shot = 0; $shot < 2; $shot++) {

            $ch = curl_init();

            // curl_setopt($ch, CURLINFO_HEADER_OUT, true); //enable headers
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_URL, $this->urlOrder);
            if ($city['city'] == 'kharkiv') {
              curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                [
                  "Authorization: Bearer {$this->accessToken}",
                  'X-DEPARTMENT: 16a73b83-6315-45b2-ac25-031ff5a83652',
                ]
              );
            } elseif ($city['city'] == 'online') {
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    [
                        "Authorization: Bearer {$this->accessToken}",
//                        'X-DEPARTMENT: 12d5057d-eb71-49c8-8065-a6ae95f0958f',
                        'X-DEPARTMENT: af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
                    ]
                );
            } else {
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    [
                        "Authorization: Bearer {$this->accessToken}",
                        'X-DEPARTMENT: af9f1d8e-9e89-4b28-a1b4-c04444cf2693',
                    ]
                );
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE

//            @todo Should be uncommented for debug error
//            $error = curl_errno($ch);
//            error_log(
//                'NOTICE Send Callback to '.$this->urlCallbackOrder.' (in '.__FILE__.' on '.__LINE__.' line): CURL result: '.(is_array($result) ? json_encode(
//                    $result
//                ) : $result).'; response code is '.$responseCode.'; error - '.(is_array($error) ? json_encode(
//                    $error
//                ) : $error).'. ',
//                0
//            );

            curl_close($ch);

            if ($responseCode == 401) {
                $this->getAccesses();
            } else {
                break;
            }
        }

        return new Response($responseCode, $result);
    }
}
