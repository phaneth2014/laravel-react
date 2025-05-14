<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('user')->with('category')->latest()->get();
    	return response([
        	'Items' => $items
        ],200);

    }

	public function getitems()
    {
    	$items = Item::with('user')->with('category')->latest()->get();
    	return response([
        	'Items' => $items
        ],200);
    }

	public function pick_item(Request $request)
    {
    	$barcode = $request->barcode;
    	$search = $request->search;
    	$item=[];
    	if($barcode){
    		$items = Item::whereBarcode($barcode)->get();
        }elseif($search){
        	$items = Item::where('item','LIKE',"%$search%")->get();
        }else{
        	$items = Item::latest()->get();
        }
    	return response([
        	'items' => $items
        ],200);


    }

	public function store_item(Request $request)
    {

    	 $validator = Validator::make($request->all(), [
            'item' => 'required',
        	'barcode' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

    	$item = Item::whereBarcode($request->barcode)->first();

    	if($item){
        	return response([
        		'message' => 'មុខទំនិញមួយបញ្ចូលរួចហើយ',
        	],404);
        }



    	$data = Item::create([
        	'cate_id' => $request->cate_id,
        	'user_id' => auth()->id(),
        	'item' => $request->item,
        	'price' => $request->price,
        	'barcode' => $request->barcode
        ]);

    	$items = Item::with('user')->with('category')->latest()->get();

    	return response([
        	'message' => $items,
        ],201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
