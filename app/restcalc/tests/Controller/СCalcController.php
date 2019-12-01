<?php
namespace App\tests\Controller;

use App\Controller\СCalcController;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testCalcController()
    {
        $calculator = new СCalcController();

        /**
         * TODO: Processing tests
         */
        $res = $calculator->processing_method_calc("addition", array("10", "20"));
        $this->assertEquals(array(
            "status" => "success",
            "response" => array(
                "string-expression" => "10 + 20 = 30",
                "result" => 30
            ),
        ), $res);

        $res = $calculator->processing_method_calc("addition", "10,20");
        $this->assertEquals(array(
            "status" => "success",
            "response" => array(
                "string-expression" => "10 + 20 = 30",
                "result" => 30
            ),
        ), $res);

        /**
         * TODO: Addition tests
         */
        $res = $calculator->addition_calc(array("10", "20"));
        $this->assertEquals(array(
            "string-expression" => "10 + 20 = 30",
            "result" => 30
        ), $res);

        $res = $calculator->addition_calc(array("10", "20"), "OUT: ");
        $this->assertEquals(array(
            "string-expression" => "OUT: 10 + 20 = 30",
            "result" => 30
        ), $res);
        // operands from valid count >3
        $res = $calculator->addition_calc(array("10", "20", "20", "20", "20"), "OUT: ");
        $this->assertEquals(array(
            "string-expression" => "OUT: 10 + 20 + 20 + 20 + 20 = 90",
            "result" => 90
        ), $res);

        /**
         * TODO: Subtraction tests
         */
        $res = $calculator->subtraction_calc(array("10", "20"));
        $this->assertEquals(array(
            "string-expression" => "10 - 20 = -10",
            "result" => -10
        ), $res);

        $res = $calculator->subtraction_calc(array("10", "20"), "OUT: ");
        $this->assertEquals(array(
            "string-expression" => "OUT: 10 - 20 = -10",
            "result" => -10
        ), $res);

        /**
         * TODO: Multiplication tests
         */
        $res = $calculator->multiplication_calc(array("10", "20"));
        $this->assertEquals(array(
            "string-expression" => "10 * 20 = 200",
            "result" => 200
        ), $res);

        $res = $calculator->multiplication_calc(array("10", "20"), "OUT: ");
        $this->assertEquals(array(
            "string-expression" => "OUT: 10 * 20 = 200",
            "result" => 200
        ), $res);

        /**
         * TODO: Division tests
         */
        $res = $calculator->division_calc(array("10", "20"));
        $this->assertEquals(array(
            "string-expression" => "10 / 20 = 0.5",
            "result" => 0.5
        ), $res);

        $res = $calculator->division_calc(array("10", "20"), "OUT: ");
        $this->assertEquals(array(
            "string-expression" => "OUT: 10 / 20 = 0.5",
            "result" => 0.5
        ), $res);

        /**
         * TODO: Validator tests
         */
        $res = $calculator->validator_operands_calc("addition", array("10", "20"));
        $this->assertEquals(array("status" => "success"), $res);

        // operand type strings
        $res = $calculator->validator_operands_calc("addition", array(10, 10, 10));
        $this->assertEquals(array("status" => "success"), $res);

        // operand not integer
        $res = $calculator->validator_operands_calc("addition", array("test", "324", "rrew"));
        $this->assertEquals(array("status" => "fail", "response" => "Operands not valid!"), $res);

        // method not valid
        $res = $calculator->validator_operands_calc("addition_test", array("10", "20"));
        $this->assertEquals(array("status" => "fail", "response" => "Method set incorrectly!"), $res);

        // operands count >3
        $res = $calculator->validator_operands_calc("addition", array("10", "20", "20", "20"));
        $this->assertEquals(array("status" => "fail", "response" => "Operands not valid!"), $res);

        // operands count <2
        $res = $calculator->validator_operands_calc("addition", array("10"));
        $this->assertEquals(array("status" => "fail", "response" => "Operands not valid!"), $res);

        // count operands >2 other method not addition
        $res = $calculator->validator_operands_calc("division", array("10", "10", "10"));
        $this->assertEquals(array("status" => "fail", "response" => "Operands not valid!"), $res);
    }
}