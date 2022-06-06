<?php

namespace App\Exports;

use App\overvieweachproductsales;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EachProductSalesReports implements FromCollection, WithHeadings
{
 
    public function collection()
    {
        // return overvieweachproductsales::all();
        // return overvieweachproductsales::select('id', 'name', 'SKU', 'category', 'brand', 'image', 'Sell_Price', 'Cost_Price', 'quantity', 'about',
        // 'machines', 'sales_price', 'sales_discount', 'sales_vat', 'ProductId', 'methodPayment', 'salesid', 'totalSalesWithoutVat', 'totalSalesDiscount', 'created_at', 
        // 'updated_at', 'productTotalSales', 'thisProductSalesTotalQuantity', 'thisProductCostPriceTotalQuantity')->orderBy('thisProductSalesTotalQuantity', 'ASC')->get();

        return overvieweachproductsales::orderBy('thisProductSalesTotalQuantity', 'ASC')->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'SKU',
            'category',
            'brand',
            'image',
            'Sell Price',
            'Cost Price',
            'Quantity',
            'About',
            'Machines',
            'Sales Price',
            'Sales Discount',
            'Sales Vat',
            'Product Id',
            'Payment Method',
            'Sales Id',
            'Total Sales Without Vat',
            'Total Sales With Vat',
            'Total Sales Discount',
            'Created at',
            'Updated at',
            'Product Total Sales (With Vat)',
            'Total Products Quantity Sold',
            'Amount of Cost Price from Products sold',
            'Product Id in Products table',
            'Cost Price in Products table',
            'Sales Price in Products table',
            'This Product Total Sales(sales price * quantity)'
        ];
    }
}


