<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{   
    private $objUser;

    public function __construct()
    {
        $this->objUser = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {   
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ( Auth::user()->nivel == 1) {
                return view('dashboard');
            } else if ( Auth::user()->nivel == 2) { 
                if(Auth::user()->ativo){
                    return view('alunos.dashboard');
                } else {
                    return redirect()->back()->with('danger', 'Usuário inativo');        
                }
            }
        }else {
            return redirect()->back()->with('danger', 'E-mail ou senha inválida');
        }
    }

    public function home()
    {   
        return view('dashboard');
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
        //
    }

    public function logout()
    {
        Auth::logout();

        return view('welcome');
    }

}
