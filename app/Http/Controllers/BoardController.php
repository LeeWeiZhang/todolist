<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\TaskList;
use App\Task;
use Log;

class BoardController extends Controller
{
	private $_board_id = 0;

	public function __construct($board_id = 0)
    {
		$this->middleware('auth');
	}

    public function show($board_id)
    {
    	$this->_board_id = $board_id;
    	$MyBoard = Board::find($board_id);

    	return view('board', ['board' => $MyBoard, 'lists' => $this->_get_my_tasklist()]);
    }

    public function board_list(Request $request) 
    {
    	$this->_board_id = $request->input('board_id') ?? 0;

        if ($request->has('listname') && $request->has('board_id')) {
            $MyTaskList = new TaskList();
            $MyTaskList->name = $request->input('listname');
            $MyTaskList->boards()->associate($this->_board_id);
            $MyTaskList->save();
        }

        return response()->json($this->_get_my_tasklist());
    }

    private function _get_my_tasklist()
    {
        return TaskList::with('task')->where('board', $this->_board_id)->get();
    }
}
