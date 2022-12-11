<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddToCartRequest;
use App\Http\Requests\UpdateAddToCartRequest;
use App\Models\AddToCart;

// When user click add to cart --> (store) --> when user reduce or increase product count on their add to cart--> (update)
// When user click delete --> delete();
// required --> user_id, product_id, count
//


class AddToCartController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(StoreAddToCartRequest $request)
    {
        //
    }

    public function show(AddToCart $id)
    {
        //
    }



    public function update(UpdateAddToCartRequest $request, $id)
    {
        //
    }

    public function destroy(AddToCart $id)
    {
        //
    }
}
