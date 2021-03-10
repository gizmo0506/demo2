<?php

namespace App\Services;

use Sop\JWX\JWE\CompressionAlgorithm\DeflateAlgorithm;
use Sop\JWX\JWE\EncryptionAlgorithm\A256CBCHS512Algorithm;
use Sop\JWX\JWE\JWE;
use Sop\JWX\JWE\KeyAlgorithm\PBES2HS256A128KWAlgorithm;
use Sop\JWX\JWK\Symmetric\SymmetricKeyJWK;

class EncryptionService
{

    public function getEncrypted($data)
    {
        $payload = json_encode($data);
        $key = 'hbGciOiJBMTI4S1ciLCJlbmMiOiJBMTI';

        // PBES2-HS256+A128KW as a key management algorithm with default parameters
        $key_algo = PBES2HS256A128KWAlgorithm::fromPassword($key);
        // A256CBCHS512 as an encryption algorithm
        $enc_algo = new A256CBCHS512Algorithm();
        // DEF as a compression algorithm
        //$zip_algo = new DeflateAlgorithm();
        // encrypt payload to produce JWE
        $jwe = JWE::encrypt($payload, $key_algo, $enc_algo);
        // JWE's __toString magic method generates compact serialization
        //echo "{$jwe}\n";

        return "{$jwe}";

    }

    public function getDecrypted($data)
    {
        // create a JSON Web Key from password
        $jwk = SymmetricKeyJWK::fromKey('hbGciOiJBMTI4S1ciLCJlbmMiOiJBMTI');
        // read JWE token from the first argument
        $jwe = JWE::fromCompact($data);
        // decrypt the payload using a JSON Web Key
        $payload = $jwe->decryptWithJWK($jwk);
        //echo "{$payload}\n";

        return $payload;

    }
}