<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiffView extends Controller
{


	public function show(int $first_comment_id, int $second_comment_id){

		$text1 = 'This is some text';
		$text2 = 'this is also text';

		$comment_left = \App\comment::find($first_comment_id);
		$text1 = nl2br($comment_left->simplified_comment_text);
		
		$comment_right = \App\comment::find($first_comment_id);
		$text2 = nl2br($comment_right->simplified_comment_text);

		return view('viewdiff.show',[
			'left_text' => $text1,
			'right_text' => $text2
			]);


	}


}



