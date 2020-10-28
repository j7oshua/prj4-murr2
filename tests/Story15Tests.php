<?php


namespace App\Tests;

class Story15Tests{

    public function TextPickedUP(){


    }

    public function TestNotPickedUp(){

    }

    public function TestInaccessible(){

    }

    public function TestContaminated(){

    }

    public function TestConstruction(){

    }


    public function TestOthersuccess(){

    }

    //give success on minimum characters 4
    public function TestOtherMin(){

    }

    //give success on maximum characters 30
    public function TestOtherMax(){

    }

    //give error when not between 4 and 30 characters or empty
    public function TestOtherError(){

        //try something
        $response = $Driver->request('POST','/DriverReportModAPI', [
            'json' => ['SiteId'=> 1, 'serialNumber' => '32oirguio',
                'containerType'=>'Small', 'location'=>'333 dream road'
                , 'collectionHistory'=> null, 'contaminated'=>false, 'construction' => false,
                'accessible' => false, 'other' => '']]);
    }

    //make sure he selected one option
    public function TestSubmitValidation(){

    }


}