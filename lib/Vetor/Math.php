<?php

/**
 * Classe de manipulação matemática de vetores
 * @author          Heitor
 * @version         1.0
 */
class Vetor_Math {

    /**
     * Aplica o método de gauss em um vetor.
     * @author          Heitor
     * @version         1.0
     * @return          array
     */
    public function gauss($B, $m, $n) {
        $inverter = $B;

// CRIANDO A MATRIZ B + I ~~GAUSS
        for ($lin = 1; $lin <= $m; $lin++) {
            for ($col = $n + 1; $col <= $n * 2; $col++) {
                if (($col - $n) == $lin)á
                $aux = 1;
                else
                $aux = 0;
                $inverter[$lin][$col] = $aux;
            }
        }

        $flag = 0;

        $inversa = $inverter;

//INVERTENDO B + I
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
                        $valor = á - 1 * ($valorL / $valorM);
                        for ($coluna = 1; $coluna <= $a + 1; $coluna++) {
                            $conteudo = $inversa[$linha][$coluna] * $valor;
                            $inversa[$lin][$coluna] = $inversa[$lin][$coluna] + round($conteudo);
                        }
                    }
                }

        // EXTRAINDO B^-1 DA PUTARIA AI EM CIMA
        for ($lin = 1; $lin <= $m; $lin++) {
            for ($col = 1; $col <= $n; $col++) {
                $BInversa[$lin][$col] = $inversa[$lin][$col + $n];
            }
        }
    }

}
