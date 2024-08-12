<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //---------------page requests
    public function homepage(){
        return view("home");
    }
    public function loginpage(){
        return view("login");
    }
    public function registerpage(){
        return view("register");
    }
    public function dashboard(){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You must be logged in to view this page.');
        }
        $token = session('token');
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://host.docker.internal/api/user');
    
        if (!$userResponse->successful()) {
            return redirect()->route('login')->with('fail', 'Failed to retrieve user info.');
        }
    
        $user = $userResponse->json();
        $postsResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://host.docker.internal/api/posts');
    
        if (!$postsResponse->successful()) {
            return redirect()->route('login')->with('fail', 'Failed to retrieve posts.');
        }    
        $posts = $postsResponse->json();
    
        return view('dashboard', compact('posts'));
    }
    

    public function profile(){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('fail', 'You must be logged in to view this page.');
        }
    
        $token = session('token');
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://host.docker.internal/api/user');
    
        if (!$userResponse->successful()) {
            return redirect()->route('login')->with('fail', 'Failed to retrieve user info.');
        }
    
        $user = $userResponse->json();
    
        return view('user.view', compact('user'));
    }
    


    public function login(Request $request) {
        $response = Http::post('http://host.docker.internal/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $responseData = $response->json();
        if ($response->successful()) {
            session(['user' => $responseData['data']['user']]);
            session(['token' => $responseData['data']['token']]);
            return redirect()->route('dashboard')->with('success', $responseData['message']);
        }

        if ($response->status() == 422) {
            return redirect()->back()->withErrors($responseData['errors'])->withInput();
        }

        return redirect()->back()->with('fail', $responseData['message']);
    }


    public function logout(Request $request){
        $user = Auth::user();
        $token = $request->session()->get('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://host.docker.internal/api/user/logout');
    
        if ($response->successful()) {
            $responseData = $response->json();
            Auth::logout();
            session()->flush();
            $request->session()->forget('token');
            return redirect()->route('login')->with('success', $responseData['data']['message']);
        }
        $responseData = $response->json();
        
        return back()->with('fail', $responseData['data']['message']);
    }
    
    public function register(Request $request) {
        $response = Http::post('http://host.docker.internal/api/register', [
            'first' => $request->first,
            'last' => $request->last,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
    
        $responseData = $response->json();

        if ($response->successful()) {
            return redirect()->route('login')->with('success', $responseData['message']);
        }
        if ($response->status() == 422) {
            return redirect()->back()->withErrors($responseData['errors'])->withInput();
        }
        return redirect()->back()->with('fail', $responseData['message']);
    }  


    
    public function edit(Request $request, $id){
        if (!session()->has('token')) {
            return redirect()->route('login')->with('error', 'You need to be logged in to view the profile.');
        }
        
        $token = session('token');
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://host.docker.internal/api/user/edit/' . $id, [
            'first' => $request->input('first'),
            'last' => $request->input('last'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
        ]);
    
        if ($response->successful()) {
            session(['user' => $response['data']['user']]);
            $successMessage = $response->json()['message'];
            return redirect()->route('profile')->with('success', $successMessage);
        }
        
        if ($response->status() == 422) {
            return redirect()->back()->withErrors($response->json()['errors'])->withInput();
        }
        $errorMessage = $response->json()['message'];
        return back()->with('fail', $errorMessage);
    }
    
    
    
    public function delete(Request $request) {
        if (!session()->has('token')) {
            return redirect()->route('login')->with('error', 'You need to be logged in to delete your account.');
        }
    
        $token = session('token');
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('http://host.docker.internal/api/user/delete');
    
        if ($response->successful()) {
            $successMessage = $response->json()['message'] ?? 'User account deleted successfully';
            $request->session()->forget('token');
            Auth::forgetUser();
            session()->flush();
            $request->session()->forget('token');
            return redirect()->route('home')->with('success', $successMessage);
        }
    
        $errorMessage = $response->json()['error'] ?? 'An error occurred';
        return back()->with('error', $errorMessage);
    }
    
    
}
