<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");

        $google_fonts = array(
            "none" => "Select a font",//please, always use this key: "none"
            'ABeeZee' => 'ABeeZee',
            'Abel' => 'Abel',
            'Abril Fatface' => 'Abril Fatface',
            'Aclonica' => 'Aclonica',
            'Acme' => 'Acme',
            'Actor' => 'Actor',
            'Adamina' => 'Adamina',
            'Advent Pro' => 'Advent Pro',
            'Aguafina Script' => 'Aguafina Script',
            'Akronim' => 'Akronim',
            'Aladin' => 'Aladin',
            'Aldrich' => 'Aldrich',
            'Alef' => 'Alef',
            'Alegreya' => 'Alegreya',
            'Alegreya SC' => 'Alegreya SC',
            'Alegreya Sans' => 'Alegreya Sans',
            'Alegreya Sans SC' => 'Alegreya Sans SC',
            'Alex Brush' => 'Alex Brush',
            'Alfa Slab One' => 'Alfa Slab One',
            'Alice' => 'Alice',
            'Alike' => 'Alike',
            'Alike Angular' => 'Alike Angular',
            'Allan' => 'Allan',
            'Allerta' => 'Allerta',
            'Allerta Stencil' => 'Allerta Stencil',
            'Allura' => 'Allura',
            'Almendra' => 'Almendra',
            'Almendra Display' => 'Almendra Display',
            'Almendra SC' => 'Almendra SC',
            'Amarante' => 'Amarante',
            'Amaranth' => 'Amaranth',
            'Amatic SC' => 'Amatic SC',
            'Amethysta' => 'Amethysta',
            'Anaheim' => 'Anaheim',
            'Andada' => 'Andada',
            'Andika' => 'Andika',
            'Angkor' => 'Angkor',
            'Annie Use Your Telescope' => 'Annie Use Your Telescope',
            'Anonymous Pro' => 'Anonymous Pro',
            'Antic' => 'Antic',
            'Antic Didone' => 'Antic Didone',
            'Antic Slab' => 'Antic Slab',
            'Anton' => 'Anton',
            'Arapey' => 'Arapey',
            'Arbutus' => 'Arbutus',
            'Arbutus Slab' => 'Arbutus Slab',
            'Architects Daughter' => 'Architects Daughter',
            'Archivo Black' => 'Archivo Black',
            'Archivo Narrow' => 'Archivo Narrow',
            'Arimo' => 'Arimo',
            'Arizonia' => 'Arizonia',
            'Armata' => 'Armata',
            'Artifika' => 'Artifika',
            'Arvo' => 'Arvo',
            'Asap' => 'Asap',
            'Asset' => 'Asset',
            'Astloch' => 'Astloch',
            'Asul' => 'Asul',
            'Atomic Age' => 'Atomic Age',
            'Aubrey' => 'Aubrey',
            'Audiowide' => 'Audiowide',
            'Autour One' => 'Autour One',
            'Average' => 'Average',
            'Average Sans' => 'Average Sans',
            'Averia Gruesa Libre' => 'Averia Gruesa Libre',
            'Averia Libre' => 'Averia Libre',
            'Averia Sans Libre' => 'Averia Sans Libre',
            'Averia Serif Libre' => 'Averia Serif Libre',
            'Bad Script' => 'Bad Script',
            'Balthazar' => 'Balthazar',
            'Bangers' => 'Bangers',
            'Basic' => 'Basic',
            'Battambang' => 'Battambang',
            'Baumans' => 'Baumans',
            'Bayon' => 'Bayon',
            'Belgrano' => 'Belgrano',
            'Belleza' => 'Belleza',
            'BenchNine' => 'BenchNine',
            'Bentham' => 'Bentham',
            'Berkshire Swash' => 'Berkshire Swash',
            'Bevan' => 'Bevan',
            'Bigelow Rules' => 'Bigelow Rules',
            'Bigshot One' => 'Bigshot One',
            'Bilbo' => 'Bilbo',
            'Bilbo Swash Caps' => 'Bilbo Swash Caps',
            'Bitter' => 'Bitter',
            'Black Ops One' => 'Black Ops One',
            'Bokor' => 'Bokor',
            'Bonbon' => 'Bonbon',
            'Boogaloo' => 'Boogaloo',
            'Bowlby One' => 'Bowlby One',
            'Bowlby One SC' => 'Bowlby One SC',
            'Brawler' => 'Brawler',
            'Bree Serif' => 'Bree Serif',
            'Bubblegum Sans' => 'Bubblegum Sans',
            'Bubbler One' => 'Bubbler One',
            'Buda' => 'Buda',
            'Buenard' => 'Buenard',
            'Butcherman' => 'Butcherman',
            'Butterfly Kids' => 'Butterfly Kids',
            'Cabin' => 'Cabin',
            'Cabin Condensed' => 'Cabin Condensed',
            'Cabin Sketch' => 'Cabin Sketch',
            'Caesar Dressing' => 'Caesar Dressing',
            'Cagliostro' => 'Cagliostro',
            'Calligraffitti' => 'Calligraffitti',
            'Cambo' => 'Cambo',
            'Candal' => 'Candal',
            'Cantarell' => 'Cantarell',
            'Cantata One' => 'Cantata One',
            'Cantora One' => 'Cantora One',
            'Capriola' => 'Capriola',
            'Cardo' => 'Cardo',
            'Carme' => 'Carme',
            'Carrois Gothic' => 'Carrois Gothic',
            'Carrois Gothic SC' => 'Carrois Gothic SC',
            'Carter One' => 'Carter One',
            'Caudex' => 'Caudex',
            'Cedarville Cursive' => 'Cedarville Cursive',
            'Ceviche One' => 'Ceviche One',
            'Changa One' => 'Changa One',
            'Chango' => 'Chango',
            'Chau Philomene One' => 'Chau Philomene One',
            'Chela One' => 'Chela One',
            'Chelsea Market' => 'Chelsea Market',
            'Chenla' => 'Chenla',
            'Cherry Cream Soda' => 'Cherry Cream Soda',
            'Cherry Swash' => 'Cherry Swash',
            'Chewy' => 'Chewy',
            'Chicle' => 'Chicle',
            'Chivo' => 'Chivo',
            'Cinzel' => 'Cinzel',
            'Cinzel Decorative' => 'Cinzel Decorative',
            'Clicker Script' => 'Clicker Script',
            'Coda' => 'Coda',
            'Coda Caption' => 'Coda Caption',
            'Codystar' => 'Codystar',
            'Combo' => 'Combo',
            'Comfortaa' => 'Comfortaa',
            'Coming Soon' => 'Coming Soon',
            'Concert One' => 'Concert One',
            'Condiment' => 'Condiment',
            'Content' => 'Content',
            'Contrail One' => 'Contrail One',
            'Convergence' => 'Convergence',
            'Cookie' => 'Cookie',
            'Copse' => 'Copse',
            'Corben' => 'Corben',
            'Courgette' => 'Courgette',
            'Cousine' => 'Cousine',
            'Coustard' => 'Coustard',
            'Covered By Your Grace' => 'Covered By Your Grace',
            'Crafty Girls' => 'Crafty Girls',
            'Creepster' => 'Creepster',
            'Crete Round' => 'Crete Round',
            'Crimson Text' => 'Crimson Text',
            'Croissant One' => 'Croissant One',
            'Crushed' => 'Crushed',
            'Cuprum' => 'Cuprum',
            'Cutive' => 'Cutive',
            'Cutive Mono' => 'Cutive Mono',
            'Damion' => 'Damion',
            'Dancing Script' => 'Dancing Script',
            'Dangrek' => 'Dangrek',
            'Dawning of a New Day' => 'Dawning of a New Day',
            'Days One' => 'Days One',
            'Delius' => 'Delius',
            'Delius Swash Caps' => 'Delius Swash Caps',
            'Delius Unicase' => 'Delius Unicase',
            'Della Respira' => 'Della Respira',
            'Denk One' => 'Denk One',
            'Devonshire' => 'Devonshire',
            'Didact Gothic' => 'Didact Gothic',
            'Diplomata' => 'Diplomata',
            'Diplomata SC' => 'Diplomata SC',
            'Domine' => 'Domine',
            'Donegal One' => 'Donegal One',
            'Doppio One' => 'Doppio One',
            'Dorsa' => 'Dorsa',
            'Dosis' => 'Dosis',
            'Dr Sugiyama' => 'Dr Sugiyama',
            'Droid Sans' => 'Droid Sans',
            'Droid Sans Mono' => 'Droid Sans Mono',
            'Droid Serif' => 'Droid Serif',
            'Duru Sans' => 'Duru Sans',
            'Dynalight' => 'Dynalight',
            'EB Garamond' => 'EB Garamond',
            'Eagle Lake' => 'Eagle Lake',
            'Eater' => 'Eater',
            'Economica' => 'Economica',
            'Electrolize' => 'Electrolize',
            'Elsie' => 'Elsie',
            'Elsie Swash Caps' => 'Elsie Swash Caps',
            'Emblema One' => 'Emblema One',
            'Emilys Candy' => 'Emilys Candy',
            'Engagement' => 'Engagement',
            'Englebert' => 'Englebert',
            'Enriqueta' => 'Enriqueta',
            'Erica One' => 'Erica One',
            'Esteban' => 'Esteban',
            'Euphoria Script' => 'Euphoria Script',
            'Ewert' => 'Ewert',
            'Exo' => 'Exo',
            'Exo 2' => 'Exo 2',
            'Expletus Sans' => 'Expletus Sans',
            'Fanwood Text' => 'Fanwood Text',
            'Fascinate' => 'Fascinate',
            'Fascinate Inline' => 'Fascinate Inline',
            'Faster One' => 'Faster One',
            'Fasthand' => 'Fasthand',
            'Fauna One' => 'Fauna One',
            'Federant' => 'Federant',
            'Federo' => 'Federo',
            'Felipa' => 'Felipa',
            'Fenix' => 'Fenix',
            'Finger Paint' => 'Finger Paint',
            'Fjalla One' => 'Fjalla One',
            'Fjord One' => 'Fjord One',
            'Flamenco' => 'Flamenco',
            'Flavors' => 'Flavors',
            'Fondamento' => 'Fondamento',
            'Fontdiner Swanky' => 'Fontdiner Swanky',
            'Forum' => 'Forum',
            'Francois One' => 'Francois One',
            'Freckle Face' => 'Freckle Face',
            'Fredericka the Great' => 'Fredericka the Great',
            'Fredoka One' => 'Fredoka One',
            'Freehand' => 'Freehand',
            'Fresca' => 'Fresca',
            'Frijole' => 'Frijole',
            'Fruktur' => 'Fruktur',
            'Fugaz One' => 'Fugaz One',
            'GFS Didot' => 'GFS Didot',
            'GFS Neohellenic' => 'GFS Neohellenic',
            'Gabriela' => 'Gabriela',
            'Gafata' => 'Gafata',
            'Galdeano' => 'Galdeano',
            'Galindo' => 'Galindo',
            'Gentium Basic' => 'Gentium Basic',
            'Gentium Book Basic' => 'Gentium Book Basic',
            'Geo' => 'Geo',
            'Geostar' => 'Geostar',
            'Geostar Fill' => 'Geostar Fill',
            'Germania One' => 'Germania One',
            'Gilda Display' => 'Gilda Display',
            'Give You Glory' => 'Give You Glory',
            'Glass Antiqua' => 'Glass Antiqua',
            'Glegoo' => 'Glegoo',
            'Gloria Hallelujah' => 'Gloria Hallelujah',
            'Goblin One' => 'Goblin One',
            'Gochi Hand' => 'Gochi Hand',
            'Gorditas' => 'Gorditas',
            'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
            'Graduate' => 'Graduate',
            'Grand Hotel' => 'Grand Hotel',
            'Gravitas One' => 'Gravitas One',
            'Great Vibes' => 'Great Vibes',
            'Griffy' => 'Griffy',
            'Gruppo' => 'Gruppo',
            'Gudea' => 'Gudea',
            'Habibi' => 'Habibi',
            'Hammersmith One' => 'Hammersmith One',
            'Hanalei' => 'Hanalei',
            'Hanalei Fill' => 'Hanalei Fill',
            'Handlee' => 'Handlee',
            'Hanuman' => 'Hanuman',
            'Happy Monkey' => 'Happy Monkey',
            'Headland One' => 'Headland One',
            'Henny Penny' => 'Henny Penny',
            'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
            'Holtwood One SC' => 'Holtwood One SC',
            'Homemade Apple' => 'Homemade Apple',
            'Homenaje' => 'Homenaje',
            'IM Fell DW Pica' => 'IM Fell DW Pica',
            'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
            'IM Fell Double Pica' => 'IM Fell Double Pica',
            'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
            'IM Fell English' => 'IM Fell English',
            'IM Fell English SC' => 'IM Fell English SC',
            'IM Fell French Canon' => 'IM Fell French Canon',
            'IM Fell French Canon SC' => 'IM Fell French Canon SC',
            'IM Fell Great Primer' => 'IM Fell Great Primer',
            'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
            'Iceberg' => 'Iceberg',
            'Iceland' => 'Iceland',
            'Imprima' => 'Imprima',
            'Inconsolata' => 'Inconsolata',
            'Inder' => 'Inder',
            'Indie Flower' => 'Indie Flower',
            'Inika' => 'Inika',
            'Irish Grover' => 'Irish Grover',
            'Istok Web' => 'Istok Web',
            'Italiana' => 'Italiana',
            'Italianno' => 'Italianno',
            'Jacques Francois' => 'Jacques Francois',
            'Jacques Francois Shadow' => 'Jacques Francois Shadow',
            'Jim Nightshade' => 'Jim Nightshade',
            'Jockey One' => 'Jockey One',
            'Jolly Lodger' => 'Jolly Lodger',
            'Josefin Sans' => 'Josefin Sans',
            'Josefin Slab' => 'Josefin Slab',
            'Joti One' => 'Joti One',
            'Judson' => 'Judson',
            'Julee' => 'Julee',
            'Julius Sans One' => 'Julius Sans One',
            'Junge' => 'Junge',
            'Jura' => 'Jura',
            'Just Another Hand' => 'Just Another Hand',
            'Just Me Again Down Here' => 'Just Me Again Down Here',
            'Kameron' => 'Kameron',
            'Kantumruy' => 'Kantumruy',
            'Karla' => 'Karla',
            'Kaushan Script' => 'Kaushan Script',
            'Kavoon' => 'Kavoon',
            'Kdam Thmor' => 'Kdam Thmor',
            'Keania One' => 'Keania One',
            'Kelly Slab' => 'Kelly Slab',
            'Kenia' => 'Kenia',
            'Khmer' => 'Khmer',
            'Kite One' => 'Kite One',
            'Knewave' => 'Knewave',
            'Kotta One' => 'Kotta One',
            'Koulen' => 'Koulen',
            'Kranky' => 'Kranky',
            'Kreon' => 'Kreon',
            'Kristi' => 'Kristi',
            'Krona One' => 'Krona One',
            'La Belle Aurore' => 'La Belle Aurore',
            'Lancelot' => 'Lancelot',
            'Lato' => 'Lato',
            'League Script' => 'League Script',
            'Leckerli One' => 'Leckerli One',
            'Ledger' => 'Ledger',
            'Lekton' => 'Lekton',
            'Lemon' => 'Lemon',
            'Libre Baskerville' => 'Libre Baskerville',
            'Life Savers' => 'Life Savers',
            'Lilita One' => 'Lilita One',
            'Lily Script One' => 'Lily Script One',
            'Limelight' => 'Limelight',
            'Linden Hill' => 'Linden Hill',
            'Lobster' => 'Lobster',
            'Lobster Two' => 'Lobster Two',
            'Londrina Outline' => 'Londrina Outline',
            'Londrina Shadow' => 'Londrina Shadow',
            'Londrina Sketch' => 'Londrina Sketch',
            'Londrina Solid' => 'Londrina Solid',
            'Lora' => 'Lora',
            'Love Ya Like A Sister' => 'Love Ya Like A Sister',
            'Loved by the King' => 'Loved by the King',
            'Lovers Quarrel' => 'Lovers Quarrel',
            'Luckiest Guy' => 'Luckiest Guy',
            'Lusitana' => 'Lusitana',
            'Lustria' => 'Lustria',
            'Macondo' => 'Macondo',
            'Macondo Swash Caps' => 'Macondo Swash Caps',
            'Magra' => 'Magra',
            'Maiden Orange' => 'Maiden Orange',
            'Mako' => 'Mako',
            'Marcellus' => 'Marcellus',
            'Marcellus SC' => 'Marcellus SC',
            'Marck Script' => 'Marck Script',
            'Margarine' => 'Margarine',
            'Marko One' => 'Marko One',
            'Marmelad' => 'Marmelad',
            'Marvel' => 'Marvel',
            'Mate' => 'Mate',
            'Mate SC' => 'Mate SC',
            'Maven Pro' => 'Maven Pro',
            'McLaren' => 'McLaren',
            'Meddon' => 'Meddon',
            'MedievalSharp' => 'MedievalSharp',
            'Medula One' => 'Medula One',
            'Megrim' => 'Megrim',
            'Meie Script' => 'Meie Script',
            'Merienda' => 'Merienda',
            'Merienda One' => 'Merienda One',
            'Merriweather' => 'Merriweather',
            'Merriweather Sans' => 'Merriweather Sans',
            'Metal' => 'Metal',
            'Metal Mania' => 'Metal Mania',
            'Metamorphous' => 'Metamorphous',
            'Metrophobic' => 'Metrophobic',
            'Michroma' => 'Michroma',
            'Milonga' => 'Milonga',
            'Miltonian' => 'Miltonian',
            'Miltonian Tattoo' => 'Miltonian Tattoo',
            'Miniver' => 'Miniver',
            'Miss Fajardose' => 'Miss Fajardose',
            'Modern Antiqua' => 'Modern Antiqua',
            'Molengo' => 'Molengo',
            'Molle' => 'Molle',
            'Monda' => 'Monda',
            'Monofett' => 'Monofett',
            'Monoton' => 'Monoton',
            'Monsieur La Doulaise' => 'Monsieur La Doulaise',
            'Montaga' => 'Montaga',
            'Montez' => 'Montez',
            'Montserrat' => 'Montserrat',
            'Montserrat Alternates' => 'Montserrat Alternates',
            'Montserrat Subrayada' => 'Montserrat Subrayada',
            'Moul' => 'Moul',
            'Moulpali' => 'Moulpali',
            'Mountains of Christmas' => 'Mountains of Christmas',
            'Mouse Memoirs' => 'Mouse Memoirs',
            'Mr Bedfort' => 'Mr Bedfort',
            'Mr Dafoe' => 'Mr Dafoe',
            'Mr De Haviland' => 'Mr De Haviland',
            'Mrs Saint Delafield' => 'Mrs Saint Delafield',
            'Mrs Sheppards' => 'Mrs Sheppards',
            'Muli' => 'Muli',
            'Mystery Quest' => 'Mystery Quest',
            'Neucha' => 'Neucha',
            'Neuton' => 'Neuton',
            'New Rocker' => 'New Rocker',
            'News Cycle' => 'News Cycle',
            'Niconne' => 'Niconne',
            'Nixie One' => 'Nixie One',
            'Nobile' => 'Nobile',
            'Nokora' => 'Nokora',
            'Norican' => 'Norican',
            'Nosifer' => 'Nosifer',
            'Nothing You Could Do' => 'Nothing You Could Do',
            'Noticia Text' => 'Noticia Text',
            'Noto Sans' => 'Noto Sans',
            'Noto Serif' => 'Noto Serif',
            'Nova Cut' => 'Nova Cut',
            'Nova Flat' => 'Nova Flat',
            'Nova Mono' => 'Nova Mono',
            'Nova Oval' => 'Nova Oval',
            'Nova Round' => 'Nova Round',
            'Nova Script' => 'Nova Script',
            'Nova Slim' => 'Nova Slim',
            'Nova Square' => 'Nova Square',
            'Numans' => 'Numans',
            'Nunito' => 'Nunito',
            'Odor Mean Chey' => 'Odor Mean Chey',
            'Offside' => 'Offside',
            'Old Standard TT' => 'Old Standard TT',
            'Oldenburg' => 'Oldenburg',
            'Oleo Script' => 'Oleo Script',
            'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
            'Open Sans' => 'Open Sans',
            'Open Sans Condensed' => 'Open Sans Condensed',
            'Oranienbaum' => 'Oranienbaum',
            'Orbitron' => 'Orbitron',
            'Oregano' => 'Oregano',
            'Orienta' => 'Orienta',
            'Original Surfer' => 'Original Surfer',
            'Oswald' => 'Oswald',
            'Over the Rainbow' => 'Over the Rainbow',
            'Overlock' => 'Overlock',
            'Overlock SC' => 'Overlock SC',
            'Ovo' => 'Ovo',
            'Oxygen' => 'Oxygen',
            'Oxygen Mono' => 'Oxygen Mono',
            'PT Mono' => 'PT Mono',
            'PT Sans' => 'PT Sans',
            'PT Sans Caption' => 'PT Sans Caption',
            'PT Sans Narrow' => 'PT Sans Narrow',
            'PT Serif' => 'PT Serif',
            'PT Serif Caption' => 'PT Serif Caption',
            'Pacifico' => 'Pacifico',
            'Paprika' => 'Paprika',
            'Parisienne' => 'Parisienne',
            'Passero One' => 'Passero One',
            'Passion One' => 'Passion One',
            'Pathway Gothic One' => 'Pathway Gothic One',
            'Patrick Hand' => 'Patrick Hand',
            'Patrick Hand SC' => 'Patrick Hand SC',
            'Patua One' => 'Patua One',
            'Paytone One' => 'Paytone One',
            'Peralta' => 'Peralta',
            'Permanent Marker' => 'Permanent Marker',
            'Petit Formal Script' => 'Petit Formal Script',
            'Petrona' => 'Petrona',
            'Philosopher' => 'Philosopher',
            'Piedra' => 'Piedra',
            'Pinyon Script' => 'Pinyon Script',
            'Pirata One' => 'Pirata One',
            'Plaster' => 'Plaster',
            'Play' => 'Play',
            'Playball' => 'Playball',
            'Playfair Display' => 'Playfair Display',
            'Playfair Display SC' => 'Playfair Display SC',
            'Podkova' => 'Podkova',
            'Poiret One' => 'Poiret One',
            'Poller One' => 'Poller One',
            'Poly' => 'Poly',
            'Pompiere' => 'Pompiere',
            'Pontano Sans' => 'Pontano Sans',
            'Port Lligat Sans' => 'Port Lligat Sans',
            'Port Lligat Slab' => 'Port Lligat Slab',
            'Prata' => 'Prata',
            'Preahvihear' => 'Preahvihear',
            'Press Start 2P' => 'Press Start 2P',
            'Princess Sofia' => 'Princess Sofia',
            'Prociono' => 'Prociono',
            'Prosto One' => 'Prosto One',
            'Puritan' => 'Puritan',
            'Purple Purse' => 'Purple Purse',
            'Quando' => 'Quando',
            'Quantico' => 'Quantico',
            'Quattrocento' => 'Quattrocento',
            'Quattrocento Sans' => 'Quattrocento Sans',
            'Questrial' => 'Questrial',
            'Quicksand' => 'Quicksand',
            'Quintessential' => 'Quintessential',
            'Qwigley' => 'Qwigley',
            'Racing Sans One' => 'Racing Sans One',
            'Radley' => 'Radley',
            'Raleway' => 'Raleway',
            'Raleway Dots' => 'Raleway Dots',
            'Rambla' => 'Rambla',
            'Rammetto One' => 'Rammetto One',
            'Ranchers' => 'Ranchers',
            'Rancho' => 'Rancho',
            'Rationale' => 'Rationale',
            'Redressed' => 'Redressed',
            'Reenie Beanie' => 'Reenie Beanie',
            'Revalia' => 'Revalia',
            'Ribeye' => 'Ribeye',
            'Ribeye Marrow' => 'Ribeye Marrow',
            'Righteous' => 'Righteous',
            'Risque' => 'Risque',
            'Roboto' => 'Roboto',
            'Roboto Condensed' => 'Roboto Condensed',
            'Roboto Slab' => 'Roboto Slab',
            'Rochester' => 'Rochester',
            'Rock Salt' => 'Rock Salt',
            'Rokkitt' => 'Rokkitt',
            'Romanesco' => 'Romanesco',
            'Ropa Sans' => 'Ropa Sans',
            'Rosario' => 'Rosario',
            'Rosarivo' => 'Rosarivo',
            'Rouge Script' => 'Rouge Script',
            'Ruda' => 'Ruda',
            'Rufina' => 'Rufina',
            'Ruge Boogie' => 'Ruge Boogie',
            'Ruluko' => 'Ruluko',
            'Rum Raisin' => 'Rum Raisin',
            'Ruslan Display' => 'Ruslan Display',
            'Russo One' => 'Russo One',
            'Ruthie' => 'Ruthie',
            'Rye' => 'Rye',
            'Sacramento' => 'Sacramento',
            'Sail' => 'Sail',
            'Salsa' => 'Salsa',
            'Sanchez' => 'Sanchez',
            'Sancreek' => 'Sancreek',
            'Sansita One' => 'Sansita One',
            'Sarina' => 'Sarina',
            'Satisfy' => 'Satisfy',
            'Scada' => 'Scada',
            'Schoolbell' => 'Schoolbell',
            'Seaweed Script' => 'Seaweed Script',
            'Sevillana' => 'Sevillana',
            'Seymour One' => 'Seymour One',
            'Shadows Into Light' => 'Shadows Into Light',
            'Shadows Into Light Two' => 'Shadows Into Light Two',
            'Shanti' => 'Shanti',
            'Share' => 'Share',
            'Share Tech' => 'Share Tech',
            'Share Tech Mono' => 'Share Tech Mono',
            'Shojumaru' => 'Shojumaru',
            'Short Stack' => 'Short Stack',
            'Siemreap' => 'Siemreap',
            'Sigmar One' => 'Sigmar One',
            'Signika' => 'Signika',
            'Signika Negative' => 'Signika Negative',
            'Simonetta' => 'Simonetta',
            'Sintony' => 'Sintony',
            'Sirin Stencil' => 'Sirin Stencil',
            'Six Caps' => 'Six Caps',
            'Skranji' => 'Skranji',
            'Slackey' => 'Slackey',
            'Smokum' => 'Smokum',
            'Smythe' => 'Smythe',
            'Sniglet' => 'Sniglet',
            'Snippet' => 'Snippet',
            'Snowburst One' => 'Snowburst One',
            'Sofadi One' => 'Sofadi One',
            'Sofia' => 'Sofia',
            'Sonsie One' => 'Sonsie One',
            'Sorts Mill Goudy' => 'Sorts Mill Goudy',
            'Source Code Pro' => 'Source Code Pro',
            'Source Sans Pro' => 'Source Sans Pro',
            'Special Elite' => 'Special Elite',
            'Spicy Rice' => 'Spicy Rice',
            'Spinnaker' => 'Spinnaker',
            'Spirax' => 'Spirax',
            'Squada One' => 'Squada One',
            'Stalemate' => 'Stalemate',
            'Stalinist One' => 'Stalinist One',
            'Stardos Stencil' => 'Stardos Stencil',
            'Stint Ultra Condensed' => 'Stint Ultra Condensed',
            'Stint Ultra Expanded' => 'Stint Ultra Expanded',
            'Stoke' => 'Stoke',
            'Strait' => 'Strait',
            'Sue Ellen Francisco' => 'Sue Ellen Francisco',
            'Sunshiney' => 'Sunshiney',
            'Supermercado One' => 'Supermercado One',
            'Suwannaphum' => 'Suwannaphum',
            'Swanky and Moo Moo' => 'Swanky and Moo Moo',
            'Syncopate' => 'Syncopate',
            'Tangerine' => 'Tangerine',
            'Taprom' => 'Taprom',
            'Tauri' => 'Tauri',
            'Telex' => 'Telex',
            'Tenor Sans' => 'Tenor Sans',
            'Text Me One' => 'Text Me One',
            'The Girl Next Door' => 'The Girl Next Door',
            'Tienne' => 'Tienne',
            'Tinos' => 'Tinos',
            'Titan One' => 'Titan One',
            'Titillium Web' => 'Titillium Web',
            'Trade Winds' => 'Trade Winds',
            'Trocchi' => 'Trocchi',
            'Trochut' => 'Trochut',
            'Trykker' => 'Trykker',
            'Tulpen One' => 'Tulpen One',
            'Ubuntu' => 'Ubuntu',
            'Ubuntu Condensed' => 'Ubuntu Condensed',
            'Ubuntu Mono' => 'Ubuntu Mono',
            'Ultra' => 'Ultra',
            'Uncial Antiqua' => 'Uncial Antiqua',
            'Underdog' => 'Underdog',
            'Unica One' => 'Unica One',
            'UnifrakturCook' => 'UnifrakturCook',
            'UnifrakturMaguntia' => 'UnifrakturMaguntia',
            'Unkempt' => 'Unkempt',
            'Unlock' => 'Unlock',
            'Unna' => 'Unna',
            'VT323' => 'VT323',
            'Vampiro One' => 'Vampiro One',
            'Varela' => 'Varela',
            'Varela Round' => 'Varela Round',
            'Vast Shadow' => 'Vast Shadow',
            'Vibur' => 'Vibur',
            'Vidaloka' => 'Vidaloka',
            'Viga' => 'Viga',
            'Voces' => 'Voces',
            'Volkhov' => 'Volkhov',
            'Vollkorn' => 'Vollkorn',
            'Voltaire' => 'Voltaire',
            'Waiting for the Sunrise' => 'Waiting for the Sunrise',
            'Wallpoet' => 'Wallpoet',
            'Walter Turncoat' => 'Walter Turncoat',
            'Warnes' => 'Warnes',
            'Wellfleet' => 'Wellfleet',
            'Wendy One' => 'Wendy One',
            'Wire One' => 'Wire One',
            'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
            'Yellowtail' => 'Yellowtail',
            'Yeseva One' => 'Yeseva One',
            'Yesteryear' => 'Yesteryear',
            'Zeyada' => 'Zeyada',
        );

		$google_fonts_subsets = array(
			'latin' => 'latin',
			'latin-ext' => 'latin-ext',
			'cyrillic' => 'cyrillic',
			'cyrillic-ext' => 'cyrillic-ext',
			'greek' => 'greek',
			'greek-ext' => 'greek-ext',
			'vietnamese' => 'vietnamese',
			'khmer' => 'khmer',
		);
/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
//$prefix = 'us_'


$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Import",
	"desc" 		=> "",
	"id" 		=> "import",
	"std" 		=> "<div class='option'><div  style='width: 160px;margin: 0 15px 0 0; float: left;'><button id='import_demo_data' class='button submit-button' style='float: left'>Import Demo Data</button><img id='import_demo_loader' src='".get_template_directory_uri()."/img/loader2.gif' style='float: left; margin: 3px; display: none;'><br clear='all'><span style='font-size: 11px; display: none;' id='import_demo_info'>This may take few minutes.</span></div>
	<div class='explain' style='width: 360px;'>If you want to have posts and pages that look like the Astra Theme Demo, you can import dummy posts and pages here. This will help you start making your own site faster and understand better how the Theme works.</div>
	<div class='clear'></div></div>
	<script>
	jQuery(window).load(function() {
		var import_running = false;
		jQuery('#import_demo_data').click(function() {
			if ( ! import_running) {
				if (confirm('Are you sure, you want to import Demo Data now?')) {
					import_running = true;
					jQuery('#import_demo_data').attr('disabled', 'disabled');
					jQuery('#import_demo_loader').css('display', '');
					jQuery('#import_demo_info').css('display', '');
					jQuery.ajax({
						type: 'POST',
						url: '".admin_url('admin-ajax.php')."',
						data: {
							action: 'us_dataImport'
						},
						success: function(data, textStatus, XMLHttpRequest){
							import_running = false;
							jQuery('#import_demo_data').removeAttr('disabled');
							jQuery('#import_demo_loader').css('display', 'none');
							jQuery('#import_demo_info').css('display', 'none');

							alert('Import completed successfully!');
						},
						error: function(MLHttpRequest, textStatus, errorThrown){

						}
					});
				}
			}


			return false;
		});
	});
	</script>",
	"type" 		=> "info"
	);

$of_options[] = array( 	"name" 		=> "Logo",
	"desc" 		=> "Jpeg/Png/Gif Logo image.",
	"id" 		=> "custom_logo",
	"std" 		=> "",
	"type" 		=> "upload"
	);

$of_options[] = array( "name" => "Logo as text",
	"desc" => "Show text instead of image as Logo",
	"id" => "logo_as_text",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Logo text",
	"desc" => "",
	"id" => "logo_text",
	"std" => "",
	"fold" => "logo_as_text",
	"type" => "text");

$of_options[] = array( 	"name" 		=> "Favicon",
	"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
	"id" => "custom_favicon",
	"std" => "",
	"type" => "upload"
	);

//$of_options[] = array( "name" => "Responsive Design",
//	"desc" => "Use the responsive design features",
//	"id" => "responsive_design",
//	"std" => 1,
//	"type" => "switch");

$of_options[] = array( 	"name" 		=> "Google Analytics Tracking Code",
	"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
	"id" 		=> "tracking_code",
	"std" 		=> "",
	"type" 		=> "textarea");

$of_options[] = array( "name" => "Styling",
	"type" => "heading");

$of_options[] = array( "name" => "Predefined Color Style",
	"desc" => "",
	"id" => "color_scheme",
	"std" => "Midnight Turquoise",
	"type" => "select",
	"options" => array('Midnight Turquoise' => 'Midnight Turquoise', 'Mild Purple' => 'Mild Purple', 'Stylish Cyan' => 'Stylish Cyan', 'Juicy Green' => 'Juicy Green', 'Yellow-Brown' => 'Yellow-Brown', 'Good Vine' => 'Good Vine', 'White Orange' => 'White Orange', 'White Red' => 'White Red', 'White Green' => 'White Green', 'White Blue' => 'White Blue', 'Dark Orange' => 'Dark Orange', 'Twilight' => 'Twilight',));

/*--------------------------------------------------------------------------*/
$of_options[] = array( "name" => "Custom Color Style",
	"desc" => "Change <strong>Header</strong> Colors",
	"id" => "change_header_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Header Background color",
	"id" => "header_background",
	"std" => "#2c3e50",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Header Alternate Background Color",
	"id" => "header_background_alternative",
	"std" => "#253444",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Header Border Color",
	"id" => "header_border",
	"std" => "#2c3e50",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Fade Elements Color",
	"id" => "header_fade",
	"std" => "#75818a",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Navigation Color",
	"id" => "header_navigation",
	"std" => "#dadfe0",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Navigation Hover Color",
	"id" => "header_navigation_hover",
	"std" => "#ffffff",
	"fold" => "change_header_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Navigation Active Color",
	"id" => "header_navigation_active",
	"std" => "#1abc9c",
	"fold" => "change_header_colors",
	"type" => "color");
/*--------------------------------------*/
$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Main Content</strong> Colors",
	"id" => "change_main_content_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "main_background",
	"std" => "#ffffff",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Alternate Background Color",
	"id" => "main_background_alternative",
	"std" => "#ecf0f1",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "main_border",
	"std" => "#dce2e5",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "main_text",
	"std" => "#576676",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Heading Color",
	"id" => "main_heading",
	"std" => "#2c3e50",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Primary Color",
	"id" => "main_primary",
	"std" => "#1abc9c",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Secondary Color",
	"id" => "main_secondary",
	"std" => "#ffa412",
	"fold" => "change_main_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Fade Elements Color",
	"id" => "main_fade",
	"std" => "#9ba5a8",
	"fold" => "change_main_content_colors",
	"type" => "color");
/*--------------------------------------*/
$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Alternate Content</strong> Colors",
	"id" => "change_alternate_content_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "alt_background",
	"std" => "#ecf0f1",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Alternate Background Color",
	"id" => "alt_background_alternative",
	"std" => "#ffffff",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "alt_border",
	"std" => "#d0d6d9",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "alt_text",
	"std" => "#576676",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Heading Color",
	"id" => "alt_heading",
	"std" => "#2c3e50",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Primary Color",
	"id" => "alt_primary",
	"std" => "#1abc9c",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Secondary Color",
	"id" => "alt_secondary",
	"std" => "#ffa412",
	"fold" => "change_alternate_content_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Fade Elements Color",
	"id" => "alt_fade",
	"std" => "#9ba5a8",
	"fold" => "change_alternate_content_colors",
	"type" => "color");
/*--------------------------------------*/
$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>SubFooter</strong> Colors",
	"id" => "change_subfooter_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "subfooter_background",
	"std" => "#2c3e50",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "subfooter_border",
	"std" => "#415569",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "subfooter_text",
	"std" => "#a5aeb0",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Heading Color",
	"id" => "subfooter_heading",
	"std" => "#ffffff",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Color",
	"id" => "subfooter_link",
	"std" => "#dadfe0",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Hover Color",
	"id" => "subfooter_link_hover",
	"std" => "#ffa412",
	"fold" => "change_subfooter_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Fade Elements Color",
	"id" => "subfooter_fade",
	"std" => "#879598",
	"fold" => "change_subfooter_colors",
	"type" => "color");
/*--------------------------------------*/
$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Footer</strong> Colors",
	"id" => "change_footer_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Background Color",
	"id" => "footer_background",
	"std" => "#253444",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Border Color",
	"id" => "footer_border",
	"std" => "#253444",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Text Color",
	"id" => "footer_text",
	"std" => "#75818a",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Color",
	"id" => "footer_link",
	"std" => "#a5aeb0",
	"fold" => "change_footer_colors",
	"type" => "color");

$of_options[] = array( "name" =>  "",
	"desc" => "Link Hover Color",
	"id" => "footer_link_hover",
	"std" => "#ffa412",
	"fold" => "change_footer_colors",
	"type" => "color");
/*--------------------------------------*/
$of_options[] = array( "name" =>  "",
	"desc" => "Change <strong>Body</strong> Colors",
	"id" => "change_body_colors",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" =>  "",
	"desc" => "Body Background color",
	"id" => "body_background",
	"std" => "#ecf0f1",
	"fold" => "change_body_colors",
	"type" => "color");
/*--------------------------------------------------------------------------*/

$of_options[] = array( "name" => "Use Wide or Boxed layout?",
	"desc" => "",
	"id" => "layout",
	"std" => "Boxed",
	"type" => "select",
	"options" => array(
		'boxed' => 'Boxed',
		'wide' => 'Wide',
	));

$of_options[] = array( 	"name" => "Body Background Image",
	"desc" => "",
	"id" => "body_background_image",
	"std" => "",
	"type" => "upload"
	);

$of_options[] = array( "name" => "",
	"desc" => "Stretch Body Background Image",
	"id" => "body_background_image_stretch",
	"std" => 0,
	"type" => "switch");

$of_options[] = array( "name" => "Body Background Repeat",
	"desc" => "",
	"id" => "body_background_image_repeat",
	"type" => "select",
	"std" => 'Repeat',
	"options" => array(
		'repeat' => 'Repeat',
		'repeat-x' => 'Repeat Horizontally',
		'repeat-y' => 'Repeat Vertically',
		'no-repeat' => 'Do Not Repeat',
	));

$of_options[] = array( "name" => "Body Background Position",
	"desc" => "",
	"id" => "body_background_image_position",
	"type" => "select",
	"std" => 'top center',
	"options" => array(
		'top center' => 'top center',
		'top left' => 'top left',
		'top right' => 'top right',
		'bottom center' => 'bottom center',
		'bottom left' => 'bottom left',
		'bottom right' => 'bottom right',
		'center center' => 'center center',
		'center left' => 'center left',
		'center right' => 'center right',
	));

$of_options[] = array( "name" => "Body Background Attachment",
	"desc" => "",
	"id" => "body_background_image_attachment",
	"type" => "select",
	"std" => 'Background scrolls along with the body',
	"options" => array(
		'' => 'Background scrolls along with the body',
		'fixed' => 'Background is fixed with regard to the viewport',
	));

$of_options[] = array( 	"name" 		=> "Quick CSS",
	"desc" 		=> "Paste your CSS code. Do not include <strong>&lt;pre&gt;&lt;/pre&gt;</strong> tags or any html tag in this field.",
	"id" 		=> "custom_css",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array(	"name" => "Header Options",
	"type"=> "heading");

$of_options[] = array( "name" => "Sticky Header",
	"desc" => "Fix header on top of page during scroll",
	"id" => "header_is_sticky",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Search",
	"desc" => "Show Search widget in header",
	"id" => "header_show_search",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Mobile Navigation Start Width",
	"desc" => "If screen width is less than this value, main navigation transforms to mobile-friendly layout.",
	"id" => "mobile_nav_width",
	"std" => "1000",
	"type" => "text");

$of_options[] = array( "name" => "Extended Header",
	"desc" => "Show widgetized area above main header",
	"id" => "header_is_extended",
	"std" => 0,
	"folds" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "Header Phone",
	"desc" => "",
	"id" => "header_phone",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Email",
	"desc" => "",
	"id" => "header_email",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Facebook",
	"desc" => "",
	"id" => "header_social_facebook",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Twitter",
	"desc" => "",
	"id" => "header_social_twitter",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Google+",
	"desc" => "",
	"id" => "header_social_google",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header LinkedIn",
	"desc" => "",
	"id" => "header_social_linkedin",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header YouTube",
	"desc" => "",
	"id" => "header_social_youtube",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Vimeo",
	"desc" => "",
	"id" => "header_social_vimeo",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Flickr",
	"desc" => "",
	"id" => "header_social_flickr",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Instagram",
	"desc" => "",
	"id" => "header_social_instagram",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Behance",
	"desc" => "",
	"id" => "header_social_behance",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Pinterest",
	"desc" => "",
	"id" => "header_social_pinterest",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Skype",
	"desc" => "",
	"id" => "header_social_skype",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Tumblr",
	"desc" => "",
	"id" => "header_social_tumblr",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Dribbble",
	"desc" => "",
	"id" => "header_social_dribbble",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Header Vkontakte",
	"desc" => "",
	"id" => "header_social_vk",
	"std" => "",
	"fold" => "header_is_extended",
	"type" => "text");

$of_options[] = array( "name" => "Show Language",
	"desc" => "Show Language Widget",
	"id" => "header_show_language",
	"std" => 0,
	"type" => "switch");

$of_options[] = array( "name" => "Language Widget Type",
	"desc" => "",
	"id" => "header_language_type",
	"std" => "Your own links",
	"type" => "select",
	"options" => array(
		'own' => 'Your own links',
		'wpml' => 'WPML language switcher',
	));

$of_options[] = array( "name" => "Languages Amount",
	"desc" => "Only for Your own links",
	"id" => "header_language_amount",
	"std" => "2",
	"type" => "select",
	"options" => array(
		'2' => '2',
		'3' => '3',
		'4' => '4',
		'5' => '5',
		'6' => '6',
		'7' => '7',
		'8' => '8',
		'9' => '9',
		'10' => '10',
	));

$of_options[] = array( "name" => "Current Language",
	"desc" => "Current Language Code or Name",
	"id" => "header_language_1_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 2",
	"desc" => "Language 2 Code or Name",
	"id" => "header_language_2_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 2 URL",
	"id" => "header_language_2_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 3",
	"desc" => "Language 3 Code or Name",
	"id" => "header_language_3_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 3 URL",
	"id" => "header_language_3_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 4",
	"desc" => "Language 4 Code or Name",
	"id" => "header_language_4_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 4 URL",
	"id" => "header_language_4_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 5",
	"desc" => "Language 5 Code or Name",
	"id" => "header_language_5_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 5 URL",
	"id" => "header_language_5_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 6",
	"desc" => "Language 6 Code or Name",
	"id" => "header_language_6_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 6 URL",
	"id" => "header_language_6_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 7",
	"desc" => "Language 7 Code or Name",
	"id" => "header_language_7_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 7 URL",
	"id" => "header_language_7_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 8",
	"desc" => "Language 8 Code or Name",
	"id" => "header_language_8_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 8 URL",
	"id" => "header_language_8_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 9",
	"desc" => "Language 9 Code or Name",
	"id" => "header_language_9_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 9 URL",
	"id" => "header_language_9_url",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Language 10",
	"desc" => "Language 10 Code or Name",
	"id" => "header_language_10_name",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "",
	"desc" => "Language 10 URL",
	"id" => "header_language_10_url",
	"std" => "",
	"type" => "text");


$of_options[] = array(	"name" => "Footer Options",
						"type"=> "heading");

$of_options[] = array( "name" => "Copyright Text",
	"desc" => "",
	"id" => "footer_copyright",
	"std" => "",
	"type" => "text");

$of_options[] = array( "name" => "Subfooter Widgets",
	"desc" => "Show Subfooter Widgets",
	"id" => "footer_show_widgets",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => " Footer (copyright and menu)",
	"desc" => "Show Footer (copyright and menu)",
	"id" => "footer_show_footer",
	"std" => 1,
	"type" => "switch");

$of_options[] = array(	"name" => "Portfolio Options",
						"type"=> "heading");

$of_options[] = array( "name" => "Number of Items per Page",
	"desc" => "",
	"id" => "portfolio_items",
	"std" => "12",
	"type" => "text");

$of_options[] = array( "name" => "Portfolio Slug",
	"desc" => "",
	"id" => "portfolio_slug",
	"std" => "portfolio",
	"type" => "text");

$of_options[] = array( "name" => "Typography",
	"type" => "heading");

$of_options[] = array( 	"name" 		=> "Navigation Font",
	"desc" 		=> "",
	"id" 		=> "navigation_font",
	"std" 		=> "Open Sans",
	"type" 		=> "select_google_font",
	"preview" 	=> array(
		"text" => "Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;About&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Services&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Portfolio", //this is the text from preview box
		"size" => "15px" //this is the text size from preview box
	),
	"options" 	=> $google_fonts,
);

$of_options[] = array( "name" =>  "",
	"desc" => "Font Size in pixels",
	"id" => "nav_fontsize",
	"std" => "15",
	"type" => "text");

$of_options[] = array( 	"name" 		=> "Regular Text Font",
	"desc" 		=> "",
	"id" 		=> "body_text_font",
	"std" 		=> "Open Sans",
	"type" 		=> "select_google_font",
	"preview" 	=> array(
		"text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum tellus in purus condimentum pulvinar. Duis cursus bibendum dui, eget iaculis urna pharetra in. Praesent in enim ac ligula cursus laoreet.", //this is the text from preview box
		"size" => "14px" //this is the text size from preview box
	),
	"options" 	=> $google_fonts,
);

$of_options[] = array( "name" =>  "",
	"desc" => "Font Size in pixels",
	"id" => "regular_fontsize",
	"std" => "14",
	"type" => "text");
	
$of_options[] = array( "name" =>  "",
	"desc" => "Line Height in pixels",
	"id" => "regular_nav_lineheight",
	"std" => "24",
	"type" => "text");

$of_options[] = array( 	"name" 		=> "Headings",
	"desc" 		=> "",
	"id" 		=> "heading_font",
	"std" 		=> "Roboto Slab",
	"type" 		=> "select_google_font",
	"preview" 	=> array(
		"text" => "Heading Preview", //this is the text from preview box
		"size" => "24px" //this is the text size from preview box
	),
	"options" 	=> $google_fonts,
);

$of_options[] = array( "name" =>  "",
	"desc" => "H1 Font Size in pixels",
	"id" => "h1_fontsize",
	"std" => "36",
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H1 Line Height in pixels",
	"id" => "h1_lineheight",
	"std" => "46",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H2 Font Size in pixels",
	"id" => "h2_fontsize",
	"std" => "30",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H2 Line Height in pixels",
	"id" => "h2_lineheight",
	"std" => "40",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H3 Font Size in pixels",
	"id" => "h3_fontsize",
	"std" => "24",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H3 Line Height in pixels",
	"id" => "h3_lineheight",
	"std" => "34",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H4 Font Size in pixels",
	"id" => "h4_fontsize",
	"std" => "20",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H4 Line Height in pixels",
	"id" => "h4_lineheight",
	"std" => "30",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H5 Font Size in pixels",
	"id" => "h5_fontsize",
	"std" => "18",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H5 Line Height in pixels",
	"id" => "h5_lineheight",
	"std" => "26",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H6 Font Size in pixels",
	"id" => "h6_fontsize",
	"std" => "16",
	
	"type" => "text");

$of_options[] = array( "name" =>  "",
	"desc" => "H6 Line Height in pixels",
	"id" => "h6_lineheight",
	"std" => "24",
	
	"type" => "text");


$of_options[] = array( "name" => "Subset",
	"desc" => "Select characters subset for Google fonts.<br><strong>Please note: some fonts does not support particular subsets!</strong>",
	"id" => "font_subset",
	"std" => "latin",
	"type" => "select",
	"options" => $google_fonts_subsets,
);

$of_options[] = array( "name" => "Blog Options",
	"type" => "heading");

$of_options[] = array( "name" => "Sidebar at Blog Page",
	"desc" => "Sidebar position at blog page (Large Image and Small Image templates only)",
	"id" => "blog_sidebar_pos",
	"std" => "Right",
	"type" => "select",
	"options" => array(
		'right' => 'Right',
		'left' => 'Left',
		'none' => 'No Sidebar',
	));

$of_options[] = array( "name" => "Sidebar at Posts",
	"desc" => "Sidebar position at posts",
	"id" => "post_sidebar_pos",
	"std" => "Right",
	"type" => "select",
	"options" => array(
		'right' => 'Right',
		'left' => 'Left',
		'none' => 'No Sidebar',
	));
	
$of_options[] = array( "name" => "Read More Button",
	"desc" => "Show Read More button",
	"id" => "post_read_more",
	"std" => 1,
	"type" => "switch");
	
$of_options[] = array( "name" => "Post Meta",
	"desc" => "Show Author",
	"id" => "post_meta_author",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "",
	"desc" => "Show Categories",
	"id" => "post_meta_categories",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "",
	"desc" => "Show comments number",
	"id" => "post_meta_comments",
	"std" => 1,
	"type" => "switch");

$of_options[] = array( "name" => "",
	"desc" => "Show tags",
	"id" => "post_meta_tags",
	"std" => 1,
	"type" => "switch");

//$of_options[] = array( "name" => "Date Format",
//	"desc" => "<a href=\"http://codex.wordpress.org/Formatting_Date_and_Time\" target=\"_blank\">Formatting Date and Time</a>",
//	"id" => "blog_date_format",
//	"std" => "F jS, Y",
//	"type" => "text");

$of_options[] = array( "name" => "Related Posts",
	"desc" => "Show  list of posts with same tags at single post page",
	"id" => "post_related_posts",
	"std" => 1,
	"type" => "switch");

//$of_options[] = array( "name" => "Comments",
//	"desc" => "Show comments.",
//	"id" => "blog_comments",
//	"std" => 1,
//	"type" => "switch");


//$of_options[] = array( "name" => "Excerpt or Full Content",
//	"desc" => "Show the Excerpt or Full blog content on posts list",
//	"id" => "use_excert",
//	"std" => "Excerpt",
//	"type" => "select",
//	"options" => array('excerpt' => 'Excerpt', 'full' => 'Full Content'));

$of_options[] = array( "name" => "Excerpt Length",
	"desc" => "Input the number of words in the Excerpt",
	"id" => "blog_excerpt_length",
	"std" => "40",
	"type" => "text");
	
$of_options[] = array( "name" => "Default Blog Layout",
	"desc" => "Select blog layout for default front page",
	"id" => "blog_layout",
	"std" => "Large Image",
	"type" => "select",
	"options" => array(
		'large_image' => 'Large Image',
		'small_image' => 'Small Image',
		'grid' => 'Grid with AJAX load',
		'grid_paginated' => 'Grid with Pagination',
//		'simple' => 'Simple',
	));

$of_options[] = array( "name" => "Archives Layout",
	"desc" => "Select layout for Archives pages (Category Archive, Tagged Posts, Blog Archives)",
	"id" => "archive_layout",
	"std" => "Small Image",
	"type" => "select",
	"options" => array(
//		'simple' => 'Simple',
		'small_image' => 'Small Image',
		'large_image' => 'Large Image',
//		'grid' => 'Grid',
	));

// Theme Update Options
$of_options[] = array( 	"name" 		=> "Theme Update",
    "type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "TF_Update",
    "std" 		=> "Please enter your Themeforest username and Secret API Key below if you want to get update notifications for ASTRA theme.",
    "id" 		=> "themeforest_info",
    "type" 		=> "info"
);

$of_options[] = array( "name" => "ThemeForest User Name",
    "desc" => "",
    "id" => "themeforest_username",
    "std" => "",
    "type" => "text"
);

$of_options[] = array( "name" => "ThemeForest API Key",
    "desc" => "Copy API Key of your ThemeForest account here. Check this <a target='_blank' href='".get_template_directory_uri()."/img/find-api.png'>screenshot</a> for more info",
    "id" => "themeforest_api_key",
    "std" => "",
    "type" => "text"
);

// Backup Options
$of_options[] = array( 	"name" 		=> "Manage Options",
	"type" 		=> "heading"
);

$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
	"id" 		=> "of_backup",
	"std" 		=> "",
	"type" 		=> "backup",
	"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
);

				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
