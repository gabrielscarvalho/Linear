<?php

/**
 * Classe de manipulação matemática de vetores
 * @author          Heitor
 * @version         1.0
 */
class Vetor_Math {

    public static function MatrizInversa($B, $a, $m, $n) {
        $inverter = $B;

        for ($lin = 1; $lin <= $m; $lin++) {
            for ($col = $n + 1; $col <= $n * 2; $col++) {
                if (($col - $n) == $lin)
                    $aux = 1;
                else
                    $aux = 0;
                $inverter[$lin][$col] = $aux;
            }
        }

        $flag = 0;

        $inversa = $inverter;

        for ($col = 1; $col <= $n; $col++)
            for ($lin = 1; $lin <= $m; $lin++)
                if (($lin == $col) && ($inversa[$lin][$col] != 1) || (($lin != $col) && ($inversa[$lin][$col] != 0))) {
                    if ($lin == $col)
                        $valorL = $inversa[$lin][$col] - 1;
                    else
                        $valorL = $inversa[$lin][$col];

                    for ($cont = 1; $cont <= $m; $cont++)
                        if ($cont != $lin)
                            if ($inversa[$cont][$col] != 0) {
                                $valorM = $inversa[$cont][$col];
                                $flag = 1;
                                $linha = $cont;
                            }
                    if ($flag == 1) {
                        $valor = -1 * ($valorL / $valorM);
                        for ($coluna = 1; $coluna <= $a + 1; $coluna++) {
                            $conteudo = $inversa[$linha][$coluna] * $valor;
                            $inversa[$lin][$coluna] = $inversa[$lin][$coluna] + round($conteudo);
                        }
                    }
                }

        for ($lin = 1; $lin <= $m; $lin++) {
            for ($col = 1; $col <= $n; $col++) {
                $BInversa[$lin][$col] = $inversa[$lin][$col + $n];
            }
        }
        return $BInversa;
    }

    /**
     * Retorna a matriz inversa
     * @author          Heitor
     * @version         1.0
     * @param           int $qtdColunas A ( A quantidade de colunas da matriz A = B + N)
     * @param           array B a matriz a ser invertida
     * @param           int $qtdLinhas A quantidade de linhas da matriz B
     * @param           int $qtdColunas A quantidade de colunas da matriz B
     * @param           int $qtdLinhas
     * @return          array
     */
    public static function MatrizInversa2($qtdColunasA, $B, $qtdLinhas, $qtdColunas) {

        //Mesclamos o vetor B com o Identidade.
        $BI = Vetor_Math::mergeIdentidade($B, $qtdLinhas, $qtdColunas);

        $flag = 0;
        //INVERTENDO B + I
        for ($col = 0; $col < $qtdColunas; $col++) {
            for ($lin = 0; $lin < $qtdLinhas; $lin++)
                if (($lin == $col) && ($BI[$lin][$col] != 1) || (($lin != $col) && ($BI[$lin][$col] != 0))) {
                    if ($lin == $col) {
                        $valorL = $BI[$lin][$col] - 1;
                    } else {
                        $valorL = $BI[$lin][$col];
                    }
                    for ($cont = 0; $cont < $qtdLinhas; $cont++)
                        if ($cont != $lin) {
                            if ($BI[$cont][$col] != 0) {
                                $valorM = $BI[$cont][$col];
                                $flag = 1;
                                $linha = $cont;
                            }
                        }
                    if ($flag == 1) {
                        $valor = $qtdColunasA - 1 * ($valorL / $valorM);
                        for ($coluna = 0; $coluna < $qtdColunasA; $coluna++) {
                            $conteudo = $BI[$linha][$coluna] * $valor;
                            $BI[$lin][$coluna] = $BI[$lin][$coluna] + round($conteudo);
                        }
                    }
                }
        }
        return $BI;
        // EXTRAINDO B^-1 DA PUTARIA AI EM CIMA
        for ($lin = 0; $lin < $qtdLinhas; $lin++) {
            for ($col = 1; $col <= $qtdColunas; $col++) {
                $BInversa[$lin][$col] = $BI[$lin][$col + $qtdColunas];
            }
        }

        return $BInversa;




//        //Invertendo agora a posição (passando a identidade na frente da B, teremos a B-1)
//        $inversa = array();
//
//
//        for ($colunaAtual = 0; $colunaAtual < $qtdColunas; $colunaAtual++) {
//            //Transformamos sempre inicialmente o "1" da matriz identidade para cada linha.
//            $linhaValor1 = $colunaAtual;
//
//            if (($BI[$linhaValor1][$colunaAtual] != 1) && ($BI[$linhaValor1][$colunaAtual] != 0)) {
//                //Teremos que transformar esse valor em 1.
//                $divisor = $BI[$linhaValor1][$colunaAtual];
//                //Para transformá-lo em 1, dividimos a linha inteira por esse valor.
//                foreach ($BI[$linhaValor1] as $coluna => $valor) {
//                    $valor = $valor / $divisor;
//                    $BI[$linhaValor1][$coluna] = $valor;
//                }
//            } elseif ($BI[$linhaValor1][$colunaAtual] == 0) {
//                
//            }
//
//            //            foreach ($BI as $linhaAtual => $dadosLinha) {
//            //
//    //                if ($linhaAtual != $colunaAtual) {
//            //                    $valor0 = $BI[$linhaAtual][$colunaAtual];
//            //
//    //                    if ($valor0 != 0) {
//            //                        //Invertemos o valor, para ser o multiplicador de 1, fazendo que esse item seja zerado. 9 + (-9) x 1 = 0
//            //                        $multiplicador = -$valor0;
//            //                        $dadosLinha1 = $BI[$linhaValor1];
//            //
//    //                        foreach ($dadosLinha as $colunaOperacao => $valorAtual) {
//            //                            $valorAtual = $valorAtual + ($multiplicador * $dadosLinha1[$colunaOperacao]);
//            //                            $BI[$linhaAtual][$colunaAtual] = $valorAtual;
//            //                        }
//            //                    }
//            //                } else {
//            //                    continue;
//            //                }
//            //            } 
//        }
//        return $BI;
    }

    /**
     * Adiciona um array identidade ao array.
     * @author          Gabriel Santos Carvalho
     * @version         1.0
     * @since           23/06/2012
     * @param           array $vetor Um vetor de 2 dimensões.
     * @return          $vetor.$I
     */
    public static function mergeIdentidade($vetor, $qtdLinhas, $qtdColunas) {

        foreach ($vetor as $linhaAtual => $dados) {
            $qtdColunas = count($dados);
            for ($colunaAtual = 0; $colunaAtual < $qtdColunas; $colunaAtual++) {
                $vetor[$linhaAtual][] = ($linhaAtual == $colunaAtual) ? 1 : 0;
            }
        }
        return $vetor;
    }

}
