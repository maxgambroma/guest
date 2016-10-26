<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hotel_model
 *
 * @author max
 */
class Hotel_model extends CI_Model {
    
        function __construct() {
        parent::__construct();
    }

   
    /*
     * Elenca i conti in partenza
     */
    public function hotels() {

        $sql = "
            SELECT *
            FROM hotels
            ORDER BY hotel_id ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
    
        public function hotel($hotel_id) {

        $sql = "
                SELECT * 
                FROM `hotels` 
                WHERE `hotel_id`= '$hotel_id'
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
}
