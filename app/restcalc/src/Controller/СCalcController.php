<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class СCalcController extends AbstractController
{
    /**
     * @Rest\Get("/calc/", name="get_calc")
     */
    public function get_calc(Request $request)
    {
        $arResult = self::processing_method_calc(
            $request->query->get('method'),
            $request->query->get('items')
        );
        return $this->json($arResult);
    }

    /**
     * @Rest\Post("/calc/", name="post_calc")
     */
    public function post_calc(Request $request)
    {
        $arResult = self::processing_method_calc(
            $request->request->get('method'),
            $request->request->get('items')
        );
        return $this->json($arResult);
    }

    /**
     * @param $method
     * @param $operands
     * @return array|bool
     */
    public function validator_operands_calc($method, $operands){
        $arMethod = array('addition', 'subtraction', 'multiplication', 'division');
        if(array_search($method, $arMethod)!==FALSE){
            $is_numb = true;
            $is_valid = false;
            foreach ($operands as $operand){
                if(!is_numeric($operand)){
                    $is_numb = false;
                    break;
                }
            }
            switch ($method){
                case 'addition':
                    if(count($operands) >=2 && count($operands) <=3)
                        $is_valid = true;
                    break;
                default:
                    if(count($operands) == 2)
                        $is_valid = true;
                    break;
            }
            if(
                is_array($operands) &&
                $is_numb && $is_valid
            ){
                $arResult = array('status' => 'success');
            }else{
                $arResult = array(
                    'status' => 'fail',
                    'response' => 'Operands not valid!',
                );
            }
        }else{
            $arResult = array(
                'status' => 'fail',
                'response' => 'Method set incorrectly!',
            );
        }
        return $arResult;
    }

    /**
     * @param string $method
     * @param array $operands
     * @return array|bool
     */
    public function processing_method_calc($method = "", $operands = array())
    {
        $arResult = self::validator_operands_calc($method, $operands);
        if($arResult['status']=='success'){
            switch ($method){
                case 'addition':
                    $arResult['response'] = self::addition_calc($operands);
                    break;
                case 'subtraction':
                    $arResult['response'] = self::subtraction_calc($operands);
                    break;
                case 'multiplication':
                    $arResult['response'] = self::multiplication_calc($operands);
                    break;
                case 'division':
                    $arResult['response'] = self::division_calc($operands);
                    break;
            }
        }
        return $arResult;
    }

    /**
     * @param array $operands
     * @param string $str
     * @return array
     */
    public function addition_calc($operands = array(), $str = "")
    {
        $res = 0;
        foreach ($operands as $k => $item){
            $res += $item;
            if(!$k)
                $str .= $item;
            else
                $str .= " + ".$item;
        }
        return array(
            'string-expression' => $str." = ".$res,
            'result' => $res
        );
    }

    /**
     * @param array $operands
     * @param string $str
     * @return array
     */
    public function subtraction_calc($operands = array(), $str = "")
    {
        $res = $operands[0] - $operands[1];
        $str .= $operands[0]." - ".$operands[1];
        return array(
            'string-expression' => $str." = ".$res,
            'result' => $res
        );
    }

    /**
     * @param array $operands
     * @param string $str
     * @return array
     */
    public function multiplication_calc($operands = array(), $str = "")
    {
        $res = $operands[0] * $operands[1];
        $str .= $operands[0]." * ".$operands[1];
        return array(
            'string-expression' => $str." = ".$res,
            'result' => $res
        );
    }

    /**
     * @param array $operands
     * @param string $str
     * @return array
     */
    public function division_calc($operands = array(), $str = "")
    {
        $res = $operands[0] / $operands[1];
        $str .= $operands[0]." / ".$operands[1];
        return array(
            'string-expression' => $str." = ".$res,
            'result' => $res
        );
    }
}
