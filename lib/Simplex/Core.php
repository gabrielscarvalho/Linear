<?php

/**
 * Classe de manipulação dos dados do Simplex
 * @author      Gabriel Santos Carvalho
 * @version     1.0
 * 
 */
class Simplex_Core {

    /**
     * Quantas variáveis temos?
     * @var         int $qtyVars
     */
    protected $qtyVars;

    /**
     * Quantas restrições?
     * @var         int $qtyFunctions
     */
    protected $qtyFunctions;

    /**
     * Contém as variáveis "x"
     * @var         array $xs
     */
    protected $xs = array();

    /**
     * Contém as variáveis de resultado.
     * @var         array $results
     */
    protected $results = array();

    /**
     * Contém o simbolo de igualdade de cada função.
     * @var         array $functionEquality
     */
    protected $functionEquality = array();

    /**
     * Contém as variáveis da função objetivo.
     * @var         array $funObj
     */
    protected $funObj = array();

    /**
     * Contém o vetor das variáveis básicas.
     * @var         array $B
     */
    protected $B = array();

    /**
     * Contém o vetor das variáveis não básicas.
     * @var         array $N
     */
    protected $N = array();

    /**
     * Seta a quantidade de funções.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       int $qtyVars Quantas variáveis foram escolhidas ?
     * @return      $this
     */
    public function setQtyVars($qtyVars) {
        $this->qtyVars = $qtyVars;
        return $this;
    }

    /**
     * Seta a quantidade de restrições
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       int $qtyFunctions Quantas funções temos?
     * @return      $this
     */
    public function setQtyFunctions($qtyFunctions) {
        $this->qtyFunctions = $qtyFunctions;
        return $this;
    }

    /**
     * Seta as variáveis x de cada função.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       array $xs No formato array[funcao][x] = valor
     * @return      $this
     */
    public function setXs($xs) {
        $this->xs = $xs;
        return $this;
    }

    /**
     * Seta os resultados das restrições
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       array $results No formato array[funcao] = resultado
     * @return      $this
     */
    public function setResults($results) {
        $this->results = $results;
        return $this;
    }

    /**
     * Seta os simbolos de igualidade das funções.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       array $functionEquality , no formato: array[funcao] = ">="
     * @return      $this
     */
    public function setFunctionEquality($functionEquality) {
        $this->functionEquality = $functionEquality;
        return $this;
    }

    /**
     * Seta os x's da função objetivo.
     * @author      Gabriel Santos Carvalho
     * @version     1.0
     * @since       21/06/2012
     * @param       array $funcObj , no formato array[posVariavel] = "3" 
     * @return      $this
     */
    public function setFunObj($funObj) {
        $this->funObj = $funObj;
        return $this;
    }

    /**
     * Retorna a quantidade de variáveis.
     * @return          int
     */
    public function getQtyVars() {
        return $this->qtyVars;
    }

    /**
     * Retorna a quantidade de funções.
     * @return          int
     */
    public function getQtyFunctions() {
        return $this->qtyFunctions;
    }

    /**
     * Guarda o valor da variável X.
     * @param       float $x O valor da variável
     * @param       int $funcaoPos A qual função pertence ?
     * @param       int $xPos A qual x' pertence ? x1, x2, x3?
     * @return      $this
     */
    public function setXValor($x, $funcaoPos, $xPos) {
        $this->xs[$funcaoPos][$xPos] = $x;
        return $this;
    }

    /**
     * Retorna o valor da variável X.
     * @param       int $funcaoPos A qual função pertence ?
     * @param       int $xPos A qual x' pertence ? x1, x2, x3?
     * @param       float $default Qual o valor retornar caso não encontre?
     * @return      float
     */
    public function getXValor($funcaoPos, $xPos, $default = 0) {
        if (isset($this->xs[$funcaoPos][$xPos])) {
            return $this->xs[$funcaoPos][$xPos];
        }
        return $default;
    }

    /**
     * Guarda o valor da função objetivo.
     * @param       float $val O valor da variável
     * @param       int $variavelPos Qual variável pertece ? x"1", x"2", x"3" ?
     * @return      $this
     */
    public function setFunObjValor($val, $variavelPos) {
        $this->funObj[$variavelPos] = $val;
        return $this;
    }

    /**
     * Guarda o valor da função objetivo.
     * @param       int $variavelPos Qual variável pertece ? x"1", x"2", x"3" ?
     * @param       float $default Qual é o valor default caso não encontre ?
     * @return      $this
     */
    public function getFunObjValor($variavelPos, $default = 0) {
        if (isset($this->funObj[$variavelPos])) {
            return $this->funObj[$variavelPos];
        }
        return $default;
    }

    /**
     * Guarda o valor do resultado das restrições.
     * @param       float $val O valor da variável
     * @param       int $funcaoPos Qual função pertece ? 
     * @return      $this
     */
    public function setRestricaoResultado($val, $funcaoPos) {
        $this->results[$funcaoPos] = $val;
        return $this;
    }

    /**
     * Retorna o valor do resultado das restrições.
     * @param       int $funcaoPos Qual função pertece ? 
     * @param       float $default Qual é o valor default caso não encontre ?
     * @return      $this
     */
    public function getRestricaoResultado($funcaoPos, $default = 0) {
        if (isset($this->results[$funcaoPos])) {
            return $this->results[$funcaoPos];
        }
        return $default;
    }

    /**
     * Guarda o valor da comparação da função.
     * @param       float $val O valor da variável Ex. =, >=, <=
     * @param       int $funcaoPos Qual função pertece ? 
     * @return      $this
     */
    public function setRestricaoComparacao($val, $funcaoPos) {
        $this->functionEquality[$funcaoPos] = $val;
        return $this;
    }

    /**
     * Retorna o valor da comparação da função.
     * @param       int $funcaoPos Qual função pertece ? 
     * @param       float $default Qual é o valor default caso não encontre ?
     * @return      $this
     */
    public function getRestricaoComparacao($funcaoPos, $default = 0) {
        if (isset($this->functionEquality[$funcaoPos])) {
            return $this->functionEquality[$funcaoPos];
        }
        return $default;
    }

    /**
     * Imprime os valores na tela.
     * @return      void
     */
    public function _printAll() {
        echo '<pre>';
        echo '<br/> Func Obj:';
        print_r($this->funObj);
        echo '<br/> Xs:';
        print_r($this->xs);
        echo '<br/>Signal:';
        print_r($this->functionEquality);
        echo '<br/>Results:';
        print_r($this->results);
        echo '<br/> Basics:';
        print_r($this->B);
        echo '<br/> Not Basics:';
        print_r($this->N);
        
        echo '<br/>Qtd Function: ' . $this->qtyFunctions;
        echo '<br/>Qtd Vars:' . $this->qtyVars;
        echo '</pre>';
    }

    /**
     * Seta quais são as variáveis básicas passando o índice de cada.
     * @author          Gabriel Santos Carvalho
     * @version         1.0
     * @since           22/06/2012
     * @param           array $indexesBasic
     * @example         array(1,2,4) //x1, x2 e x4 serão básicas.
     */
    public function setBasicIndexes($indexesBasic) {
        $notBasics = $basics = array();

        $qtyXs = range(0, $this->getQtyFunctions());

        $indexesNotBasic = (array_diff($qtyXs, $indexesBasic));

        for ($function = 0; $function < $this->getQtyFunctions(); $function++) {
            foreach ($indexesBasic as $xPos) {
                $basics[$function][$xPos] = $this->getXValor($function, $xPos, 0);
            }

            foreach ($indexesNotBasic as $xPos) {
                $notBasics[$function][$xPos] = $this->getXValor($function, $xPos, 0);
            }
        }
        $this->B = $basics;
        $this->N = $notBasics;
    }

    /**
     * Retorna as variáveis da função objetivo para o design
     * @return      string
     */
    public function getObjetivoVarsHtml() {
        $html = '';
        for ($x = 1; $x <= $this->getQtyVars(); $x++) {
            $div = ($x > 1) ? ', ' : '';
            $html.= $div . 'x' . $x;
        }
        return $html;
    }

}
