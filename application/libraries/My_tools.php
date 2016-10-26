<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Tools {

    /**
     * 
     * Funzione che somma un determinato numero di giorni ($gg) ad
     * una data $OGGI
     * 
     * @param date $OGGI
     * @param int $gg
     * 
     * @return type
     */
    public function somma_gg($OGGI, $gg) {
        $appoggio = explode('-', $OGGI);
        $anno = $appoggio[0];
        $mese = $appoggio[1];
        $giorno = $appoggio[2];

        return $data_gg = date("Y-m-d", mktime(0, 0, 0, $mese, ($giorno + $gg), $anno));
    }

    /**
     * 
     * La funzione torna il numero di giorno di differenza tra due date
     * 
     * @param date $preno_al
     * @param date $preno_dal
     * 
     * @return type
     */
    public function data_diff($preno_al, $preno_dal) {
        $differenza_date = strtotime($preno_al) - strtotime($preno_dal);
        return $data_diff = date('z', $differenza_date);
        //echo date('z',$data_diff);
    }




 

}

/* End of file Tools.php */