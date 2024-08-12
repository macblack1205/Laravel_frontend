<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller{

    public function index($id){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You need to be logged in to view the product.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('http://host.docker.internal/api/posts/' . $id);
        if (!$response->successful()) {
            $errorMessage = $response->json()['message'];
            return back()->with('fail', $errorMessage);
        }

        $post = $response->json();
        return view('post.view', compact('post'));
    }




    public function create(Request $request){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You need to be logged in to view the product.');
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://host.docker.internal/api/posts', [
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($response->successful()) {
            $successMessage = $response->json()['message'];
            return redirect()->back()->with('success', $successMessage);
        }

        $errorMessage = $response->json()['message'];
        return back()->with('fail', $errorMessage);
    }


    public function update(Request $request, $post){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You need to be logged in to view the product.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://host.docker.internal/api/posts/' . $post, [
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        if ($response->successful()) {
            $successMessage = $response->json()['message'];
            return redirect()->back()->with('success', $successMessage);
        }

        $errorMessage = $response->json()['message'];
        return back()->with('fail', $errorMessage);
    }



    public function delete($id){  //deleteFunction
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You need to be logged in to view the product.');
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('token'),
        ])->delete('http://host.docker.internal/api/posts/' . $id);

        if ($response->successful()) {
            $successMessage = $response->json()['message'];
            return redirect()->route('dashboard')->with('success', $successMessage);
        }

        $errorMessage = $response->json()['message'];
        return back()->with('fail', $errorMessage);
    }
}


