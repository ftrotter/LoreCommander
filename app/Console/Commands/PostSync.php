<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class PostSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:post_sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update higher level data after sync';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

	$pdo = \DB::connection()->getPdo();

	        
	$sql = [];

//	This might seem simple, but we do not want to polute the creature types with 
//	entried from the funny sets luke Unhinged and Unglued
//	which requires us to join to the card so we can join to the mtgset where that information is stored.
//	we exlude all of the set_type = 'funny' creature types


	$sql_make_creature = "
INSERT IGNORE lore.creature 
SELECT DISTINCT
	NULL AS id,
    	TRIM(SUBSTRING_INDEX(type_line,'—',-1)) AS creature_name,
	NULL AS creature_image_url,
	CURRENT_TIME AS created_at,
	CURRENT_TIME AS updated_at
FROM lore.cardface 
JOIN lore.card ON 
	cardface.card_id =
	card.id
JOIN lore.mtgset ON 
	mtgset.id =
	mtgset_id
WHERE 
	`type_line` LIKE '%creature%' 
	AND type_line NOT LIKE '%Token%'
	AND mtgset.set_type != 'funny'
ORDER BY creature_name
";

	$this->info("Running $sql_make_creature");
	$count = $pdo->exec($sql_make_creature);

	$this->info("Added $count new creatures\n");


	//now we need to tokenize. Easier to do in php.

	$select_creature_sql = "
SELECT id, creature_name FROM lore.creature 
";
	
	$results = DB::select($select_creature_sql);

	$creature_tokens = [];
	$creature_to_token = [];
	foreach($results as $this_row){
		$creature = trim($this_row->creature_name);
		$creature_list = explode(' ',$creature);
		foreach($creature_list as $this_token){
			$this_token = trim($this_token);
			$creature_tokens[$this_token] = $this_token;
			$creature_to_tokens[$this_row->id][] = $this_token;
		}
	}

	$disallowed_list = [
		'Legendary',
		'Enchantment',
		'Equipment',
		'Land',
		'//',
	];

	//now we need to save the creature tokens to the database...
	//as classofc(reature) entries...

	$token_map = [];
	foreach($creature_tokens as $this_token){


		if(in_array($this_token,$disallowed_list)){
			//then do nothing..
		}else{
			//then add it to the list...
			$this_token = trim($this_token);
			$q_this_token = $pdo->quote($this_token);

			$insert_sql = "
INSERT IGNORE INTO 
lore.classofc (`id`, `classofc_name`, `created_at`, `updated_at`) 
	VALUES 
(NULL, TRIM($q_this_token), CURRENT_TIME(), CURRENT_TIME());
";

			$count  =  $pdo->exec($insert_sql);
			if($count > 0){
			//	echo '.';
			}
		}
	}

	//echo "\n";

	$this->info("Done inserting new class of creature");

	//now we want  to build the links between the creatures and the classofc(reature)


	//we need all the classes
	$all_creature_class_sql = "
SELECT * FROM lore.classofc
";
	
	$results = DB::select($all_creature_class_sql);

	//put them into a local array indexed by id
	$all_class_of_creature = [];
	foreach($results as $this_row){
		$all_class_of_creature[$this_row->id]  = [
				'id' =>  $this_row->id,
				'classofc_name' => $this_row->classofc_name,
				'is_mega_class' => $this_row->is_mega_class,
			];
	}

	//loop over the classes and search for the class name in the creature table
	//and then link the correspoding creature rows to the class row. 

	$this->info("Associating creature class and creatures");

	foreach($all_class_of_creature as $coc_id => $class_of_creature_array){
		if(!$class_of_creature_array['is_mega_class']){ //there is a different system for the megaclasses
			$name = $class_of_creature_array['classofc_name'];
			$insert_sql = "
INSERT IGNORE lore.classofc_creature
SELECT 
	NULL AS id,
	$coc_id AS classofc_id,
	creature.id AS creature_id,
	CURRENT_TIME AS created_at,
	CURRENT_TIME AS updated_at
FROM lore.creature 
WHERE creature.creature_name LIKE '%$name%'
";
	
			$count  =  $pdo->exec($insert_sql);
			if($count > 0){
				echo 'c';
			}

		}
	}

	$this->info("finished linking creature types and creature classes\n");


	//now we want to link the classes to the cards...

	//again we do not want to fart around with the funny sets..
	//so we do lots of joining to make sure the cardface is a legit card.

	foreach($all_class_of_creature as $coc_id => $class_of_creature_array){
		if(!$class_of_creature_array['is_mega_class']){ //there is a different system for the megaclasses
			$name = $class_of_creature_array['classofc_name'];
			$insert_sql = "
INSERT IGNORE lore.classofc_cardface
SELECT 
	NULL AS id,
	cardface.id AS cardface_id,
	$coc_id AS classofc_id,
	CURRENT_TIME AS created_at,
	CURRENT_TIME AS updated_at
FROM lore.cardface
JOIN lore.card ON 
	cardface.card_id =
	card.id
JOIN lore.mtgset ON 
	mtgset.id =
	mtgset_id
WHERE 
	`type_line` LIKE '%creature%' 
	AND type_line NOT LIKE '%Token%'
	AND mtgset.set_type != 'funny'
	AND cardface.type_line LIKE '%$name%'
";

	
			$count  =  $pdo->exec($insert_sql);
			if($count > 0){
				//echo 'C';
			}

		}
	}

	//now we repeat the whole process for all creature types which are in lore.creature
	//first load them into memory...
	$all_creature_type_sql = "
SELECT * FROM lore.creature
";
	
	$results = DB::select($all_creature_class_sql);
	//put them into a local array indexed by id

	//create an array where they will live...
	$all_creature = [];
	foreach($results as $this_row){
		$all_creature[$this_row->id]  = [
				'id' =>  $this_row->id,
				'creature_name' => $this_row->classofc_name,
			];
	}

	$c_links_total = 0;
	//now lets link the cardfaces to the creatures
	foreach($all_creature as $c_id => $creature_array){
		$name = $creature_array['creature_name'];
		//this SQL will link all of the cardfaces that have the mention of the creature name...
		//and avoid token and the funny card sets...
		$insert_sql = "
INSERT IGNORE lore.creature_cardface
SELECT 
	NULL AS id,
	cardface.id AS cardface_id,
	$c_id AS creature_id,
	CURRENT_TIME AS created_at,
	CURRENT_TIME AS updated_at
FROM lore.cardface
JOIN lore.card ON 
	cardface.card_id =
	card.id
JOIN lore.mtgset ON 
	mtgset.id =
	mtgset_id
WHERE 
	`type_line` LIKE '%creature%' 
	AND type_line NOT LIKE '%Token%'
	AND mtgset.set_type != 'funny'
	AND cardface.type_line LIKE '%$name%'
";

	
		$count  =  $pdo->exec($insert_sql);
		if($count > 0){
			$c_links_total += $count;
			//echo 'c';
		}
		
	}


	$this->info("Finished linking creature with specific cards made $c_links_total new connections");


	$populate_fulltext_sql = "
UPDATE lore.cardface SET  for_fulltext_search = CONCAT(' ', CONCAT_WS(' | ',
	REGEXP_REPLACE(name, '[^a-zA-Z0-9]',' '), 
	REGEXP_REPLACE(oracle_text, '[^a-zA-Z0-9]',' '),
	REGEXP_REPLACE(flavor_text, '[^a-zA-Z0-9]',' '),
	REGEXP_REPLACE(type_line, '[^a-zA-Z0-9]',' '), 
	REGEXP_REPLACE(artist, '[^a-zA-Z0-9]',' ') )
	,' '); 
";

	$count = $pdo->exec($populate_fulltext_sql);
	$this->info("Created fulltext search field for cardface with $count cardface changes");



	//convert the easy cases for collector number to sortable collector number...
	$sql[] = "
UPDATE  `card` SET 
sortable_collector_number = CAST( collector_number AS DECIMAL(10,2))
WHERE `collector_number` REGEXP '^[[:digit:]]*$'
";

	foreach($sql as $this_sql){

		$this->info("Running\n $this_sql");
		$pdo->query($this_sql);

	}



	$prefix_problem_sql = "
SELECT `collector_number`
FROM lore.card
WHERE 
`collector_number` NOT REGEXP '^[[:digit:]]*$'
GROUP BY collector_number
";

	$result = $pdo->query($prefix_problem_sql);
	$rows = $result->fetchAll(\PDO::FETCH_ASSOC);

	foreach($rows as $row){
		$collector_number = $row['collector_number'];
		//not we need to convert this into a sortable decimal... 
		//for now, just adding .1 is enough... 

		$sortable_collector_number = (int) filter_var($collector_number, FILTER_SANITIZE_NUMBER_INT); //thanks https://stackoverflow.com/a/12582416/144364

		$sortable_collector_number = abs($sortable_collector_number); //the above function treats the dashes in strings a negatives 
	
		$sortable_collector_number = $sortable_collector_number + .1;

		$this->info("Converting collector number $collector_number to $sortable_collector_number for sorting");
	
		$update_sql = "
UPDATE lore.card SET sortable_collector_number = $sortable_collector_number 
WHERE collector_number = '$collector_number'
";	

		$count = $pdo->exec($update_sql);

	}



	$sql = []; //start over...	

	//we are going to take the GW Basic lesson and order with some space so the first binder sort group will be 10, then 20, etc etc.

	$sql['mark colorless non-artificats as 10'] = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 10 
WHERE is_colorless = 1 AND cardface.name NOT LIKE '%Artifact%'
";

	$sql['mark simple white as 20']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 20 
WHERE is_color_white = 1 
AND is_color_green = 0
AND is_color_blue = 0
AND is_color_red = 0
AND is_color_black = 0
";	


	$sql['mark simple blue as 30']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 30 
WHERE is_color_white = 0 
AND is_color_green = 0
AND is_color_blue = 1
AND is_color_red = 0
AND is_color_black = 0
";	

	$sql['mark simple black as 40']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 40 
WHERE is_color_white = 0 
AND is_color_green = 0
AND is_color_blue = 0
AND is_color_red = 0
AND is_color_black = 1
";	

	$sql['mark simple red as 50']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 50 
WHERE is_color_white = 0 
AND is_color_green = 0
AND is_color_blue = 0
AND is_color_red = 1
AND is_color_black = 0
";	

	$sql['mark simple green as 60']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 60 
WHERE is_color_white = 0 
AND is_color_green = 1
AND is_color_blue = 0
AND is_color_red = 0
AND is_color_black = 0
";	

	//figuring out multicolored is a little more complicated
	$sql['mark multicolored cards as 70']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 70 
WHERE 
	is_color_white = 1 AND (is_color_green = 1 OR is_color_red = 1 OR is_color_blue = 1 OR is_color_black = 1)
OR 
	is_color_blue = 1 AND (is_color_green = 1 OR is_color_red = 1 OR is_color_white = 1 OR is_color_black = 1)
OR 
	is_color_black = 1 AND (is_color_green = 1 OR is_color_red = 1 OR is_color_white = 1 OR is_color_blue = 1)
OR 
	is_color_red = 1 AND (is_color_green = 1 OR is_color_blue = 1 OR is_color_white = 1 OR is_color_black = 1)
OR 
	is_color_green = 1 AND (is_color_blue = 1 OR is_color_red = 1 OR is_color_white = 1 OR is_color_black = 1)
";	


	$sql['mark artifacts as 80']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 80 
WHERE 
	type_line LIKE '%Artifact%'
";	


	//we do lands first, setting it to 100, and then we set basic lands to 90, because that is easier to read... 
	//but it does make the sequence critical...
	$sql['mark lands as 100']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 100
WHERE 
	type_line LIKE '%Land%'
";	

	$sql['mark basic lands as 90']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 90
WHERE 
	type_line LIKE '%Basic Land%'
";	

	$sql['mark tokens as 110']  = "
UPDATE lore.card 
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
SET card.binder_group_number = 110
WHERE 
	type_line LIKE '%Token%'
";	


	foreach($sql as $comment =>  $this_sql){

		
		$this->info("$comment\n Running\n $this_sql");
		$pdo->query($this_sql);

	}

                $hping_result = \CareSet\Util::hping('HC_POST_SYNC_URL');
                $this->info($hping_result);



    }
}
