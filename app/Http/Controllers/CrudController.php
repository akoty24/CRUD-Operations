<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\offer;

class CrudController extends Controller
{
    public function create()
    {
        return view('offers.create');
    }
    public function store(offerRequest $request){
            $offer =new offer();
            $offer->name=request('name');
            $offer->price=request('price');
            $offer->details=request('details');
            $offer->save();
            return redirect()->back()->with(['success' =>'added successfuly']);
    }
    public function getAllOffers()
    {

        $offers = offer::all();

        return view('offers.all',compact('offers'));

    }
    public function edit($id){

        $offer = offer::select('id', 'name','details','price')->find($id);  // search in given table id only
        if (!$offer)
            return redirect()->back();

        return view('offers.edit', compact('offer'));


    }
    public function update(offerRequest $request,$id){

        $offer = offer::find($id);  // search in given table id only
        if (!$offer)
            return redirect()->back();

        else

            $offer->name=request('name');
        $offer->price=request('price');
        $offer->details=request('details');
        $offer->save();
        return redirect(route('all offers'))->with(['success' =>'added successfuly']);
    }
    public function delete($id){

        $offer = offer::find($id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return redirect()
            ->route('all offers')
            ->with(['success' => __('messages.offer deleted successfully')]);

    }
}
 