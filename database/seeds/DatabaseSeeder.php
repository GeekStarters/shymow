<?php

use App\Perfil;
use App\Friend;
use App\Category_post;
use App\Category_product;
use App\Type_product;
use App\First_spesification;
use App\Last_spesification;
use App\Category;
use App\Interest;
use App\Chat;
use App\User_chat;
use App\Message;
use App\Type_send_product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('FriendTableSeeder');
        $this->call('CategoryPostTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('InterestTableSeeder');
        $this->call('CategoryProductTableSeeder');
        $this->call('TypeProductTableSeeder');
        $this->call('FirstSpesificationTableSeeder');
        $this->call('LastSpesificationTableSeeder');
        $this->call('TypeSendTableSeeder');
        $this->call('ChatTableSeeder');
        $this->call('MessageTableSeeder');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('perfils')->delete();
        Perfil::create(array(
	        	'email' => 'wilmer@gmail.com',
	        	'name' => 'Wilmer gilberto',
	        	'password' => Hash::make('12345678'),
	        	'birthdate' => date('Y-m-d', strtotime('29-03-1995')),
	        	'genero' => 'M',
	        	'pais' => 'El Salvador',
	        	'provincia' => 'El refugio',
	        	'municipio' => 'La paz',
	        	'hobbies' => 'Musica, juegos, Economia',
	        	'role' => '0',
	        	'edad' => 22
        	));
        Perfil::create(array(
	        	'email' => 'demi@gmail.com',
	        	'name' => 'delmi solano',
	        	'password' => Hash::make('12345678'),
	        	'birthdate' => date('Y-m-d', strtotime('29-03-1995')),
	        	'genero' => 'F',
	        	'pais' => 'El Salvador',
	        	'provincia' => 'El refugio',
	        	'municipio' => 'La paz',
	        	'hobbies' => 'Musica, juegos, Economia',
	        	'role' => '0',
	        	'edad' => 29
        	));
        Perfil::create(array(
	        	'email' => 'Gisela@gmail.com',
	        	'name' => 'Gisela lara',
	        	'password' => Hash::make('12345678'),
	        	'birthdate' => date('Y-m-d', strtotime('29-03-1995')),
	        	'genero' => 'F',
	        	'pais' => 'El Salvador',
	        	'provincia' => 'El refugio',
	        	'municipio' => 'La paz',
	        	'hobbies' => 'Musica, juegos, Economia',
	        	'role' => '0',
	        	'edad' => 21
        	));

       	Perfil::create(array(
	        	'email' => 'developer@gmail.com',
	        	'name' => 'Developer prueba',
	        	'password' => Hash::make('12345678'),
	        	'birthdate' => date('Y-m-d', strtotime('29-03-1995')),
	        	'genero' => 'M',
	        	'pais' => 'El Salvador',
	        	'provincia' => 'El refugio',
	        	'municipio' => 'La paz',
	        	'hobbies' => 'Musica, juegos, Economia',
	        	'role' => 0
	,        	'edad' => 
     21   	));


    }

}

class FriendTableSeeder extends Seeder {

    public function run()
    {
        DB::table('friends')->delete();
        Friend::create(array(
	        	'user1' => 1,
	        	'user2' => 2,
	        	'friend' => false
        ));

        Friend::create(array(
	        	'user1' => 1,
	        	'user2' => 3,
	        	'friend' => true
        ));

        Friend::create(array(
	        	'user1' => 1,
	        	'user2' => 4,
	        	'friend' => true
        ));

        Friend::create(array(
	        	'user1' => 2,
	        	'user2' => 3,
	        	'friend' => true
        ));

        Friend::create(array(
	        	'user1' => 2,
	        	'user2' => 4,
	        	'friend' => true
        ));

        Friend::create(array(
	        	'user1' => 3,
	        	'user2' => 4,
	        	'friend' => true
        ));
    }

}
class TypeSendTableSeeder extends Seeder {

    public function run()
    {
        DB::table('Type_send_products')->delete();
        Type_send_product::create(array(
	        	'name' => 'No hago envíos',
        ));

        Type_send_product::create(array(
	        	'name' => 'Si hago envíos',
        ));

        Type_send_product::create(array(
	        	'name' => 'Acordar con el comprador',
        ));
    }

}

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();
        Category::create(array(
	        	'name' => 'Deportes',
        ));

        Category::create(array(
	        	'name' => 'Restaurantes',
        ));

        Category::create(array(
	        	'name' => 'Entretenimiento',
        ));
        
        Category::create(array(
	        	'name' => 'Compras',
        ));

        Category::create(array(
	        	'name' => 'Amistad',
        ));

        Category::create(array(
	        	'name' => 'Música',
        ));

        Category::create(array(
	        	'name' => 'Celebridad',
        ));
    }

}

class InterestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('interests')->delete();



		$amistades = ['Acampar','Compartir coche', 'Objetos perdidos','Party','Idiomas','Trueque de habilidades','Infantil','Pesca','Cultura','Ecologismo','Intercambio de idioma','Excursionismo','Viajar','Animales','Aventura','Voluntariado','Jardinería','Escribir'];

		$entretenimientos = ['Coleccionismo','Moda','Filosofía','Lectura','Anime','Fotografía','Pintar','Teatro','Videojuegos', 'Informática','Arte','Bailar','Ciencia','Política','Exposiciones',];

		$musicas = ['Música','Conciertos'];

		$restaurantes = ['Cocina'];

		$celebridades = ['Serie','Cine','Belleza'];

		$deportes = ['Salud','Motor','Juegos de mesa','Deportes'];

		$compras = ['Compras','Tecnología'];

        foreach ($amistades as $amistad) {
        	Interest::create(array(
		        	'categories_id' => 5,
		        	'name' => $amistad
	        ));
        }

        foreach ($entretenimientos as $entretenimiento) {
        	Interest::create(array(
		        	'categories_id' => 3,
		        	'name' => $entretenimiento
	        ));
        }

        foreach ($musicas as $musica) {
        	Interest::create(array(
		        	'categories_id' => 6,
		        	'name' => $musica
	        ));
        }

        foreach ($restaurantes as $restaurantes) {
        	Interest::create(array(
		        	'categories_id' => 2,
		        	'name' => $restaurantes
	        ));
        }

        foreach ($celebridades as $celebridade) {
        	Interest::create(array(
		        	'categories_id' => 7,
		        	'name' => $celebridade
	        ));
        }

        foreach ($deportes as $deporte) {
        	Interest::create(array(
		        	'categories_id' => 1,
		        	'name' => $deporte
	        ));
        }

        foreach ($compras as $compra) {
        	Interest::create(array(
		        	'categories_id' => 4,
		        	'name' => $compra
	        ));
        }

    }

}

class CategoryProductTableSeeder extends seeder{
	public function run(){
		DB::table('category_products')->delete();
		Category_product::create(array(
	        'name' => 'Productos',
	        'path' => 'img/create_product/productos.png'
        ));
        Category_product::create(array(
	        'name' => 'Servicios',
	        'path' => 'img/create_product/servicios.png'
        ));
		Category_product::create(array(
	        'name' => 'Inmuebles',
	        'path' => 'img/create_product/inmuebles.png'
        ));
		Category_product::create(array(
	        'name' => 'Techno',
	        'path' => 'img/create_product/techno.png'
        ));
		Category_product::create(array(
	        'name' => 'Otros',
	        'path' => 'img/create_product/otros.png'
	    ));
	}
}

class FirstSpesificationTableSeeder extends seeder{
	public function run(){
		DB::table('first_spesificationS')->delete();
		First_spesification::create(array(
	        'type_product_id' => 1,
	        'name' => 'Pantalla plana'
        ));

        First_spesification::create(array(
	        'type_product_id' => 2,
	        'name' => 'HD'
        ));


        First_spesification::create(array(
	        'type_product_id' => 3,
	        'name' => 'LCD HD'
        ));

        //TYPE TWO
        First_spesification::create(array(
	        'type_product_id' => 6,
	        'name' => 'Laptops'
        ));

        First_spesification::create(array(
	        'type_product_id' => 7,
	        'name' => 'Patios'
        ));

        First_spesification::create(array(
	        'type_product_id' => 8,
	        'name' => 'Arreglos florales'
        ));
        //TYPE THREE
        First_spesification::create(array(
	        'type_product_id' => 11,
	        'name' => 'Vidrio'
        ));

        First_spesification::create(array(
	        'type_product_id' => 12,
	        'name' => 'Metal'
        ));

        First_spesification::create(array(
	        'type_product_id' => 13,
	        'name' => 'Madera'
        ));

        //TYPE FOUR
        First_spesification::create(array(
	        'type_product_id' => 16,
	        'name' => 'Rock'
        ));

        First_spesification::create(array(
	        'type_product_id' => 16,
	        'name' => 'Rap'
        ));

        First_spesification::create(array(
	        'type_product_id' => 16,
	        'name' => 'Electronica'
        ));

        //TYPE FIVE
        First_spesification::create(array(
	        'type_product_id' => 19,
	        'name' => 'Ajenjo'
        ));

        First_spesification::create(array(
	        'type_product_id' => 20,
	        'name' => 'Pizarra electronica'
        ));

        First_spesification::create(array(
	        'type_product_id' => 21,
	        'name' => 'Frijoles'
        ));
	}
}

class LastSpesificationTableSeeder extends seeder{
	public function run(){
		DB::table('last_spesifications')->delete();
		Last_spesification::create(array(
	        'first_spesification_id' => 1,
	        'name' => 'Grande'
        ));

		Last_spesification::create(array(
	        'first_spesification_id' => 2,
	        'name' => 'Pequeño'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 4,
	        'name' => 'Core i5'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 4,
	        'name' => 'Core i7'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 4,
	        'name' => 'Core i9'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 5,
	        'name' => 'Orden y restauracion'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 6,
	        'name' => 'Reestauración'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 7,
	        'name' => 'Tamaño familiar'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 7,
	        'name' => 'Mediano'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 8,
	        'name' => 'Tamaño familiar'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 8,
	        'name' => 'Mediano'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 9,
	        'name' => 'Tamaño familiar'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 9,
	        'name' => 'Mediano'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 10,
	        'name' => 'Exitos'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 10,
	        'name' => 'Populares'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 11,
	        'name' => 'Exitos'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 11,
	        'name' => 'Populares'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 12,
	        'name' => 'Exitos'
        ));
        Last_spesification::create(array(
	        'first_spesification_id' => 12,
	        'name' => 'Populares'
        ));

        Last_spesification::create(array(
	        'first_spesification_id' => 14,
	        'name' => 'Grande'
        ));
	}
}
class TypeProductTableSeeder extends seeder{
	public function run(){
		DB::table('type_products')->delete();

		//Creando para el tipo producto
		Type_product::create(array(
	        'category_product_id' => 1,
	        'name' => 'TV'
        ));
        Type_product::create(array(
	        'category_product_id' => 1,
	        'name' => 'Radio'
        ));
		Type_product::create(array(
	        'category_product_id' => 1,
	        'name' => 'PC'
        ));
		Type_product::create(array(
	        'category_product_id' => 1,
	        'name' => 'Camaras'
        ));
		Type_product::create(array(
	        'category_product_id' => 1,
	        'name' => 'Impresoras'
	    ));

		// Categoria servicios

		Type_product::create(array(
	        'category_product_id' => 2,
	        'name' => 'Reparación de PC'
        ));
        Type_product::create(array(
	        'category_product_id' => 2,
	        'name' => 'Limpieza'
        ));
		Type_product::create(array(
	        'category_product_id' => 2,
	        'name' => 'Decoraciones'
        ));
		Type_product::create(array(
	        'category_product_id' => 2,
	        'name' => 'Labanderia'
        ));
		Type_product::create(array(
	        'category_product_id' => 2,
	        'name' => 'Pasear perros'
	    ));

		// Categoria Inmuebles

		Type_product::create(array(
	        'category_product_id' => 3,
	        'name' => 'Mesas'
        ));
        Type_product::create(array(
	        'category_product_id' => 3,
	        'name' => 'Sillas'
        ));
		Type_product::create(array(
	        'category_product_id' => 3,
	        'name' => 'Vitrinas'
        ));
		Type_product::create(array(
	        'category_product_id' => 3,
	        'name' => 'Closet'
        ));
		Type_product::create(array(
	        'category_product_id' => 3,
	        'name' => 'Gradas'
	    ));

	    // Categoria Techno

		Type_product::create(array(
	        'category_product_id' => 4,
	        'name' => 'Música'
        ));
        Type_product::create(array(
	        'category_product_id' => 4,
	        'name' => 'Accesorios'
        ));
		Type_product::create(array(
	        'category_product_id' => 4,
	        'name' => 'Heramientas'
        ));


        // Categoria Otros

		Type_product::create(array(
	        'category_product_id' => 5,
	        'name' => 'Hierbas'
        ));
        Type_product::create(array(
	        'category_product_id' => 5,
	        'name' => 'Pizarra'
        ));
		Type_product::create(array(
	        'category_product_id' => 5,
	        'name' => 'Semillas'
        ));
	}
}
class CategoryPostTableSeeder extends seeder{
	public function run(){
		DB::table('category_posts')->delete();
        Category_post::create(array(
	        'name' => 'Bisutería',
        ));
        Category_post::create(array(
	        'name' => 'Casas de playa',
        ));
        Category_post::create(array(
	        'name' => 'Series de Tv y cine',
        ));
        Category_post::create(array(
	        'name' => 'Música',
        ));
        Category_post::create(array(
	        'name' => 'Videojuegos',
        ));
        Category_post::create(array(
	        'name' => 'Empresas',
        ));
        Category_post::create(array(
	        'name' => 'Movilidad y transporte',
        ));
	}
}


class ChatTableSeeder extends seeder{
	public function run(){
		DB::table('chats')->delete();
        Chat::create(array(
	        'userOne' => 4,
	        'userTwo' => 3,
	        'channel' => Hash::make('1'),
        ));
         Chat::create(array(
	        'userOne' => 2,
	        'userTwo' => 1,
	        'channel' => Hash::make('2'),
        ));
          Chat::create(array(
	        'userOne' => 3,
	        'userTwo' => 2,
	        'channel' => Hash::make('3'),
        ));
          Chat::create(array(
	        'userOne' => 1,
	        'userTwo' => 4,
	        'channel' => Hash::make('4'),
        ));
	}
}
class MessageTableSeeder extends seeder{
	public function run(){
		DB::table('messages')->delete();
        Message::create(array(
	        'chat_id' => 1,
	        'emisor' => 4,
	        'receptor' => 3,
	        'message' => "Hola como estas",
        ));
        Message::create(array(
	        'chat_id' => 1,
	        'emisor' => 4,
	        'receptor' => 3,
	        'message' => "Espero que bien",
        ));
        Message::create(array(
	        'chat_id' => 1,
	        'emisor' => 3,
	        'receptor' => 4,
	        'message' => "Si porque",
        ));
        Message::create(array(
	        'chat_id' => 1,
	        'emisor' => 4,
	        'receptor' => 3,
	        'message' => "Solo queria saber",
        ));
        Message::create(array(
	        'chat_id' => 1,
	        'emisor' => 3,
	        'receptor' => 4,
	        'message' => "Gracias",
        ));


        Message::create(array(
	        'chat_id' => 2,
	        'emisor' => 2,
	        'receptor' => 1,
	        'message' => "Que haces",
        ));
        Message::create(array(
	        'chat_id' => 2,
	        'emisor' => 2,
	        'receptor' => 1,
	        'message' => "Nada por qué?",
        ));


        Message::create(array(
	        'chat_id' => 4,
	        'emisor' => 1,
	        'receptor' => 4,
	        'message' => "Estoy aburrido",
        ));
        Message::create(array(
	        'chat_id' => 4,
	        'emisor' => 4,
	        'receptor' => 1,
	        'message' => "Por que? jaja",
        ));
	}
}