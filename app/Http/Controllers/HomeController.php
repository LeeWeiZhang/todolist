<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Board as Board;
use App\User as User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['boards' => $this->get_my_boards()]);
    }

    public function board( Request $request ) 
    {
        if ($request->isMethod('post') && $request->has('name')) {
            $board = new Board();
            
            $board->name = $request->input('name');
            $board->user()->associate(Auth::user());

            $board->save();
        }

        return response()->json($this->get_my_boards());
    }

    private function get_my_boards() {
        return Board::all()->where('owner', Auth::user()->id);
    }
}
