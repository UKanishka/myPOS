<?php
class PosModel extends CI_Model
{
    public function load_cat(){
        $query = $this->db->get_where('tbl_item_cat',array('item_cat_status'=> 1));
        return $query->result_array();
    }

    public function load_items($cat_id){
        $query = $this->db->get_where('tbl_item_master',array('item_category' => $cat_id ,'item_status'=> 1));
        return $query->result_array();
    }

    public function item_details($item_id){
        $this->db->trans_start();
        $query = $this->db->get_where('tbl_item_master',array('item_id' => $item_id ,'item_status'=> 1));
        $query2 = $this->db->get_where('tbl_price_cat',array('item_id' => $item_id ,'price_cat_status'=> 1));
        $this->db->trans_complete();

        $data = array(
            'item_details' => $query->row(),
            'price_cat' => $query2->result_array()
        );
        return $data;
    }
}