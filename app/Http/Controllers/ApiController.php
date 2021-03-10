<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EncryptionService;
use App\Models\Employee;
use App\Models\Encrequest;
use Redirect;
use Response;

class ApiController extends Controller
{
    //
    private $encryptionService;

    public function __construct(EncryptionService $encryptionService)
    {
        $this->encryptionService = $encryptionService;
    }

    public function encrypt()
    {
        //$employees = [];

        $id = rand(1,1000);

        $results = Employee::find($id);

        $data = [
            'name' => $results['name'],
            'email' => $results['email'],
            'phone' => $results['phone'],
            'dob' => $results['dob'],
        ];

        $encryptdata = $this->encryptionService->getEncrypted($data);
        //return $encryptdata;
        $storeData = [
            'encrequests' => $encryptdata,
        ];
        $encreq = Encrequest::create($storeData);
        return $encryptdata;

    }

}
