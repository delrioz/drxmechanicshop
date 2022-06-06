<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\tabelaTeste;

class CarritoController extends Controller
{
    public function index()
    {
        $allproducts = Product::all();
        return view('sections.carrito.index', compact('allproducts'));
    }

    public function processarCompra()
    {
        return view('sections.carrito.compra');

    }

    public function generatingInvoice(Request $request)
    {
        return json_encode($request);

    }

    public function generatingInvoiceAjax(Request $request)
    {
        //isso é considerado array:
        //  $newVar = ["{nome:giovani, idade:30, sexo:masculino}, {nome:gui, idade:15, sexo:masculino},"];
        // return gettype($newVar);

        $dataArray =  $request["data"];
        // $newDataArray =    json_decode($dataArray);
        // return gettype($newDataArray );

        foreach($dataArray as $dA){
            $id = $dA["id"];
            $image = $dA["imagen"];
            $price = $dA["precio"];
            $name = $dA["titulo"];

        $achadoProduct = $findProduct = Product::find($id);
        $name = $achadoProduct->name;
        $SKU = $achadoProduct->SKU;
        $category = $achadoProduct->category;
        $brand = $achadoProduct->brand;
        $image = $achadoProduct->image;
        $Sell_Price = $achadoProduct->Sell_Price;
        $Cost_Price = $achadoProduct->Cost_Price;
        $quantity = $achadoProduct->quantity;
        $about = $achadoProduct->about;
        $machines = $achadoProduct->machines;
        
        
        if($achadoProduct){
            $createProd = new tabelaTeste();
            $createProd->name = $name;
            $createProd->SKU = $SKU;
            $createProd->category = $category;
            $createProd->brand = $brand;
            $createProd->image = $image;
            $createProd->Sell_Price = $Sell_Price;
            $createProd->Cost_Price = $Cost_Price;
            $createProd->quantity =  ($quantity - 3);
            $createProd->about = $about;
            $createProd->machines = $machines;
            $updateProd = $createProd->save();
            
        }
    }

    return json_encode($dataArray);


}

    public function generatedInvoice()
    {
        return "1";
    }
    
}
