<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Post;
use App\Images_post;
use App\Category_post;
use App\Trend;
use App\Like_post;
use App\Friend;
use App\Perfil;
use App\Empresa;
use App\Celebritie;
use App\Countrie;
use Auth;
use Illuminate\Http\Request;
use Validator;
use OpenGraph;
class InsideController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function amigos()
	{
		//ID this user
		$id = Auth::user()->id;
		//Stack users
		$user_contents = [];
		//ID all my friends
		$friends = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 1');
		//If i had more than one friends
		if (count($friends) > 0) {
			// I get each users
			foreach ($friends as $friend) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($friend->user1 == $id)
					//Add value to user_id of another user
					$user_id = $friend->user2;
				else
					//If not add value user_id this user
					$user_id = $friend->user1;

				//let's search a user active
				$user = Perfil::select('*','perfils.id as user_id')
								->leftJoin('empresas','empresas.profile_id','=','perfils.id')
								->leftJoin('celebrities','celebrities.profile_id','=','perfils.id')
								->where('perfils.id',$user_id)
								->where('perfils.active',true)
								->first();
				//If return user is more than one and less than two
				if (count($user)>0 && count($user) < 2) {
					array_push($user_contents, $user);
				}
			}
		}
			$alias = '';
		$paises = [];
		$provincias = [];
		$estados = [];
		$buildings = [];
		$empresa=[];
		$builds = [];
		$celebritie = [];
		if (Auth::user()->role == 2) {
			$buildings = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
			if(count($buildings) > 0){
				$empresa = DB::table('empresas')
				->where('profile_id',Auth::id())->first();
			}
		}
		if (Auth::user()->role == 1) {
			$celebridad = Celebritie::where('profile_id',Auth::id())->where('active',true)->get();
			if (count($celebridad) > 0) {
				$celebritie = Celebritie::where('profile_id',Auth::id())->first();
			}
		}
		// dd($user_contents);
		$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];
		$countries = Countrie::lists('name','id');
		return view('logueado.amigos',compact('user_contents','empresa','celebritie','countries','socialNet'));
	}
	public function favorites(){
		//ID this user
		$id = Auth::user()->id;
		//ID all my friends
		$post = "";
		$post_content = [];
		$friends = DB::select('SELECT * FROM friends WHERE (user1 = '.$id.' OR user2 = '.$id.') AND status = 1');
		//If i had more than one friends
		if (count($friends) > 0) {
			// I get each users
			foreach ($friends as $friend) {
				//declare a variable ID user
				$user_id = "";

				//If this user is equal to ID
				if ($friend->user1 == $id)
					//Add value to user_id of another user
					$user_id = $friend->user2;
				else
					//If not add value user_id this user
					$user_id = $friend->user1;

				//Let's all post of each user
				$posts = DB::select('SELECT perfils_friend.img_profile as imagen_perfil_friend,perfils_friend.name AS friend_name, perfils_friend.id as user_id_friend,user_shares.user_id as friend, user_shares.new_post_id as friend_post, posts.posts,posts.category_post_id, posts.id as id_post, images_posts.post_id as image_post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile , like_posts.post_id, like_posts.profil_id as userLike,posts.profil_id as id_user, like_posts.like as likeLike, like_posts.active as likeActive, follow_posts.active as follow,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator,image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active,empresas.alias, empresas.responsable, celebrities.apodo FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.$id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.$id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id  LEFT JOIN user_shares ON user_shares.new_post_id = posts.id LEFT JOIN perfils AS perfils_friend ON perfils_friend.id = user_shares.user_id LEFT JOIN empresas ON empresas.profile_id = perfils.id LEFT JOIN celebrities ON celebrities.profile_id = perfils.id WHERE posts.active = true AND perfils.id = "'.$user_id.'" GROUP BY posts.id ORDER BY posts.created_at DESC LIMIT 15');

				//If return user is more than one and less than two
				if (count($posts)>0) {
					foreach ($posts as $post) {
						array_push($post_content, $post);
					}
				}
			}
		}
		//add Post this user
		$posts = DB::select('SELECT perfils_friend.img_profile as imagen_perfil_friend,perfils_friend.name AS friend_name, perfils_friend.id as user_id_friend,user_shares.user_id as friend, user_shares.new_post_id as friend_post,posts.posts,posts.category_post_id, posts.id as id_post, images_posts.post_id as image_post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile , like_posts.post_id, like_posts.profil_id as userLike, like_posts.like as likeLike, like_posts.active as likeActive,posts.profil_id as id_user,follow_posts.active as follow,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator, image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active,empresas.alias, empresas.responsable, celebrities.apodo FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.$id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id  LEFT JOIN user_shares ON user_shares.new_post_id = posts.id LEFT JOIN perfils AS perfils_friend ON perfils_friend.id = user_shares.user_id LEFT JOIN empresas ON empresas.profile_id = perfils.id LEFT JOIN celebrities ON celebrities.profile_id = perfils.id WHERE posts.active = true AND posts.profil_id = "'.Auth::id().'" GROUP BY posts.id ORDER BY posts.created_at DESC LIMIT 5');

		//If return user is more than one and less than two
		if (count($posts)>0) {
			foreach ($posts as $post) {
				array_push($post_content, $post);
			}
		}
		// dd($post_content);
		//Post category
		$categories = Category_post::where('active',true)->get();
		$alias = '';
		$paises = [];
		$provincias = [];
		$estados = [];
		$buildings = [];
		$empresa=[];
		$builds = [];
		$celebritie = [];
		if (Auth::user()->role == 2) {
			$buildings = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
			if(count($buildings) > 0){
				$empresa = DB::table('empresas')->where('profile_id',Auth::id())->first();

			}
		}
		if (Auth::user()->role == 1) {
			$celebridad = Celebritie::where('profile_id',Auth::id())->where('active',true)->get();
			if (count($celebridad) > 0) {
				$celebritie = Celebritie::where('profile_id',Auth::id())->first();
			}
		}
		$countries = Countrie::lists('name','id');
		// dd(OpenGraph::fetch(OpenGraph::findURL($post_content[0]->description))->site_name);
		return view('logueado.favoritos',compact('categories','post_content','empresa','celebritie','countries'));
	}
	public function perfil(){
		$category = Category_post::lists('name','id');
		$id = Auth::user()->id;

		$posts = DB::select('
			SELECT perfils_friend.img_profile as imagen_perfil_friend,perfils_friend.name AS friend_name, perfils_friend.id as user_id_friend,user_shares.user_id as friend, user_shares.new_post_id as friend_post,posts.posts, posts.id as id_post, images_posts.post_id as image_post_id,images_posts.path, images_posts.active as image_active, posts.description, posts.qualification, posts.like, posts.share, posts.active as post_active, posts.profil_id, like_posts.post_id, like_posts.profil_id, like_posts.like as likeLike, like_posts.active as likeActive, posts.profil_id as id_user,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil, perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator,share_posts.active as share_active, follow_posts.active as follow,image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active, empresas.alias, empresas.responsable, celebrities.apodo FROM posts LEFT JOIN images_posts on images_posts.post_id = posts.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.$id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN perfils ON share_posts.profil_id = perfils.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.$id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id LEFT JOIN user_shares ON user_shares.new_post_id = posts.id LEFT JOIN perfils AS perfils_friend ON perfils_friend.id = user_shares.user_id LEFT JOIN empresas ON empresas.profile_id = '.$id.' LEFT JOIN celebrities ON celebrities.profile_id = '.$id.' WHERE posts.profil_id = '.$id.' and posts.active = true ORDER BY posts.id DESC LIMIT 3 ');

		$socialNet = ['facebook','twitter','linkedin','youtube','pinterest','instagram','snapchat','plus','vine','tumblr'];

		$streamNet = ['twitch','bambuser','livestream'];

		$streams = "";
		if (isset(Auth::user()->streamings)) {
			$streams = json_decode(Auth::user()->streamings,true);
		}

		$socials = "";
		if (isset(Auth::user()->redes)) {
			$socials = json_decode(Auth::user()->redes,true);
		}

		$alias = '';
		$paises = [];
		$provincias = [];
		$estados = [];
		$buildings = [];
		$empresa=[];
		$builds = [];
		$celebritie = [];
		if (Auth::user()->role == 2) {
			$buildings = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
			if(count($buildings) > 0){
				$empresa = DB::table('empresas')->where('profile_id',Auth::id())->first();

				$builds = json_decode($empresa->local,true);
			}
		}
		if (Auth::user()->role == 1) {
			$celebridad = Celebritie::where('profile_id',Auth::id())->where('active',true)->get();
			if (count($celebridad) > 0) {
				$celebritie = Celebritie::where('profile_id',Auth::id())->first();
			}
		}
		$countries = Countrie::lists('name','id');

		$dataUsers = Perfil::leftJoin('user_likes', function($join)
			        {
			            $join->on('user_likes.user_id', '=', 'perfils.id')
			            ->where('user_likes.profil_id','=',Auth::id())
			            ->where('user_likes.like','=',true);
			        })->select('user_likes.profil_id','perfils.name','perfils.update','perfils.qualification','perfils.like','perfils.role',DB::raw('YEAR(CURDATE())-YEAR(perfils.birthdate) as edad'),'perfils.pais','perfils.descripcion','perfils.id','perfils.email','perfils.birthdate','perfils.img_profile','perfils.redes','perfils.streamings','perfils.webs','perfils.blogs','perfils.mi_frase')->where('perfils.id',Auth::id())->get();
		// dd($posts);
		return view('logueado.perfil',compact('category','posts','socialNet','streamNet','streams','socials','builds','empresa','celebritie','countries','dataUsers'));
		
		// return view('logueado.perfil',compact('category','posts','socialNet','streamNet','streams','socials'));
	}

	public function tendencias(){
		$trends = DB::select('SELECT perfils_friend.img_profile as imagen_perfil_friend,perfils_friend.name AS friend_name, perfils_friend.id as user_id_friend,user_shares.user_id as friend, user_shares.new_post_id as friend_post,post_trends.trend_id,posts.posts, posts.id as id_post, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile , like_posts.post_id, like_posts.profil_id as userLike, like_posts.like as likeLike, like_posts.active as likeActive,posts.profil_id as id_user, follow_posts.active as follow,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator, image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active, empresas.alias, empresas.responsable, celebrities.apodo FROM posts INNER JOIN post_trends on posts.id = post_trends.post_id LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.Auth::user()->id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id  LEFT JOIN user_shares ON user_shares.new_post_id = posts.id LEFT JOIN perfils AS perfils_friend ON perfils_friend.id = user_shares.user_id LEFT JOIN empresas ON empresas.profile_id = perfils.id LEFT JOIN celebrities ON celebrities.profile_id = perfils.id WHERE posts.active = true GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

		$topTrends = DB::select('SELECT `post_trends`.`trend_id`, count(`post_trends`.`trend_id`) AS `TOTAL`,`trends`.`name` FROM `post_trends` LEFT JOIN `trends` ON `trends`.`id` = `post_trends`.`trend_id` GROUP BY `trend_id` ORDER BY `TOTAL` DESC LIMIT 0 , 10 ');
		// dd($trends);

		$alias = '';
		$paises = [];
		$provincias = [];
		$estados = [];
		$buildings = [];
		$empresa=[];
		$builds = [];

		$celebritie = [];
		$apodo = [];
		if (Auth::user()->role == 2) {
			$buildings = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
			if(count($buildings) > 0){
				$empresa = DB::table('empresas')
				->where('profile_id',Auth::id())->first();

			}
		}
		if (Auth::user()->role == 1) {
			$celebridad = Celebritie::where('profile_id',Auth::id())->where('active',true)->get();
			if (count($celebridad) > 0) {
				$celebritie = Celebritie::where('profile_id',Auth::id())->first();
			}
		}
		$countries = Countrie::lists('name','id');

		// dd($trends);
		return view('logueado.tendencias',compact('trends','topTrends','empresa','celebritie','countries'));
	}

	public function tendencia($name){
		$id = Trend::whereRaw('name = "'.$name.'" and active = "1"')->get();
		if (count($id) > 0) {
			
			$id = $id[0]['attributes']['id'];
			$trends = DB::select('SELECT perfils_friend.img_profile as imagen_perfil_friend,perfils_friend.name AS friend_name, perfils_friend.id as user_id_friend,user_shares.user_id as friend, user_shares.new_post_id as friend_post,post_trends.trend_id, posts.id as id_post,posts.posts, images_posts.post_id,images_posts.path, images_posts.active, posts.description, posts.qualification, posts.like, posts.share, posts.active, posts.profil_id, perfils.name AS user, perfils.img_profile, like_posts.post_id, like_posts.profil_id as userLike, like_posts.like as likeLike, like_posts.active as likeActive,posts.profil_id as id_user,follow_posts.active as follow,share_posts.description_old_post,share_posts.post_id as old_post_id, share_posts.profil_id as creator_perfil,share_posts.active as share_active,perfils_share.img_profile as imagen_perfil_creator,perfils_share.name, perfils_share.id as user_id_creator,image_post_share.post_id as image_share_post_id,image_post_share.path AS path_share, image_post_share.active as img_share_active, empresas.alias, empresas.responsable, celebrities.apodo FROM posts INNER JOIN post_trends on post_trends.trend_id = "'.$id.'" LEFT JOIN images_posts on images_posts.post_id = posts.id INNER JOIN perfils ON posts.profil_id = perfils.id LEFT JOIN like_posts ON posts.id = like_posts.post_id and like_posts.profil_id = '.Auth::user()->id.' and (like_posts.active = true and like_posts.like = true) LEFT JOIN share_posts ON share_posts.new_post_id = posts.id LEFT JOIN follow_posts ON follow_posts.post_id = posts.id AND follow_posts.perfil_id = '.Auth::user()->id.' and (follow_posts.active = true) LEFT JOIN perfils AS perfils_share ON perfils_share.id = share_posts.profil_id LEFT JOIN images_posts AS image_post_share on image_post_share.post_id = share_posts.post_id LEFT JOIN user_shares ON user_shares.new_post_id = posts.id LEFT JOIN perfils AS perfils_friend ON perfils_friend.id = user_shares.user_id LEFT JOIN empresas ON empresas.profile_id = perfils.id LEFT JOIN celebrities ON celebrities.profile_id = perfils.id WHERE posts.active = true and posts.id = post_trends.post_id GROUP BY post_trends.post_id ORDER BY posts.id DESC LIMIT 10');

			$name_trends = Trend::find($id);
			$images = [];
			foreach ($trends as $trend) {
				if (count($images) == 9) {
					break;
				}
				if (!empty($trend->path)) {
					
					array_push($images,$trend->path );
				}
			}
			$alias = '';
		$paises = [];
		$provincias = [];
		$estados = [];
		$buildings = [];
		$empresa=[];
		$builds = [];
		$celebritie = [];
		if (Auth::user()->role == 2) {
			$buildings = Empresa::where('profile_id',Auth::id())->where('active',true)->get();
			if(count($buildings) > 0){
				$empresa = DB::table('empresas')
				->where('profile_id',Auth::id())->first();

				
				
				
			}
		}
		if (Auth::user()->role == 1) {
			$celebridad = Celebritie::where('profile_id',Auth::id())->where('active',true)->get();
			if (count($celebridad) > 0) {
				$celebritie = Celebritie::where('profile_id',Auth::id())->first();
			}
		}
		$countries = Countrie::lists('name','id');
			return view('logueado.tendencia', compact('trends','images','name_trends','empresa','celebritie','countries'));													
		}else{
			return redirect('tendencias');
		}
	}

	public function typeaSearch(Request $request)
	{
		if(Auth::check()){
	        $search = $request->input('searching');

	        $users = DB::select('SELECT * FROM perfils WHERE active = true and name LIKE "%'.$search.'%"');
	        $data = [];
	        if (count($users) > 0) {
	        	foreach ($users as $user) {
	        		array_push($data,["name" => $user->name, "img" => $user->img_profile, "id" => $user->id]);
	        	}
	        	return response()->json(['error' => false, 'data' => $data]);
	        }else{
	        	return response()->json(['error' => true]);
	        }
		}else{
			return response()->json(['error' => true]);
		}

        
	}

}
