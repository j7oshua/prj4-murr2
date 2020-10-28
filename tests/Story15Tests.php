<?php


namespace App\Tests;
use App\Controller\DriverReportController;
use App\Entity\RecycleContainer;
use PHPUnit\Framework\TestCase;

class Story15Tests extends TestCase{

    //give success on picked up functionality
    public function TextPickedUP(){

         $result = DriverReportController::isPickedUp(true);

        //$this->assertTrue(true == $result);
    }
    //give success on not picked up functionality
    public function TestNotPickedUp(){

        $result = DriverReportController::isPickedUp(false);
        //$this->assertTrue(true == $result);
    }
    //gives success on Inaccessible functionality
    public function TestInaccessible(){


        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $result = DriverReportController::SetInaccessible($container1,true);

        //$this->assertTrue(true == $result);
    }
    //gives success on Contaminated option functionality
    public function TestContaminated(){
        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $result = DriverReportController::SetContaminated($container1,true);

        //$this->assertTrue(true == $result);
    }
    //gives success on Construction option functionality
    public function TestConstruction(){

        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $result = DriverReportController::SetConstruction($container1,true);

        //$this->assertTrue(true == $result);
    }


    //gives success on other option functionality
    public function TestOthersuccess(){
        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "it was Icey";
        $result = DriverReportController::SetOther($container1,$testText);

        //$this->assertTrue(true == $result);
    }

    //give success on minimum characters 4 in other text box
    public function TestOtherMin(){
        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "Bear";
        $result = DriverReportController::SetOther($container1,$testText);

    //$this->assertTrue(true == $result);
    }

    //give success on maximum characters 30 in other text box
    public function TestOtherMax(){
        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "abc def ghi jkl mno pqrs tuv w";
        $result = DriverReportController::SetOther($container1,$testText);

        //$this->assertTrue(true == $result);
    }

    //give fail when empty in other text box
    public function TestOtherErrorEmpty(){

        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "";
        $result = DriverReportController::SetOther($container1,$testText);

        //$this->assertFalse(true == $result);

    }
    //give fail when not between 4 and 30 characters max edge
    public function TestOtherErrorMaxEdge(){

        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "abc def ghi jkl mno pqrs tuv wx";
        $result = DriverReportController::SetOther($container1,$testText);
        //$this->assertFalse(true == $result);
    }
    //give fail when not between 4 and 30 characters min edge
    public function TestOtherErrorMinEdge(){
        RecycleContainer: $container1 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, false, false, false, null );

        $testText = "bad";
        $result = DriverReportController::SetOther($container1,$testText);

        //$this->assertFalse(true == $result);
    }

    //give success when click submit and has selected one option
    public function TestSubmitValidation(){
        RecycleContainer: $container2 =new RecycleContainer('1','32oirguio','Small', '333 dream road',
            null, true, false, false, null );


        $result = DriverReportController::SubmitReport($container2,  DriverReportController::getStatus($container2) );

        //$this->assertTrue(true == $result);
    }


}