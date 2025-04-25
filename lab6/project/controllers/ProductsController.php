<?php
namespace Project\Controllers;

use core\Controller;
use \Project\Models\Products;

class ProductsController extends Controller
{
    
     public function one($params)
    {
	$products = (new Products) -> getById($params['id']);
			
	$this->title = $products['название'];
	return $this->render('products/one', [
		'text' => $products['описание'],
		'h1' => $this->title
	]);
     }
		
     public function Pall()
     {
	
		
	$products = (new Products) -> getAll();
	return $this->render('products/all', ['products' => $products
	]);
     }
}