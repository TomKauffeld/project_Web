<?php
class RSA{
    /**
     * @return resource Returns a positive key resource identifier on success, or FALSE on error.
     */
  private static function getPrivateKey( ){
    $privateKey =
    "-----BEGIN RSA PRIVATE KEY-----
    
    -----END RSA PRIVATE KEY-----";
      return openssl_pkey_get_private( $privateKey, "");
  }
  
  /**
   * @return resource Returns a positive key resource identifier on success, or FALSE on error.
   */
  public static function getPublicKey( ){
      return openssl_pkey_get_public( "file:public.pem");
  }

// given the variables as constants:

  //Block size for encryption block cipher
  private $ENCRYPT_BLOCK_SIZE = 200;// this for 2048 bit key for example, leaving some room

  //Block size for decryption block cipher
  private $DECRYPT_BLOCK_SIZE = 256;// this again for 2048 bit key

         //For encryption we would use:
  function encrypt($plainData, $privatePEMKey = null)
  {
    if ($privatePEMKey == null){
      $privatePEMKey = RSA::getPrivateKey();
    }
    $encrypted = '';
    $plainData = str_split($plainData, $this->ENCRYPT_BLOCK_SIZE);
    foreach($plainData as $chunk)
    {
      $partialEncrypted = '';

      //using for example OPENSSL_PKCS1_PADDING as padding
      $encryptionOk = openssl_private_encrypt($chunk, $partialEncrypted, $privatePEMKey, OPENSSL_PKCS1_PADDING);

      if($encryptionOk === false){return false;}//also you can return and error. If too big this will be false
      $encrypted .= $partialEncrypted;
    }
    return base64_encode($encrypted);//encoding the whole binary String as MIME base 64
  }

         //For decryption we would use:
  protected function decrypt($data, $publicPEMKey = null)
  {
    if ($publicPEMKey == null){
      $publicPEMKey = RSA::getPrivateKey();
    }
    $decrypted = '';

    //decode must be done before spliting for getting the binary String
    $data = str_split(base64_decode($data), $this->DECRYPT_BLOCK_SIZE);

    foreach($data as $chunk)
    {
      $partial = '';

      //be sure to match padding
      $decryptionOK = openssl_public_decrypt($chunk, $partial, $publicPEMKey, OPENSSL_PKCS1_PADDING);

      if($decryptionOK === false){return false;}//here also processed errors in decryption. If too big this will be false
      $decrypted .= $partial;
    }
    return $decrypted;
  }
}
?>