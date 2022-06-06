<?php

namespace App\Exports;

use App\Product;
use App\prodinfostoexport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ProductsExport implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        return prodinfostoexport::all();

        // CREATE VIEW prodinfostoexport as  SELECT id, name, categoryName, SKU, brand, Sell_Price, Sell_PriceVat, Cost_Price, quantity
        // FROM productsallinfos

        // // return $expProducts;

    }

    public function headings(): array
    {
        return [
                'Id',
                'Name',
                'Category Name',
                'SKU',
                'Brand',
                'Sell Price',
                'Sell Price Vat',
                'Cost Price',
                'Quantity',
        ];
    }
}

