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
     * Guarda a B-1
     * @var         array $Binversa
     */
    protected $Binversa = array();

    /**
     * Guarda a resposta da função objetivo.
     * @var         $valorFunObj
     */
    protected $valorFunObj;

    /**
     * Guarda a lambida
     * @var         array $lambida
     */
    protected $lambida = array();

    /**
     * Guarda o x^b
     * @var         array $Binversa
     */
    protected $xBasico = array();

    /**
     * Contém o vetor das variáveis não básicas.
     * @var         array $N
     */
    protected $N = array();

    /**
     * Vetor de custos das variáveis básicas.
     * @var         array $Cb
     */
    protected $Cb = array();

    /**
     * Vetor de custos das variáveis não básicas.
     * @var         array $Cn
     */
    protected $Cn = array();
    protected $calculoCustos = array();
    protected $calculoDirecaoSimplex = array();
    protected $basicIndexes = array();
    
    

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
        echo '<br/> Valores da função objetivo:';
        $this->printTable($this->funObj);
        echo '<br/> A:';
        $this->printTable($this->xs);
        echo '<br/> B:';
        $this->printTable($this->B);
        echo '<br/> N:';
        $this->printTable($this->N);
        echo '<br/>b';
        $this->printTable($this->results);
        echo '<br/> CtB:';
        $this->printTable($this->Cb);
        echo '<br/> CtN:';
        $this->printTable($this->Cn);
        echo '<br/> ^xB:';
        $this->printTable($this->xBasico);
        echo '<br/> &lambda;:';
        $this->printTable($this->lambida);
        echo '<br/> Basic Indexes:';
        $this->printTable($this->basicIndexes);
        echo '<br/> B-¹:';
        $this->printTable($this->Binversa);
        
        echo '<br> C^ (Calculo dos Custos Relativos):';
        $this->printTable($this->calculoCustos);
        
        echo '<BR/> Y do calculo da direcao simplex:';
        $this->printTable($this->calculoDirecaoSimplex);

        
        echo '<br/>Qtd Function: ' . $this->qtyFunctions;
        echo '<br/>Qtd Vars:' . $this->qtyVars;
        echo '<br/>Valor Função Objetivo:' . $this->valorFunObj;

        echo '</pre>';
    }

    protected function printTable($vetor) {
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<table class="table table-bordered table-striped span7">';
        foreach ($vetor as $linha => $dados) {
            echo '<tr>';
            if (is_array($dados)) {
                foreach ($dados as $coluna => $valor) {
                    echo '<td title="' . $linha . 'x' . $coluna . '">' . $valor . '</td>';
                }
            } else {
                echo '<td title="' . $linha . '">' . $dados . '</td>';
            }

            echo '</tr>';
        }
        echo '</table>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
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
        $Cn = $Cb = array();


        $qtyXs = range(0, ($this->getQtyVars() - 1));

       

        $indexesNotBasic = (array_diff($qtyXs, $indexesBasic));

        for ($function = 0; $function < $this->getQtyFunctions(); $function++) {

            foreach ($indexesBasic as $xPos) {
                $basics[$function][$xPos] = $this->getXValor($function, $xPos, 0);
                $Cb[$xPos] = $this->getFunObjValor($xPos, 0);
            }

            foreach ($indexesNotBasic as $xPos) {
                $notBasics[$function][$xPos] = $this->getXValor($function, $xPos, 0);
                $Cn[$xPos] = $this->getFunObjValor($xPos, 0);
            }
        }


        $this->B = $basics;
        $this->Cb = $Cb;
        $this->N = $notBasics;
        $this->Cn = $Cn;
        $this->basicIndexes = $indexesBasic;


        $cleanB = array();
        $i = 1;
        foreach ($this->B as $ind => $data) {
            $j = 1;
            foreach ($data as $ind2 => $valor) {
                $cleanB[$i][$j] = $valor;
                $j++;
            }
            $i++;
        }
        $this->Binversa = Vetor_Math::MatrizInversa($cleanB, $this->getQtyVars(), $this->getQtyFunctions(), count($indexesBasic));


        //Binversa x b (resultados)
        $xBasico = array();
        foreach ($this->Binversa as $linhaAtual => $dadosLinha) {
            $linhaResultado = 0;
            $resultado = 0;

            foreach ($dadosLinha as $colunaAtual => $valor) {
                $multiplicador = $this->getRestricaoResultado($linhaResultado);

                $resultado = $resultado + $valor * $multiplicador;

                $linhaResultado++;
            }

            $xBasico[$linhaAtual] = $resultado;
        }

        $indErrado = 1;
        $xBasicoCopia = array();

        foreach ($Cb as $indCerto => $valor) {
            $xBasicoCopia[$indCerto] = $xBasico[$indErrado];
            $indErrado++;
        }


        $this->xBasico = $xBasicoCopia;
        $this->getValorFuncaoObjetivo();
        $this->getValorLambida();
        $this->calcularCustoRelativo();
    }

    /**
     * Calcula o valor da função objetivo com o xBasico e o vetor de custo das básicas
     * 
     */
    protected function getValorFuncaoObjetivo() {

        $resultado = 0;

        foreach ($this->Cb as $pos => $valor) {
            $resultado = $resultado + ($this->Cb[$pos] * $this->xBasico[$pos]);
        }
        $this->valorFunObj = $resultado;
    }

    /**
     * Calcula o valor da lambida pasando o Custo das básicas  e a matriz inversa de B
     */
    protected function getValorLambida() {

        $cbT = array_values($this->Cb);
        $binversa = array_values($this->Binversa);
        foreach ($binversa as $linha => $dados) {
            $binversa[$linha] = array_values($dados);
        }

        $resultado = array();

        foreach ($cbT as $coluna => $multiplicador) {
            $colunaMultiplicador = 0;
            $resultado[$coluna] = 0;
            foreach ($binversa as $linha => $valores) {
                $resultado[$coluna] = $resultado[$coluna] + $cbT[$colunaMultiplicador] * $binversa[$linha][$coluna];
                $colunaMultiplicador++;
            }
        }

        $this->lambida = $resultado;
    }

    /**
     * Calcula o custo relativo.
     * Custo não básicas x
     */
    protected function calcularCustoRelativo() {
        $cn = $this->Cn;
        $usarSimplex = false;

        $this->calculoCustos = array();

        foreach ($cn as $pos => $valor) {

            $naoBasica = $this->getColuna($this->N, $pos);

            $resultado = 0;
            foreach ($this->lambida as $linha => $valorLambida) {
                $resultado = $resultado + $this->lambida[$linha] * $naoBasica[$linha];
            }


            $resultado = $valor - $resultado;
            //@todo: Lembrar de fazer a parte de verificar se é ótima 
            //SE resultado < 0 : fodeu.
            if ($resultado < 0) {
                $usarSimplex = true;
            }
            $this->calculoCustos[$pos] = $resultado;
        }
        if ($usarSimplex) {
            $this->calculoDirecaoSimplex();
        }else{
            $this->imprimirSolucao();
        }
    }
    
    /**
     * Imprime a solução do sistema.
     */
    protected function imprimirSolucao(){
        $this->_printAll();
    }

    /**
     * Retorna uma coluna de um vetor.
     * 
     */
    public function getColuna($vetor, $coluna) {

        $resposta = array();

        foreach ($vetor as $linha => $dados) {
            $resposta[] = $dados[$coluna];
        }
        return $resposta;
    }

    protected function calculoDirecaoSimplex() {


        $menor = min($this->calculoCustos);

        $indiceNviraB = null;

        foreach ($this->calculoCustos as $ind => $valor) {
            if ($valor == $menor) {
                $indiceNviraB = $ind;
            }
        }

        $n = $this->getColuna($this->N, $indiceNviraB);


        $binversa = array_values($this->Binversa);
        foreach ($binversa as $linha => $dados) {
            $binversa[$linha] = array_values($dados);
        }

        $xBasicos = $this->xBasico;




        $y = array();
        foreach ($binversa as $linhaAtual => $dadosColunas) {
            $y[$linhaAtual] = 0;

            foreach ($dadosColunas as $colunaAtual => $valor) {
                $y[$linhaAtual]+= $valor * $n[$colunaAtual];
            }
        }
        $this->calculoDirecaoSimplex = $y;

        $e = array();
        $indY = 0;
        foreach ($xBasicos as $pos => $valor) {
            if ($y[$indY] > 0) {
                $e[] = $valor / $y[$indY];
            }
            $indY++;
        }
        //min($e);
        $e = min($e);

        $indY = 0;

        $indiceBviraN = null;
        foreach ($xBasicos as $xPos => $valor) {
            if ($valor - ($y[$indY] * $e) == 0) {
                //Achamos a que será trocada!
                $indiceBviraN = $xPos;
            }
            $indY++;
        }

        $basicIndexes = $this->basicIndexes; //array(2,3,4);

        foreach ($basicIndexes as $pos => $varX) {
            if ($varX == $indiceBviraN) {
                $basicIndexes[$pos] = $indiceNviraB;
                break;
            }
        }

        $this->setQtyFunctions($this->getQtyFunctions())
                ->setQtyVars($this->getQtyVars())
                ->setFunObj($this->funObj)
                ->setFunctionEquality($this->functionEquality)
                ->setXs($this->xs)
                ->setResults($this->results)
                ->setBasicIndexes($basicIndexes);
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
