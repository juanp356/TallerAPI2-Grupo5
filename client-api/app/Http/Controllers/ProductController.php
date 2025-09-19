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
    $url = env('URL_BASE_API', "https://dummyjson.com");
    $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/products');

    if ($response->successful()) {
      $products = $response->json()['products'];

      return view('product.index', compact('products'));
    } else {
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
  public function store(Request $request)
  {
    $url = env('URL_BASE_API', "https://dummyjson.com");

    $response = Http::acceptJson()->withToken(Session::get('token'))->post($url . '/products/add', [
      'title' => $request->title,
      'description' => $request->description,
      'price' => $request->price,
      'stock' => $request->stock,
      'images' => $request->images
    ]);

    /*
      Está linea de abajo es para que se vea la respuesta de la API en formato JSON
      Al crear un nuevo producto. (Testearla para saber como funciona)

      IMAGE URL PARA CREAR UN PRODUCTO DE PRUEBA: https://i.dummyjson.com/data/products/1/1.jpg
      Si quiere testearlo descomente la línea.
    */
    //dd($response->json());

    if ($response->successful()) {
      session()->flash('message', 'Producto creado exitosamente');
      return redirect()->route('product.index');
    } elseif ($response->status() == Response::HTTP_BAD_REQUEST) {
      $errors = $response->json()['errors'];
      return redirect()->route('product.create')->withInput()->withErrors($errors);
    } else {
      abort($response->status());
    }
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $url = env('URL_BASE_API', "https://dummyjson.com");
    $response = Http::acceptJson()->withToken(Session::get('token'))->get($url . '/products/' . $id);

    if ($response->successful()) {
      $product = $response->json();
      return view('product.edit', compact('product'));
    } elseif ($response->status() == Response::HTTP_BAD_REQUEST) {
      $errors = $response->json()['errors'];
      return redirect()->route('product.index')
        ->withInput()->withErrors($errors);
    } else {
      abort($response->status());
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $url = env('URL_BASE_API', "https://dummyjson.com");
    $response = Http::acceptJson()->withToken(Session::get('token'))->put($url . '/products/' . $id, [
      'id' => $request->id,
      'title' => $request->title,
      'description' => $request->description,
      'price' => $request->price,
      'category' => $request->category,
      'stock' => $request->stock,
      'images' => [$request->images],
    ]);

    if ($response->successful()) {
      /*
      Lo mismo que en el método store, para ver la respuesta y actualización
      del producto en formato JSON. Si quiere testearlo descomente la línea.
      */
      //dd($response->json());
      session()->flash('message', 'Producto actualizado exitosamente');
      return redirect()->route('product.index');
    } elseif ($response->status() == Response::HTTP_BAD_REQUEST) {
      $errors = $response->json()['errors'];
      return redirect()->route('product.edit', $id)
        ->withInput()->withErrors($errors);
    } else {
      abort($response->status());
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $url = env('URL_BASE_API', "https://dummyjson.com");

    $response = Http::acceptJson()
      ->withToken(Session::get('token'))
      ->delete($url . '/products/' . $id);

    if ($response->successful()) {
      /*ver la respuesta del API
        Si quiere testearlo descomente la línea.
        */
      //dd($response->json());

      session()->flash('message', 'Producto eliminado exitosamente');
      return redirect()->route('product.index');
    } elseif ($response->status() == Response::HTTP_BAD_REQUEST) {
      $errors = $response->json()['errors'] ?? ['No se pudo eliminar el producto'];
      return redirect()->route('product.index')
        ->withErrors($errors);
    } else {
      abort($response->status());
    }
  }
}
