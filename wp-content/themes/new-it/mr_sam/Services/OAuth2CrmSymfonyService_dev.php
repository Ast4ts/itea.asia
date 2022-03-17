<?php

require_once(__DIR__ . '/../Utils/OAuth2CrmAbstract.php');


class OAuth2CrmSymfonyService_dev extends OAuth2CrmAbstract
{
    /**
     * OAuth2CrmSymfonyService_dev constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $apiType  = 'crm_symfony_dev';
        $urlToken = 'http://api.itea-crm-test.demo.gns-it.com/oauth/v2/token';
        $urlOrder = 'http://api.itea-crm-test.demo.gns-it.com/api/v1/proposal-pull/';
        $urlCallbackOrder = 'http://api.itea-crm-test.demo.gns-it.com/api/v1/call-back/';
        $urlForResume = 'http://api.itea-crm-test.demo.gns-it.com/api/v1/contact/putItea/';

        parent::__construct($apiType, $urlToken, $urlOrder, $urlCallbackOrder, $urlForResume);
    }

    /**
     * @return bool
     */
    protected function getAccesses()
    {
        $status = 0;

        if (!empty($this->refreshToken)) {
            $params = [
                'client_id'     => '1_2y2i4fpadfi844gggogsg8coo00408c80kwos0gck40cc8kc84',
                'client_secret' => '51c915aa0n8k8cg0sscgw8cskksk4skc88k84oscksgccckock',
                'grant_type'    => 'refresh_token',
                'refresh_token' => $this->refreshToken,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->urlToken);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE
            curl_close($ch);

						//session_worm
						if(!isset($_SESSION)){
							session_start();
						}
						$_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;".($_SESSION['worm_counter']++).") -> IN method <b>getAccesses()</b> of <i>OAuth2CrmAbstract_dev.php</i> with condition: !empty(this->refreshToken) $status";
            if ($status == 200)
            {
							$result = json_decode($result);
							$_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;access_token = $result->access_token";
							$_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;refreshToken = $result->refreshToken";

                $this->accessToken  = $result->access_token;
                $this->refreshToken = $result->refresh_token;
                $this->accessLifetime  = time() + $result->expires_in;

                updateOAuth(
                    $this->apiId,
                    $this->accessToken,
                    $this->accessLifetime,
                    $this->refreshToken
                );
            }
        }


        if (empty($this->refreshToken) || $status != 200) {
            $params = [
                'client_id'     => '1_2y2i4fpadfi844gggogsg8coo00408c80kwos0gck40cc8kc84',
                'client_secret' => '51c915aa0n8k8cg0sscgw8cskksk4skc88k84oscksgccckock',
                'grant_type'    => 'password',
                'username'      => 'admin',//,$this->login
                'password'      => '123'//$this->password,'123'
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->urlToken);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE
            curl_close($ch);

					//session_worm
					if(!isset($_SESSION)){
						session_start();
					}
					$_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;".($_SESSION['worm_counter']++).") -> IN method <b>getAccesses()</b> of <i>OAuth2CrmAbstract_dev.php</i> with condition: empty(this->refreshToken) || status != '200' => $status";

            if ($status == 200)
            {
                $result = json_decode($result);
                $_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;access_token = $result->access_token";
							$_SESSION['session_worm'].="<br>&#9;&nbsp;&nbsp;refreshToken = $result->refreshToken";
                $this->accessToken  = $result->access_token;
                $this->refreshToken = $result->refresh_token;
                $this->accessLifetime  = time() + $result->expires_in;

                updateOAuth(
                    $this->apiId,
                    $this->accessToken,
                    $this->accessLifetime,
                    $this->refreshToken
                );
            }
        }

        return $status == 200;
    }
}
