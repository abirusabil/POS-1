<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Label;
use App\Models\Product;
use App\Models\Purchase;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Auth;
use PhpExcelReader;
use Spreadsheet_Excel_Reader;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\countOf;

//use Spreadsheet_Excel_Reader;

require_once public_path('excel_reader.php');


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearLabel()
    {
        $data = Label::where('user_id', '=', Auth::user()->id)->get();

        foreach ($data as $s) {
            $s->delete();
        }


        return redirect()->back();
    }
    public function labelPrint(Request $request)
    {
        //        dd($request->all());
        $tmpData = [];
        $tmp = [];
        $as = 0;
        $name = $request->name;
        //        dd($request->qty );
        $qty = $request->qty;
        $unit_pirce = $request->unit_pirce;
        $ssd = 0;
        foreach ($request->qty as $a) {
            //            dd($a);
            $a = (int)$a;
            for ($i = 0; $i < $a; $i++) {
                $tmpData[$ssd] = $name[$as];
                $tmp[$ssd] = [
                    'qty' => $qty[$as],
                    'unit_pirce' => $unit_pirce[$as]
                ];
                $ssd++;
            }
            $as++;
        }

        //        dd($tmp[0]['qty']);

        view()->share([
            'tmpData' => $tmpData,
            'tmpas' => $tmp,
            'count' => count($tmpData),
            'convert' => $this->convertUSD()
        ]);



        return view('dashboard.printLabel');
    }

    public function actionLabel($id, $name, $price, Request $request)
    {
        //        dd('dwq');
        $data = new Label();
        $data->user_id = Auth::user()->id;
        $data->product_id = $id;
        $data->name = $name;
        $data->unit_pirce = $price;
        $data->save();

        return redirect()->back();
    }
    public function labelVariant(Request $request, $id)
    {
        if ($request->page == null || $request->page == '') {
            $page = '1';
        } else {
            $page = $request->page;
        }

        $woocommerce = $this->woocommerce();

        $array = $woocommerce->get('products/' . $id . '/variations');
        //        dd($array);

        $get = $woocommerce->get('products/' . $id);

        $a = $woocommerce->http->getResponse();

        $labels = Label::whereUserId(Auth::user()->id)->get();

        view()->share([
            'products' => $array,
            'labels' => $labels,
            'get' => $get
        ]);


        return view('dashboard.labelVariant');
    }
    public function label(Request $request)
    {
        if ($request->page == null || $request->page == '') {
            $page = '1';
        } else {
            $page = $request->page;
        }

        $woocommerce = $this->woocommerce();

        $array = $woocommerce->get('products?page=' . $page);

        $a = $woocommerce->http->getResponse();
        $headers = $a->getHeaders();
        $totalPages = $headers['x-wp-totalpages'];
        $total = $headers['x-wp-total'];
        // $current_page = '1';

        $array = new Paginator($array, $total, '10', $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // dd($array);
        //        dd($data);
        $labels = Label::whereUserId(Auth::user()->id)->get();

        view()->share([
            'products' => $array,
            'labels' => $labels
        ]);

        return view('dashboard.label');
    }

    public function index(Request $request)
    {
        //
        //        $exchangeRates = new ExchangeRate();
        //        return $exchangeRates->convert(100, 'GBP', 'EUR', Carbon::now());

        //        dd($this->woocommerce()->get('products'));
        if ($request->page == null || $request->page == '') {
            $page = '1';
        } else {
            $page = $request->page;
        }

        $woocommerce = $this->woocommerce();

        $array = $woocommerce->get('products?page=' . $page);

        $a = $woocommerce->http->getResponse();
        $headers = $a->getHeaders();
        $totalPages = $headers['x-wp-totalpages'];
        $total = $headers['x-wp-total'];
        // $current_page = '1';

        $array = new Paginator($array, $total, '10', $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // dd($array);
        //        dd($data);
        view()->share([
            'products' => $array,
            'convert' => $this->convertUSD()
        ]);
        // return $array;
        return view('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        dd('dqw');
        $categories = $this->woocommerce()->get('products/categories');
        $tags = $this->woocommerce()->get('products/tags');
        $data = null;
        $type = "";

        //        dd($categories);
        view()->share([
            'categories' => $categories,
            'tags' => $tags,
            'data' => $data,
            'type' => $type
        ]);
        return view('dashboard.products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //        if ()
        //        dd($request);
        // return $request->all();
        // $hitung = array_sum($request->jumlah_input);
        // return $hitung;
        $woocommerce = $this->woocommerce();


        $jenis_input = $request->size;
        $jumlah_input = $request->jumlah_input;
        //        $cari = $woocommerce->get('products?search='.$request->jenis_input[0]);
        //        dd($cari);

        //        dd(url('as'));
        $tmpUrl = [];
        $i = 0;
        // $input = '';
        //        dd($request->file('image'));
        if ($request->file('image')) {
            $files = $request->file('image');
            $name = rand(9999999, 1);
                $extension = $files->getClientOriginalExtension();
                $newName = $name . '.' . $extension;
                $input = 'wp-content/uploads/' . $newName;
                $files->move(public_path('upload'), $newName);
                $tmpUrl[$i++] = [
                    'src' => url($input)
            ];
            
            // foreach ($files as $file) {

            //     $name = rand(9999999, 1);
            //     $extension = $file->getClientOriginalExtension();
            //     $newName = $name . '.' . $extension;
            //     $input = 'upload/' . $newName;
            //     $file->move(public_path('upload'), $newName);
            //     $tmpUrl[$i++] = [
            //         'src' => url($input)
            //     ];
               
            // }
           
        }
        // return url($input);
        
        
        //        else{
        //            dd('file not found');
        //        }

        

        if ($request->type == '1') {
            $type = 'simple';
            //            dd($type);

            $data = [
                'name' => $request->name,
                'type' => $type,
                'sale_price' => $request->price_sale,
                'regular_price' => $request->price_modal,
                'short_description' => $request->dsc,
                'manage_stock' => 'true',
                'stock_quantity' => $request->quantity,
                'categories' => [
                    [
                        'id' => $request->category
                    ]
                ],
                // 'images' => $files,
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                    ]
                ]
            ];
            // return $data;

            $ls = $this->woocommerce()->post('products', $data);
        } else {

            //            dd('dwq');

            $type = 'simple';

            //            dd($type);

            $data = [
                'name' => $request->name,
                'type' => $type,
                'sale_price' => $request->price_sale,
                'regular_price' => $request->price_modal,
                'description' => $request->dsc,
                'short_description' => $request->dsc,
                'manage_stock' => 'true',
                'stock_quantity' => $request->quantity,
                'categories' => [
                    [
                        'id' => $request->category
                    ]
                ],
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                    ]
                ],
                'attributes' => array(
                    array(
                        'name' => 'Size',
                        'position' => 0,
                        'visible' => true, // default: false
                        'variation' => true, // default: false
                        'options' => $request->size
                    ),
                ),
                //                'price_html' => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>22</bdi></span>'
            ];
            // return $data;


            $ls = $this->woocommerce()->post('products', $data);
            // return $ls; 
            //            dd($ls);
            
            $datas = [
                'type' => 'variable'
            ];

           $woocommerce->put('products/' . $ls->id, $datas);
            //            dd($woocommerce->put('products/'.$ls ->id, $datas));
            

            $itung = count($request->size);


            //            dd($jenis_input);
            for ($i = 0; $i < $itung; $i++) {
                $random_number = fake()->randomNumber(9) . fake()->randomNumber(4);
                $tmps = $jenis_input[$i];


                $sku = "{$random_number}-0";
                if ($jenis_input[$i] = 's') {
                    $sku = "{$random_number}-1";
                } elseif ($jenis_input[$i] = 'm') {
                    $sku = "{$random_number}-2";
                } elseif ($jenis_input[$i] = 'l') {
                    $sku = "{$random_number}-3";
                } elseif ($jenis_input[$i] = 'xl') {
                    $sku = "{$random_number}-4";
                } elseif ($jenis_input[$i] = 'xxl') {
                    $sku = "{$random_number}-5";
                } elseif ($jenis_input[$i] = 'xxxl') {
                    $sku = "{$random_number}-6";
                }

                $dataVariant = [
                    'attributes' => [
                        [
                            'name' => 'Size',
                            'option' => $tmps

                        ]
                    ],
                    // 'regular_price' => $request->price,
                    // 'sale_price' => $request->price_sale,
                    'regular_price' => $request->price_modal,
                    'manage_stock' => 'true',
                    // 'stock_quantity' => (int) $jumlah_input[$i],

                    //                    'sku' => $sku
                ];
                
                //                dd($dataVariant);

                $woocommerce->post('products/' . $ls->id . '/variations', $dataVariant);
                


                //                sampe sini
            }
        }


        $new = new Product();

        $new->api_product_api = $ls->id;
        $new->price_modal = $request->price_modal;
        $new->price_sale = $request->price_sale;
        $new->barcode = $request->barcode;
        $new->save();






        return redirect()->route('products.index')->with('success', 'success edit data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $woocommerce = $this->woocommerce();

        $data = $woocommerce->get('products/' . $id);

        $sql = Product::where('api_product_api', '=', $id)->first();

        $categories = $this->woocommerce()->get('products/categories');
        $tags = $this->woocommerce()->get('products/tags');
        $type = $data != null ? $data != null && $data->type === "variable" : "";
        $attributes = $type ? $data->attributes[0]->options : "";

    // //    $S = $options[array_search('M', $options)];
    //     if (array_search('Z', $options) != null) {
    //         $S = "active";
    //     }else{
    //         $S = "oo";
    //     }
    //     // $S = array_search('Saa', $options);


        //        dd($categories);
        view()->share([
            'categories' => $categories,
            'tags' => $tags,
            'data' => $data,
            'sql' => $sql,
            'attributes' => $attributes,
            'type' => $type
            
        ]);
        // return $S;
        return view('dashboard.products.form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        dd($request->type);
        $woocommerce = $this->woocommerce();
        $cek = $woocommerce->get('products/' . $id);;
        $type = $cek->type;
        //        dd($cek);
        $jenis_input = $request->size;
        $jumlah_input = $request->jumlah_input;
        $tmpUrl = [];
        $i = 0;
        

        if ($request->file('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {

                $name = rand(9999999, 1);
                $extension = $file->getClientOriginalExtension();
                $newName = $name . '.' . $extension;
                $input = 'upload/' . $newName;
                $file->move(public_path('upload'), $newName);
                $tmpUrl[$i++] = [
                    'src' => url($input)
                ];
            }
        }


        if ($type == 'simple') {
            //            $type = 'simple';
            //            dd($type);

            $data = [
                'name' => $request->name,
                'type' => $type,
                'sale_price' => $request->price_sale,
                'regular_price' => $request->price_modal,
                'price' => $request->price_modal,
                // 'regular_price' => $request->price,
                'short_description' => $request->dsc,
                'manage_stock' => 'true',
                'stock_quantity' => $request->quantity,
                'categories' => [
                    [
                        'id' => $request->category
                    ]
                ],
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                    ]
                ]
            ];

            //            dd($data);
            //            $ls = $this->woocommerce()->post('products', $data);
            $ls = $this->woocommerce()->put('products/' . $id, $data);
        } else {

            $itung = count($request->size);
            $datas = [
                'type' => 'variable'
            ];

            $data = [
                'name' => $request->name,
                'type' => $type,
                'sale_price' => $request->price_sale,
                'regular_price' => $request->price_modal,
                'price' => $request->price_modal,
                'description' => $request->dsc,
                'short_description' => $request->dsc,
                'manage_stock' => 'true',
                'stock_quantity' => (int)$request->quantity,
                'categories' => [
                    [
                        'id' => $request->category
                    ]
                ],
                'images' => [
                    [
                        'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                    ]
                ],
                'attributes' => array(
                    array(
                        'name' => 'Size',
                        'position' => 0,
                        'visible' => true, // default: false
                        'variation' => true, // default: false
                        'options' => $jenis_input
                    ),
                ),
                //                'price_html' => '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>22</bdi></span>'
            ];
            // return $data;


            $ls = $this->woocommerce()->put('products/'.$id ,$data);

            //            dd($ls);

            

            $woocommerce->put('products/' . $ls->id, $datas);
            //            dd($woocommerce->put('products/'.$ls ->id, $datas));


            // $itung = count($request->jumlah_input);

            //            dd($jenis_input);
            for ($i = 0; $i < $itung; $i++) {

                $tmps = $jenis_input[$i];

                $sku = 'sku-0';
                if ($jenis_input[$i] = 'S') {
                    $sku = 'sku-1';
                } elseif ($jenis_input[$i] = 'M') {
                    $sku = 'sku-2';
                } elseif ($jenis_input[$i] = 'L') {
                    $sku = 'sku-3';
                } elseif ($jenis_input[$i] = 'XL') {
                    $sku = 'sku-4';
                } elseif ($jenis_input[$i] = 'XXL') {
                    $sku = 'sku-5';
                } elseif ($jenis_input[$i] = 'XXXL') {
                    $sku = 'sku-6';
                }

                $dataVariant = [
                    // 'attributes' => [
                    //     [
                    //         'name' => 'Size',
                    //         'option' => $tmps
                    //     ]
                    // ],
                    'regular_price' => $request->price_modal,
                    // 'manage_stock' => 'true',
                    // 'sku' => $sku
                    // 'stock_quantity' => (int) $jumlah_input[$i],
                    //                    'sku' => $sku
                ];
                //                dd($dataVariant);

                $woocommerce->put('products/'.  $id  .'/variations/' . $ls->id , $dataVariant);
                


                //                sampe sini
            }
        }


        $new = Product::where('api_product_api', '=', $id)->first();

        $new->price_modal = $request->price_modal;
        $new->price_sale = $request->price_sale;
        $new->barcode = $request->barcode;
        $new->save();
        // 'sale_price' => $request->price_sale,
        //         'regular_price' => $request->price_modal,

        return redirect()->route('products.index')->with('success', 'success edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->woocommerce()->delete('products/' . $id, ['force' => true]);
        return redirect()->route('products.index');
    }

    public function import()
    {
        //        dd('dwqdqw');
        //        return;
        return view('dashboard.products.import');
    }

    public function importAction(Request $request)
    {

        // menangkap file excel
        //        $file = $request->file('file');
        //
        ////        dd($file);
        //        // membuat nama file unik
        //        $nama_file = rand().$file->getClientOriginalName();
        //
        //        // upload ke folder file_siswa di dalam folder public
        //        $file->move('file_import',$nama_file);

        $excel = new PhpExcelReader;
        //        $excel->read(public_path('file_import/'.$nama_file)); //yg asli
        $excel->read(public_path('file_import/1499938663test.xls'));
        //        dd($excel->sheets[0]);
        $sheet = $excel->sheets[0];
        $numRows = $sheet['numRows'];
        $numCols = 11;

        $starRows = 5;
        $sc = isset($sheet['cells'][3][13]) ? $sheet['cells'][3][13] : '';

        for ($z = 1; $z <= $sc; $z++) {
            for ($i = $starRows; $i <= $numRows; $i++) {
                $cekz = isset($sheet['cells'][$i][1]) ? $sheet['cells'][$i][1] : '';
                //                dd($cekz);
                if ($z == $cekz) {
                    for ($y = 1; $y <= $numCols; $y++) {
                        $cell = isset($sheet['cells'][$i][$y]) ? $sheet['cells'][$i][$y] : '';
                        if ($cell == '' || $cell == null) {
                            $cell = 'null';
                        }

                        //ngodingnya disini

                        echo $cell . ' ';
                    }
                }
                echo '<br>';
            }
            //            return;
        }



        return;
        //        dd($numCols);
    }

    public function export()
    {
        $woocommerce = $this->woocommerce();
        $array = $woocommerce->get('products');

        return Excel::download(new ProductsExport($array), 'products.csv');
    }

    public function purchase()

    {
        $woocommerce = $this->woocommerce();
        $products = $woocommerce->get("products/");
        // return $products;
        return view('dashboard.Purchases.purchase', compact('products'));
    }

    public function updatepurchase(Request $request)
    {
        // return $request->all();
        // return [$request->all(), $id, $request->qty + $request->old_qty];
        $data = [
            'stock_quantity' => $request->qty + $request->old_qty
        ];

        $userId = Auth::id();
        

        $data2 = [
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'name' => $request->name,
            'image' => $request->image,
            'qty' => $request->qty,
            'size' => $request->size,
            'price_modal' => $request->price_modal,
            'total_price' => $request->qty * $request->price_modal


        ];

        $woocommerce = $this->woocommerce();
        $woocommerce->put("products/$request->product_id", $data);
        Purchase::create($data2);

        return redirect()->back();
    }

    public function listpurchases(Request $request)
    {
        
        if ($request->start == null) {
            $purchases = Purchase::get();
        } else {
            $from = date($request->start);
            $to = date('Y-m-d',strtotime('+1 days', strtotime( $request->end)));
            $purchases = Purchase::whereBetween('created_at', [$from, $to])->get();   
        }
        view()->share([
            'purchases' => $purchases,
        ]);
        return view('dashboard.Purchases.listpurchases');
    }
    
}
