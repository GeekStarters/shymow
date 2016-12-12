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
use App\Comment_post;
use App\Like_post;
use DateTime;
use App\Qualification_post;
use App\Perfil;
use App\Share_post;
use App\Follow_post;
use Input;
use Activity;
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
	public function deletePost($post){
		$getPost = Post::find($post);
		if (count($getPost) > 0) {
			if ($getPost->profil_id == Auth::id()) {
				Post::where('id',$post)->update(['active' => false]);
				flash('Post eliminado', 'success');
				return redirect()->back();
			}else{
				flash('Error al eliminar Post', 'danger');
				return redirect()->back();
			}

		}
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
	        return redirect('perfil')->withErrors($v, 'post')->withInput($request->all());
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

	public function getComment($id){
		$count = Comment_post::comments($id)->count();
		if ($count > 0) {
			$coments = DB::select('SELECT comment_posts.id AS id_comment,post_id,profil_id,description,comment_posts.active,perfils.name, perfils.id, perfils.img_profile, comment_posts.created_at FROM comment_posts INNER JOIN perfils ON comment_posts.profil_id = perfils.id WHERE comment_posts.post_id = '.$id.' and comment_posts.active = true ORDER BY id_comment ASC LIMIT 10 ');
			foreach ($coments as $comment) {
				$fecha= new DateTime($comment->created_at);
				$ahora= new DateTime(date("Y-m-d H:i:s"));
				$diferencia_dias= date_diff($fecha, $ahora);

				$anio = ((int)$diferencia_dias->format('%y'));
				$mes = ((int)$diferencia_dias->format('%m'));
				$dias = ((int)$diferencia_dias->format('%d'));
				$horas = ((int)$diferencia_dias->format('%h'));
				$minutos = ((int)$diferencia_dias->format('%i'));
				$segundos = ((int)$diferencia_dias->format('%s'));

				if ($anio > 0) {
					$tiempo = $anio." Años";
				}else{
					if ($mes > 0) {
						$tiempo = $mes." Meses";					
					}else{
						if ($dias > 0) {
							# code...
							$tiempo = $dias." Días";	
						}else{
							if ($horas > 0) {
								# code...
								$tiempo = $horas." Horas";	
							}else{
								if ($minutos > 0) {
									# code...
									$tiempo = $minutos." Min";	
								}else{
									if ($segundos > 0) {
										# code...
										$tiempo = $segundos." Sec";	
									}else{
										$tiempo = "0:00";	
									}
								}
							}
						}
					}
				}
				// dd($tiempo);
				echo '
				<div class="box-comment-data-content">
					<div class="box-coment-data-header">
						<a href=""><img style="width:50px;" src="'.url($comment->img_profile).'" alt="shymow"></a>
						<a href="">'.$comment->name.'</a> |
						<span>'.$tiempo.'</span>
					</div>
					<div class="box-coment-data-description">
						'.$comment->description.'
					</div>
				</div>
				';
			}

		}
	}
	public function createComment(Request $request, $id){
		if (isset($_POST['comment'])) {
			if ($_POST['comment'] != "") {
				$comment = $request->input('comment');

				$editPost = Post::find($id);
       
		        if (is_null ($editPost))
		        {
		            echo "Error";
		            exit();
		        }

		        $countPost= DB::select('SELECT * FROM `comment_posts` WHERE `post_id` = '.$id);
		        $countPost = count($countPost) + 1;

		        	$editPost->posts = $countPost;
		        $editPost->save();
			
				$newComment = new Comment_post();
					$newComment->post_id = $id;
					$newComment->profil_id = Auth::user()->id;
					$newComment->description = $comment;
				$newComment->save();

				$count = Comment_post::comments($id)->count();
				if ($count > 0) {
					$coments = DB::select('SELECT comment_posts.id AS id_comment,post_id,profil_id,description,comment_posts.active,perfils.name, perfils.id, perfils.img_profile, comment_posts.created_at FROM comment_posts INNER JOIN perfils ON comment_posts.profil_id = perfils.id WHERE comment_posts.post_id = '.$id.' and comment_posts.active = true ORDER BY id_comment ASC LIMIT 10 ');
					foreach ($coments as $comment) {
						$fecha= new DateTime($comment->created_at);
						$ahora= new DateTime(date("Y-m-d H:i:s"));
						$diferencia_dias= date_diff($fecha, $ahora);

						$anio = ((int)$diferencia_dias->format('%y'));
						$mes = ((int)$diferencia_dias->format('%m'));
						$dias = ((int)$diferencia_dias->format('%d'));
						$horas = ((int)$diferencia_dias->format('%h'));
						$minutos = ((int)$diferencia_dias->format('%i'));
						$segundos = ((int)$diferencia_dias->format('%s'));

						if ($anio > 0) {
							$tiempo = $anio." Años";
						}else{
							if ($mes > 0) {
								$tiempo = $mes." Meses";					
							}else{
								if ($dias > 0) {
									# code...
									$tiempo = $dias." Días";	
								}else{
									if ($horas > 0) {
										# code...
										$tiempo = $horas." Horas";	
									}else{
										if ($minutos > 0) {
											# code...
											$tiempo = $minutos." Min";	
										}else{
											if ($segundos > 0) {
												# code...
												$tiempo = $segundos." Sec";	
											}else{
												$tiempo = "0:00";	
											}
										}
									}
								}
							}
						}
						// dd($tiempo);
						echo '
						<div class="box-comment-data-content">
							<div class="box-coment-data-header">
								<a href=""><img style="width:50px;" src="'.url($comment->img_profile).'" alt="shymow"></a>
								<a href="">'.$comment->name.'</a> |
								<span>'.$tiempo.'</span>
							</div>
							<div class="box-coment-data-description">
								'.$comment->description.'
							</div>
						</div>
						';
					}

				}
			}
		}
	}

	public function createLike($post){
		$count_post = DB::select('SELECT * FROM posts WHERE active = true and id = '.$post);
		$user_id = Auth::user()->id;

		if (count($count_post)>0) {

			$like = DB::select('SELECT * FROM `like_posts` WHERE (`post_id` = '.$post.' and `profil_id` = '.$user_id.') and (`active` = true and `like` = true)');

			$like_edit = DB::select('SELECT * FROM `like_posts` WHERE (`post_id` = '.$post.' and `profil_id` = '.$user_id.') and (`active` = true and `like` = false)');

			if (count($like) < 1 and count($like_edit)<1) {
				$new_like = new Like_post();
					$new_like->like = true;
					$new_like->post_id = $post;
					$new_like->profil_id = $user_id;
				$new_like->save();

				$count_like = DB::select('SELECT * FROM like_posts WHERE post_id = '.$post.' and (like_posts.like = true and active = true)');

				$count_like = count($count_like);

				if ($count_like > 0) {
					$edit_post = Post::find($post);
						$edit_post->like = $count_like;
					try {
						$edit_post->save();
						echo "Like";
					} catch (Exception $e) {
						echo "error";
					}
				}
			}elseif (count($like_edit) > 0) {
				$like_id = $like_edit['0']->id;

				$edit_like = Like_post::find($like_id);
					$edit_like->like = true;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM like_posts WHERE post_id = '.$post.' and (like_posts.like = true and active = true)');

				$edit_post = Post::find($post);
					$edit_post->like = count( $count_like);
				try {
					$edit_post->save();
					echo "like";
				} catch (Exception $e) {
					echo "error";
				}
			}

			if (count($like) > 0) {
				$like_id = $like['0']->id;

				$edit_like = Like_post::find($like_id);
					$edit_like->like = false;
				$edit_like->save();

				$count_like = DB::select('SELECT * FROM like_posts WHERE post_id = '.$post.' and (like_posts.like = true and active = true)');

				$edit_post = Post::find($post);
					$edit_post->like = count($count_like);
				$edit_post->save();
				
				echo "like";
			}
		}
	}

	public function createQualification($post_id,$qualification){
		//user ID
		$user_id = Auth::user()->id;
		//Verificar si el usuario a calificado post
		$exists_user_active = Qualification_post::where('active',true)->where('post_id',$post_id)->where('profil_id',$user_id)->count();

		//Verifica si el usuario no ha calificado post
		$exists_user_false = Qualification_post::where('active',false)->where('post_id',$post_id)->where('profil_id',$user_id)->count();

		//Id user

		//Verificamos si existe post
		$post_exist = Post::where('active',true)->where('id',$post_id)->count();

		//Pasamos la puntuacion a un entero
		if (!empty($qualification)) {
			$qualification = (int) $qualification;
		}

		if ($post_exist > 0) {
			//Validamos que no exista calificacion

			if ($exists_user_active < 1 && $exists_user_false < 1) {
				//Si no existe calificacion del post por este usuario la creamos
				$newQualification = new Qualification_post();
					$newQualification->post_id = $post_id;
					$newQualification->profil_id = $user_id;
					$newQualification->qualification = $qualification;

				try {
					$newQualification->save();

					//Traemos todas las calificaciones
					$get_qualification_post = Qualification_post::where('active',true)
												->where('post_id',$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = Post::where('active',true)->where('id',$post_id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}

				// Si el usuario ya califico editamos esa misma calificacion
			}elseif ($exists_user_active > 0 && $exists_user_false < 1) {
				//Guardamos lo editado
				try {
					$qualification_edit = Qualification_post::where('active',true)->where('post_id',$post_id)->where('profil_id',$user_id)->update(['qualification' => $qualification]);

					//Traemos todas las calificaciones
					$get_qualification_post = Qualification_post::where('active',true)
												->where('post_id',$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);
					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = Post::where('active',true)->where('id',$post_id)->update(['qualification' => $media]);

						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}

				//Si el usuario habia calificado antes pero esta desactivada la activamos y editamos
			}elseif ($exists_user_active < 1 && $exists_user_false > 0) {
				try {
					$qualification_edit = Qualification_post::where('active',false)->where('post_id',$post_id)->where('profil_id',$user_id)->update(['qualification' => $qualification,'active' => true]);
					

					//Traemos todas las calificaciones
					$get_qualification_post = Qualification_post::where('active',true)
												->where('post_id',$post_id)->get();
					//Creamos un arreglo
					$stack_qualification = [];

					//Recorremos el arreglo
					foreach ($get_qualification_post as $data) {
						//Guardamos la calificacion en el arreglo
						array_push($stack_qualification, $data->qualification);
					}
					//Sacamos el promedio de las calificaciones
					$media = array_sum($stack_qualification)/count($stack_qualification);
					$media = round($media);

					try {
						//Guardamos la nueva calificacion de los posteos
							$saveNewQualificationPost = Post::where('active',true)->where('id',$post_id) ->update(['qualification' => $media]);
						//retornamos el promedio o el error
						return response()->json(['error' => false, 'qualification' => $media]);
					} catch (Exception $e) {
						return response()->json(['error' => true, 'description' => $e->getMessage()]);
					}
				} catch (Exception $e) {
					return response()->json(['error' => true, 'description' => $e->getMessage()]);
				}
			}
		}

	
	}


	public function sharePost($post_id,$user_id){
		$post_count = Post::where('id',$post_id)->where('active',true)->count();

		$user_count = Perfil::where('id',$user_id)->where('active',true)->count();

		$image_count = Images_post::where('post_id',$post_id)->where('active',true)->take(1)->count();

		if ($post_count < 1 || $user_count < 1) {
			return response()->json(['error' => true, 'message' => "Al parecer ocurrio un error"]);
		}

		if ($image_count>0) {
			$image = Images_post::where('post_id',$post_id)->where('active',true)->take(1)->get();
			$images = $image[0]->path;
			$images_id = $image[0]->id;
			$exist_image = true;
		}else{
			$images = null;
			$images_id = null;
			$exist_image = false;
		}
		$post = Post::where('id',$post_id)->where('active',true)->get();
		$user = Perfil::where('id',$user_id)->where('active',true)->get();
		$category = Category_post::all();
		$data_category = [];
		foreach ($category as $data) {
			array_push($data_category, ["id" => $data->id,"name" => $data->name]);
		}
		return response()->json(['error' => false,
								'message' => "Get post success",
								"post_description" => $post[0]->description,
								"post_id" => $post[0]->id,
								"user_name" => $user[0]->name,
								"img_profile" => $user[0]->img_profile,
								"user_id" => $user[0]->id,
								"image" => [
									"exists" => $exist_image,
									"path" => $images,
									"image_id" => $images_id
								],
								"category" => $data_category
								]);
		
	}

	public function createSharePost(Request $request){
		$validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/perfil')
                        ->withErrors($validator);
        }

        $post_id = (int)$request->input('post_id');
        $user_id =(int) $request->input('user_id');
        $new_description = $request->input('new_description');
        $category = (int)$request->input('category');
        $description = $request->input('description');

        $post_count = Post::where('id',$post_id)->where('active',true)->count();

		$user_count = Perfil::where('id',$user_id)->where('active',true)->count();

		$image_count = Images_post::where('post_id',$post_id)->where('active',true)->take(1)->count();


		if ($post_count < 1 || $user_count < 1) {
			return redirect('favoritos');
		}

		$newPost = new Post();
			$newPost->description = $new_description;
			$newPost->category_post_id = $category;
			$newPost->profil_id = Auth::user()->id;
		try {
			$newPost->save();

			$newShare = new Share_post();
				$newShare->post_id = $post_id;
				$newShare->profil_id = $user_id;
				$newShare->new_post_id = $newPost->id;
				$newShare->new_profil_id = Auth::user()->id;
				$newShare->description_old_post = $description;

			$newShare->save();

			$count_post_share = Share_post::where('post_id',$post_id)->where('active',true)->count();
			$saveNewShareCount = Post::where('active',true)->where('id',$post_id) ->update(['share' => $count_post_share]);

			return redirect('favoritos');
		} catch (Exception $e) {
			
		}
	}
	
	public function followPost(Request $request){
		$validator = Validator::make($request->all(), [
		    'post' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true]);
        }

        $id = $request->input('post');
        $countPostFollow = Follow_post::where('active',true)->where('post_id',$id)->where('perfil_id',Auth::user()->id)->count();

        $countPostFollowDesactive = Follow_post::where('active',false)->where('post_id',$id)->where('perfil_id',Auth::user()->id)->count();
        // dd($countPostFollow);
        if ($countPostFollow<1 && $countPostFollowDesactive < 1) {
        	$newFollow = new Follow_post();
        		$newFollow->perfil_id = Auth::user()->id;
        		$newFollow->post_id = $id;
        	try {
        		$newFollow->save();

        		return response()->json(['error' => false]);
        	} catch (Exception $e) {
        		return response()->json(['error' => true]);
        	}
        }elseif($countPostFollowDesactive > 0){
        	try {
				$editFollow = Follow_post::where('active',false)->where('post_id',$id)->where('perfil_id',Auth::user()->id)->update(["active" => true]);
				return response()->json(['error' => false]);      		
        	} catch (Exception $e) {
        		return response()->json(['error' => true]); 
        	}
        }else{
        	try {
				$editFollow = Follow_post::where('active',true)->where('post_id',$id)->where('perfil_id',Auth::user()->id)->update(["active" => false]);
				return response()->json(['error' => false]);      		
        	} catch (Exception $e) {
        		return response()->json(['error' => true]); 
        	}
        }
	}
}
