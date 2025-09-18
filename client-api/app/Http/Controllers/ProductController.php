<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $url = env('URL_BASE_API',"https://dummyjson.com");
            $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/products');
              if($response->successful())
              {
                $products = $response->json();
                return view('product.index', compact('products'));
              } 
              else
              {
                abort($response->status());
              }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $url = env('URL_BASE_API',"https://dummyjson.com");
            $response = Http::acceptJson()->withToken(Session::get('token'))->post($url . '/products/'.$id,[
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'images' => $request->images
            ]);

              if($response->successful()){
                  session()->flash('message','Registro creado exitosamente');
                 return redirect()->route('product.index');

              }
              elseif($response->status() == Response::HTTP_BAD_REQUEST)
              {
                $errors = $response->json()['errors'];
                return redirect()->route('product.create')
                ->withInput()->withErrors($errors);
              } 
              else
              {
                abort($response->status());
              }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $url = env('URL_BASE_API',"https://dummyjson.com");
            $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/products/'. $id);

           if($response->successful())
            {
                $product = $response->json();
                return view('product.edit', compact('product'));
            }
            elseif($response->status() == Response::HTTP_BAD_REQUEST)
              {
                $errors = $response->json()['errors'];
                return redirect()->route('product.index')
                ->withInput()->withErrors($errors);
              } 
              else
              {
                abort($response->status());
              }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $url = env('URL_BASE_API',"https://dummyjson.com");
            $response = Http::acceptJson()->withToken(Session::get('token'))->put($url . '/products/'.$id,[
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'images' => $request->images
            ]);

              if($response->successful()){
                  session()->flash('message','Registro actualizado exitosamente');
                 return redirect()->route('product.index');

              }
              elseif($response->status() == Response::HTTP_BAD_REQUEST)
              {
                $errors = $response->json()['errors'];
                return redirect()->route('product.edit')
                ->withInput()->withErrors($errors);
              } 
              else
              {
                abort($response->status());
              }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $url = env('URL_BASE_API',"https://dummyjson.com");
            $response = Http::acceptJson()->withToken(Session::get('token'))->delete($url . '/products/'.$id);

              if($response->successful()){
                  session()->flash('message','Registro eliminado exitosamente');
                 return redirect()->route('product.index');

              }
              elseif($response->status() == Response::HTTP_BAD_REQUEST)
              {
                $errors = $response->json()['errors'];
                return redirect()->route('product.index')
                ->withInput()->withErrors($errors);
              } 
              else
              {
                abort($response->status());
              }
    }
}
