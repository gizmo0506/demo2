<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EncryptionService;
use App\Models\Employee;
use Response;



class JwtController extends Controller
{
    private $encryptionService;

    public function __construct(EncryptionService $encryptionService)
    {
        $this->encryptionService = $encryptionService;
    }

    public function encrypt()
    {
        $results = Employee::find(5);

        $data = [
            'name' => $results['name'],
            'email' => $results['email'],
            'phone' => $results['phone'],
            'dob' => $results['dob'],
        ];

        dd($this->encryptionService->getEncrypted($data));
    }

    public function decrypt()
    {
        $data = "eyJhbGciOiJQQkVTMi1IUzI1NitBMTI4S1ciLCJwMnMiOiI2aFJfRXpnVGRkWSIsInAyYyI6NjQwMDAsImVuYyI6IkEyNTZDQkMtSFM1MTIifQ.5_9Rvey1nsMaLOILsE4xfEABsVl_nGpX4tzNVwXuaykksW7E29PITkdpXvTrFab0wixdXVWxYUnP5o3gdweZHiLAGsHSxow_.dDU5_AIlv1WANdiQXfMDxw.ezvjpEsdETfrKxx8rPKX0wzncUTOp9WrSooMnAA4CEwg2IUFCCWo4Y-V1yKbWDV6j5oyi4kkvXjmHneUWJoaLbPLCujOggQsK6v7LSvsGgMPSdvsv7GXwRgwOMJLRuVvvW2ieHAFz_cEChLDFm0NEw.a6ievc1ibzJ4gnGpZgTgZ-C-m6gPzyC3LuazcTZK1SE";
        //dd($this->encryptionService->getDecrypted($data));
        return response()->json($this->encryptionService->getDecrypted($data));
    }
}