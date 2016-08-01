<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Review;
use Request;
use Auth;
class ReviewsController extends Controller
{
	public function store()
	{
		if(!Auth::check())
		{
			return 'Please login for creating review';
		}
		else
		{
			$title=Request::get('title');
			$existTitle=Review::select('title')->where('title',$title)->first();
			//var_dump($existTitle);
			if(isset($existTitle))
			{
				return 'Title has been existed, please fill another one';
			}
			else
			{
				Review::create([
					'title' => $title,
					'content' => Request::get('content'),
					'tags' => Request::get('tags'),
					'place_id' => Request::get('place_id'),
					'user_id' => Auth::user()->id
				]);
				return 'Create Review Success';
			}
		}
	}
	public function best($place_id)
	{
		$bestReviews=Review::select(['id','title','votes'])
							->where('place_id',$place_id)
							->orderBy('votes', 'desc')
               				->take(5)
               				->get()
               				->toArray();
         return $bestReviews;
	}
}
