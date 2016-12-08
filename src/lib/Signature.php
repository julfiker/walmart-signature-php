<?php
namespace  Walmart\Lib;

use phpseclib\Crypt\RSA;

class Signature
{
    /**
     * @var string Consumer ID provided by Developer Portal
     */
    public $consumerId;

    /**
     * @var string keyVersion
     */
    public $keyVersion;

    /**
     * @var string timestamp
     */
    public $timeStamp;

    /**
     * @var string Base64 Encoded Private Key provided by Developer Portal
     */
    public $privateKey;

    /**
     * Create an instance and pass argument in when constructor call
     *
     * @param $consumerId
     * @param $timeStamp
     * @param $keyVersion
     * @param $privateKey
     */
    public function __construct($consumerId, $timeStamp, $keyVersion, $privateKey)
    {
        $this->consumerId = $consumerId;
        $this->timeStamp = $timeStamp;
        $this->keyVersion = $keyVersion;
        $this->privateKey = $privateKey;
    }

    public function generateSignature() {

        /**
         * Append values into string for signing
         */
        $message = $this->consumerId.'\n'.$this->timeStamp.'\n'.$this->keyVersion.'\n';

        /**
         * Get RSA object for signing
         */
        $rsa = new RSA();
        $decodedPrivateKey = $this->privateKey;
        $rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS8);
        $rsa->setPublicKeyFormat(RSA::PRIVATE_FORMAT_PKCS8);

        /**
         * Load private key
         */
        if($rsa->loadKey($decodedPrivateKey, RSA::PRIVATE_FORMAT_PKCS8)) {

            /**
             * Make sure we use SHA256 for signing
             */
            $rsa->setHash('sha256');
            $rsa->setSignatureMode(RSA::PRIVATE_FORMAT_PKCS8);
            $signed = $rsa->sign($message);
            /**
             * Return Base64 Encode generated signature
             */
            return base64_encode($signed);
        } else {
            throw new \Exception("Unable to load private key", 1446780146);
        }
    }
}