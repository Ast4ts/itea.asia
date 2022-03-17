<?php

require_once(__DIR__ . '/../Utils/OAuth2CrmAbstract.php');


class OAuth2CrmAspNetService extends OAuth2CrmAbstract
{
    /**
     * OAuth2CrmAspNetService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $apiType  = 'crm_asp_net';
        $urlToken = 'https://crme.itea.ua/Token';
        $urlOrder = 'https://crme.itea.ua/api/Requests';
        $urlCallbackOrder = '';
        $urlForResume = '';

        parent::__construct($apiType, $urlToken, $urlOrder, $urlCallbackOrder, $urlForResume);
    }

    /**
     * @return bool
     */
    protected function getAccesses()
    {
        $params = [
            'email'      => 'info@itea.ua',
            'grant_type' => 'password',
            'userName'   => $this->login,
            'password'   => $this->password,
            'confirmPassword' => $this->password,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlToken);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // CURLINFO_HTTP_CODE or CURLINFO_RESPONSE_CODE
        curl_close($ch);

        if ($status == 200)
        {
            $result = json_decode($result);

            $this->accessToken  = $result->access_token;
            $this->refreshToken = NULL;
            $this->accessLifetime  = time() + $result->expires_in;

            updateOAuth(
                $this->apiId,
                $this->accessToken,
                $this->accessLifetime,
                $this->refreshToken
            );
        }

        return $status == 200;
    }
}
