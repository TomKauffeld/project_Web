<?php
class RSA{
    /**
     * @return resource Returns a positive key resource identifier on success, or FALSE on error.
     */
  private static function getPrivateKey( ){
    $privateKey =
"-----BEGIN RSA PRIVATE KEY-----

-----END RSA PRIVATE KEY-----
";
    $key = openssl_pkey_get_private( $privateKey, "");
      return $key;
  }
  
  /**
   * @return resource Returns a positive key resource identifier on success, or FALSE on error.
   */
  public static function getPublicKey( ){
    $publicKey = 
"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArmlEQuy4P6CLYKQZuKRD
Pf14k+izpV7/czhIZaXR4MjNWkfDpZK+3u9S7LIudY56ieCbe3Vrqlhi62rVyzyW
SoAhPAdamgRWE/eWkIZeAwqOl8OrR6gAlk1i5jK0pygRJ4OvyvgaGMEQOZZFTC6x
dnfahNLiq32Sc5Y2fL6DIaVpkpaj39TGLRiY8mUCSmkG3Mp30ky39Hd+h1cTU7O5
NPhqr/NEdrnaDiSDQKEcnkH8cXwRzM74zplMDO/sdb+QrlJsDRnDQ/5xuzQH9FAG
07JcO8Ts9jpP6pnsOGb69uI/jisOjYyTjnRPiWwynG45dLxGgBGWcgXmWGajjtNi
nwIDAQAB
-----END PUBLIC KEY-----
";
    $key = openssl_pkey_get_public( $publicKey);
      return $key;
  }

// given the variables as constants:

  //Block size for encryption block cipher
  private static $ENCRYPT_BLOCK_SIZE = 200;// this for 2048 bit key for example, leaving some room

  //Block size for decryption block cipher
  private static $DECRYPT_BLOCK_SIZE = 256;// this again for 2048 bit key

         //For encryption we would use:
  public static function encrypt($plainData, $privatePEMKey = null)
  {
    if ($privatePEMKey == null){
      $privatePEMKey = RSA::getPrivateKey();
    }
    $encrypted = '';
    $plainData = str_split($plainData, RSA::$ENCRYPT_BLOCK_SIZE);
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
  public static function decrypt($data, $publicPEMKey = null)
  {
    if ($publicPEMKey == null){
      $publicPEMKey = RSA::getPrivateKey();
    }
    $decrypted = '';

    //decode must be done before spliting for getting the binary String
    $data = str_split(base64_decode($data), RSA::$DECRYPT_BLOCK_SIZE);

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