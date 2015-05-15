<?php namespace MauroCasas\Cbu {

    /**
     * @package Cbu
     * @version 0.1
     * @author Mauro Casas <casas.mauroluciano@gmail.com>
     */

    class Cbu {

        protected $config = array();
        protected $cbu = false;

        public function __construct($config){
            $this->config = $config;
        }

        /** 
         * @param string
         * @return Cbu
         */
        public function set($cbu){
            $this->cbu = $cbu;
            return $this;
        }

        /**
         * @uses verificador()
         * @return boolean
         */
        public function isValid(){
            if(strlen($this->cbu) <> 22)
                return false;

            $cbuDigits = str_split($this->cbu);

            foreach($cbuDigits as $digit)
                if( ! is_numeric($digit))
                    return false;

            if ($cbuDigits[7] !== $this->verifier($cbuDigits, 0, 6) ||
                $cbuDigits[21] !== $this->verifier($cbuDigits, 8, 20))
                return false;

            return true;
        }

        /** 
         * Returns the bank name based on it's ID
         * @uses bankId()
         * @return string|null
         */
        public function bank(){
            return array_key_exists($this->bankId(), $this->config['banks']) ? $this->config['banks'][$this->bankId()] : null;
        }

        /**
         * Returns the bank ID # from the CBU
         * @return string
         */
        public function bankId(){
            return substr($this->cbu, 0, 3);
        }

        /**
         * Does the math to get the verifying digit for the CBU
         * @param $digits array
         * @param $start int
         * @param $stop int
         * @return int
         */
        protected function verifier($digits, $start, $stop){
            $sum = 0;
            $j = 0;

            for ($i = $stop; $i >= $start; $i--){
                $ponds = array(3, 1, 7, 9);
                $sum += $digits[$i] * $ponds[$j % 4];
                $j++;
            }

            $digit = (10 - $sum % 10) % 10;

            return $digit;
        }

    }

}