<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('PosModel');
		$this->load->library('cart');
	}

	public function sell(){
		$this->load->view('template/header-sell');
		$this->load->view('pos/sell');
		$this->load->view('template/footer-sell');
	}

	public function add_to_cart(){ 
        $data = array(
            'id' => $this->input->post('product_id'), 
            'name' => $this->input->post('product_name'), 
            'price' => $this->input->post('product_price'), 
            'qty' => $this->input->post('quantity'),
            'options' => array('Price Cat' => $this->input->post('price_cat')) 
        );
        $this->cart->insert($data);
        $count = $this->cart->total_items();
        if ($this->cart->total_items()){
            echo $this->show_cart();
        }else{
            echo 'fail '.$count;
        }
        
    }
 
    public function show_cart(){ 
        
        $output = null;
        foreach ($this->cart->contents() as $items):
            echo $items['name'];
            $output .='
                <tr>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td>'.$items['qty'].'</td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-xs">Cancel</button></td>
                </tr>
            ';
        endforeach;
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2"><h2>'.'Rs '.number_format($this->cart->total()).'</h2></th>
            </tr>
        ';
        return $output;
    }

    public function load_cart(){ 
        echo $this->show_cart();
    }
 
    public function delete_cart(){ 
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    public function load_cat(){
        $output = null;
        $data = $this->PosModel->load_cat();
        if(!empty($data)){
            //echo json_encode($data);
            foreach ($data as $items):
                $output .='
                    <a class="list-group-item list-item-xl item_cat" href="#" id="" data-cat_id="'. $items["item_cat_id"].'"><b class="list-group-item-heading">'. $items["item_cat_name"] .'</b><span class="badge badge-primary"><i class="fa fa-angle-double-right"></i></span></a>
                ';
            endforeach;
        }else{
            $output = '<a class="list-group-item list-item-xl" href="#"><b class="list-group-item-heading">No categories available</b></a>';
        }
        echo $output;
    }

    public function load_item(){
        $output = null;
        $cat_id = $this->input->get("cat_id");
        $data = $this->PosModel->load_items($cat_id);
        if(!empty($data)){
            foreach($data as $item){
                $output .='<button class="btn btn-lg btn-default item-btn" data-toggle="modal" data-target="#itemModal" data-item_id = '. $item["item_id"] .' >'. $item["item_name"] .'</button>';
            }
        }else{
            $output = "No items available under this category.";
        }

        echo $output;

    }

    public function item_details(){
        $item_id = $this->input->get("item_id");
        $data = $this->PosModel->item_details($item_id);
        if(empty($data)){
            $data = "Null";
        }
        echo json_encode($data);
    }

    public function order(){
        date_default_timezone_set("Asia/Colombo");
        $order_id = date("YmdHi");

        $data = array(
            'order_master_id' => $order_id,
            'order_master_total' => $this->cart->total(),
            'order_master_date' => date("Y-m-d H:i:s"),
            'order_master_emp_id' => 1,
            'order_master_cus_id' => 1,
            'order_master_status' => 1,
            'order_master_paid' => 0
        );

        $this->db->trans_start();
        $this->db->insert('tbl_order_master', $data);

        $data_of_cart = array();
        foreach ($this->cart->contents() as $items){
            $data_of_cart['order_item_master_id'] = $order_id;
            $data_of_cart['order_item_item_id'] = $items['id'];
            $data_of_cart['order_item_qty'] = $items['qty'];
            $data_of_cart['order_item_total'] = $items['subtotal'];
            if ($this->cart->has_options($items['rowid']) == TRUE){
                $data_of_cart['order_item_price_cat'] = $items['options']['Price Cat'];
            }
            
            $this->db->insert('tbl_order_item', $data_of_cart);
        }

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            echo 0;
        }else{
            $this->cart->destroy();
            echo 1;
        }
    }
}
