<?php

namespace App\Exports;

use App\Models\Product;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class ProductsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Product::all();
    // }

    // public function headings(): array
    // {
    //     return [
    //         'ID',
    //         'Name',
    //         'Price',
    //         'Description',
    //         'created_at',
    //         'updated_at',
    //         'barcode'
    //     ];
    // }

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function view(): View
    {
        return view('export.product', [
            'products' => $this->products
        ]);
    }
}
