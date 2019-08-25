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

	
        
	$sql = [];
	
/*
	This might seem simple, but we do not want to polute the creature types with 
	entried from the funny sets luke Unhinged and Unglued
	which requires us to join to the card so we can join to the mtgset where that information is stored.
	we exlude all of the set_type = 'funny' creature types
*/
	$pdo = \DB::connection()->getPdo();

	$sql_make_creature = "
INSERT IGNORE lore.creature 
SELECT DISTINCT
	NULL AS id,
    	TRIM(SUBSTRING_INDEX(type_line,'—',-1)) AS creature_name,
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
	$pdo->query($sql_make_creature);



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
		'Land',
		'//',
	];

	//now we need to save the creature tokens to the database...
	//as creatureclass entries...

	$token_map = [];
	foreach($creature_tokens as $this_token){


		if(in_array($this_token,$disallowed_list)){
			//then do nothing..
		}else{
			//then add it to the list...

			$q_this_token = $pdo->quote($this_token);

			$insert_sql = "
INSERT IGNORE INTO 
lore.creatureclass (`id`, `creatureclass_name`, `created_at`, `updated_at`) 
	VALUES 
(NULL, TRIM($q_this_token), CURRENT_TIME(), CURRENT_TIME());
";

			$count  =  $pdo->exec($insert_sql);
			if($count > 0){
				echo '.';
			}
		}
	}

	echo "\n";

	echo "Done inserting new creature types";

	foreach($sql as $this_sql){

		$this->info("Running\n $this_sql");
		$pdo->query($this_sql);

	}


    }
}
