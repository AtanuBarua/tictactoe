<?php

namespace App\Http\Controllers;

use App\Models\MatchHistory;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index(){
        $matches = MatchHistory::all();
        return view('home',compact('matches'));
    }
    public function endGame(Request $request){
        $match = new MatchHistory();
        $match->player1 = $request->player1;
        $match->player2 = $request->player2;
        if ($request->winner == 0) {
            $match->winner = 'Tie';
        }
        elseif ($request->winner == 1) {
            $match->winner = $request->player1;
        }
        else{
            $match->winner = $request->player2;
        }
        $match->save();
        $match = MatchHistory::latest()->first();
        return response()->json($match);
    }
}
