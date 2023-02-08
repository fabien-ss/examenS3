<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U_helper extends CI_Model {
    public function countString($str){
        $i=0;
        while($i!=-1){
            try{
                $str[$i];
            }
            catch(Exception $e){
                return $i;
            }
            $i++;
        }
    }
}
