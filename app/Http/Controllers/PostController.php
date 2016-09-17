<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category_post;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Trend;
use App\Post;
use App\Post_trend;
use App\Images_post;
use DB;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$post = $request->all();
		$messages = [
		    'required'    => 'Rellene los campos solicitados',
		    'digits_between'    => 'Seleccione un item de la lista',
		    'mimes'    => 'Formao no valido',
		];
		$v = Validator::make($post, [
			'description' => 'required',
			'category' => 'required|digits_between:1,7',
			'img' => 'mimes:jpeg,gif,png',
	    ],$messages);

	    if ($v->fails())
	    {	
	        return redirect('perfil')->withErrors($v, 'post')->withInput(Input::all());
	    }

	    $searchTrends = explode(' ', $request->input('description'));
	    $trends = [];
	   	for ($i=0; $i <count($searchTrends); $i++) { 
	   		$object = $searchTrends[$i];
	   		if (strlen($object) > 1) {
	   			$cadena = strstr($object, '#');
				if (strlen($cadena) > 1) {
					$trend = substr($cadena, 1 , strlen($cadena));
					array_push($trends, $trend);
				}
	   		}
	   	}
	    // dd($trends);
	    try {
	    	$newPost = new Post($post);
		    	$newPost->category_post_id = $request->input('category');
		    	$newPost->profil_id = Auth::user()->id;
		    	$newPost->qualification = 0;
		    	$newPost->share = 0;
		    	$newPost->like = 0;
		    $newPost->save();

		    if ($request->hasFile('img'))
			{
				if ($request->file('img')->isValid())
				{
				    $file = $request->file('img');
				    $fileName  = time() . '-' . $file->getClientOriginalName();
				    $destinationPath = 'img/post/';
				    $request->file('img')->move($destinationPath, $fileName);
				    $fullDestinationPath = $destinationPath.$fileName;

				    $newImage = new Images_post();
				    	$newImage->post_id = $newPost->id;
				    	$newImage->name = $fileName;
				    	$newImage->path = $fullDestinationPath;
				    $newImage->save();
				}
			}

			if (count($trends) > 0) {
				function relationPostTrend($post,$trend){
					$newRelation = new Post_trend();
						$newRelation->post_id = $post;
						$newRelation->trend_id = $trend;
					$newRelation->save();
				}
				foreach ($trends as $trend) {
					$viewTrend = DB::select('SELECT * FROM trends WHERE name = "'.$trend.'"');
					if (count($viewTrend) < 1) {
						$newTrends = new Trend();
							$newTrends->name = $trend;
						$newTrends->save();	

						relationPostTrend($newPost->id,$newTrends->id);
					}else{
						relationPostTrend($newPost->id,$viewTrend[0]->id);
					}
				}
			}


	    	return redirect('perfil');
	    } catch (Exception $e) {
	    	Redirect::back()->with('error', $e->getMessage());
	    }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
