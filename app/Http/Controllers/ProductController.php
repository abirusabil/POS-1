<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

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
            'products' => $array
        ]);
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

        //        dd($categories);
        view()->share([
            'categories' => $categories,
            'tags' => $tags
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
        $woocommerce = $this->woocommerce();


        $jenis_input = $request->jenis_input;
        $jumlah_input = $request->jumlah_input;
//        $cari = $woocommerce->get('products?search='.$request->jenis_input[0]);
//        dd($cari);

        if ($request->file('image')){

//            $validates = [
//                'long_question'  => 'mimes:mp3,ogg | max:20000'
//            ];
//            $request->validate($validates);

            $file = $request->file('image');

            $name = rand(9999999,1);
            $extension = $file->getClientOriginalExtension();
            $newName = $name.'.'.$extension;
            $input = 'upload/'.$newName;
            $request->image->move(public_path('upload'), $newName);
        }else{
            dd('upload file');
        }


        if ($request->type == '1'){
            $type = 'simple';
//            dd($type);

            $data = [
                'name' => $request->name,
                'type' => $type,
                'price' => $request->price,
                'regular_price' => $request->price,
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

            $ls = $this->woocommerce()->post('products', $data);

        }else{

//            dd('dwq');

            $type = 'simple';

//            dd($type);

            $data = [
                'name' => $request->name,
                'type' => $type,
                'regular_price' => $request->price,
                'price' => $request->price,
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


            $ls = $this->woocommerce()->post('products', $data);

//            dd($ls);

            $datas = [
                'type' => 'variable'
            ];

            $woocommerce->put('products/'.$ls ->id, $datas);
//            dd($woocommerce->put('products/'.$ls ->id, $datas));


            $itung = count($request->jumlah_input);

//            dd($jenis_input);
            for ($i = 0 ; $i<$itung; $i++){

                $tmps = $jenis_input[$i];

                $sku = 'sku-0';
                if ($jenis_input[$i] = 's'){
                    $sku = 'sku-1';
                }elseif ($jenis_input[$i] = 'm'){
                    $sku = 'sku-2';
                }elseif ($jenis_input[$i] = 'l'){
                    $sku = 'sku-3';
                }elseif ($jenis_input[$i] = 'xl'){
                    $sku = 'sku-4';
                }elseif ($jenis_input[$i] = 'xxl'){
                    $sku = 'sku-5';
                }elseif ($jenis_input[$i] = 'xxxl'){
                    $sku = 'sku-6';
                }

                $dataVariant = [
                    'attributes' => [
                        [
                            'name' => 'Size' ,
                            'option' => $tmps
                        ]
                    ],
                    'regular_price' => $request->price,
                    'manage_stock' => 'true',
                    'stock_quantity' => (int) $jumlah_input[$i],
//                    'sku' => $sku
                ];
//                dd($dataVariant);

                $woocommerce->post('products/'.$ls->id.'/variations', $dataVariant);


//                sampe sini
            }


        }


        $new = new Product();

        $new->api_product_api = $ls->id;
        $new->price_modal = $request->price_modal;
        $new->price_sale = $request->price;
        $new->barcode = $request->barcode;
        $new->save();





        return redirect()->route('products.index')->with('success','success edit data');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //        return;
        $data = $this->woocommerce()->delete('products/' . $id, ['force' => true]);

        return redirect()->route('products.index');
        //        dd($data);
    }

    public function import()
    {
        dd('dwqdqw');
        return;
        //        return view('dashboard.products.import');
    }
}
