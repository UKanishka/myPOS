<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('cart');
	}

	public function index()
	{
		$this->load->view('welcome_message');
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
}
