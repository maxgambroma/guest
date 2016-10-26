<?php

class Prodotti_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   
    /*
     * Elenca i conti in partenza
     */
    
    public function prodotti_all($hotel_id ) {

        $sql = "
                SELECT * FROM `prodotti` 
                WHERE `prodotti`.hotel_id = '$hotel_id'
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
   
        public function prodotto_id($hotel_id, $prodotto_id ) {

        $sql = "
                SELECT * FROM `prodotti`
                WHERE hotel_id = '$hotel_id' AND
                     prodotto_id = '$prodotto_id'
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
   
    
    
    
    
    
}
    
    