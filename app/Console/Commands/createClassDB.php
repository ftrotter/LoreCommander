<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class createClassDB extends AbstractETLCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scry:create_class_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Given the populated card database make class databases';

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

	$m20 = 8;
	$war = 15;
	$mh1 = 11;

	$set_where_sql = " mtgset_id IN ($m20, $war, $mh1) ";

	$db = 'card'; //so that we can change it easily later	

	$sql = []; //start the array that we will pass to be executed

	$sql['drop existing card table'] = "
DROP TABLE IF EXISTS $db.card
";

	$sql['create card table'] = "
CREATE TABLE $db.card AS 
SELECT 
	`name` AS card_name, 
	`artist`, 
	`flavor_text`, 
	`image_uri`, 
	`mana_cost`, 
	`cmc`, 
	`oracle_text`, 
	`power`, 
	`toughness`,
	`type_line`, 
	`border_color`, 
	`image_uri_normal`,  
	`is_oversized`, `is_color_green`, `is_color_red`, `is_color_blue`, `is_color_black`, `is_color_white`, `is_colorless`, 
	`color_count`,
	`scryfall_web_uri`
FROM lore.card
JOIN lore.cardface ON 
	cardface.card_id =
	card.id
WHERE $set_where_sql
";

	$sql['index card'] = "
ALTER TABLE $db.card ADD `id` INT(11) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
";

	$sql['drop larry'] = "
DROP TABLE IF EXISTS $db.larry_card
";
	
	$sql['create larry'] = "
CREATE TABLE $db.larry_card
SELECT DISTINCT
	card_name,
	artist,
	image_uri,
	oracle_text,
	mana_cost,
	FLOOR(cmc) AS cmc,
	power,
	toughness,
	type_line
FROM $db.card
";


	$sql['drop mo land card'] = "
DROP TABLE IF EXISTS $db.mo_LandCard
";
	
	$sql['create mo land card'] = "
CREATE TABLE $db.mo_LandCard 
SELECT DISTINCT
	card_name,
	GROUP_CONCAT(artist) AS artist_list,
	oracle_text AS land_text,
	IF(type_line LIKE '%mountain%',1,0) AS is_mountain,
	IF(type_line LIKE '%island%',1,0) AS is_island,
	IF(type_line LIKE '%plains%',1,0) AS is_plains,
	IF(type_line LIKE '%swamp%',1,0) AS is_swamp,
	IF(type_line LIKE '%forest%',1,0) AS is_forest,
	IF(type_line LIKE '%basic%',1,0) AS is_basic_land
FROM $db.card
WHERE type_line LIKE '%land%'
";

	$sql['drop mo creature card'] = "
DROP TABLE IF EXISTS $db.mo_CreatureCard
";
	
	$sql['create mo creature card'] = "
CREATE TABLE $db.mo_CreatureCard 
SELECT DISTINCT
	card_name AS creature_name,
	artist,
	oracle_text AS creature_text,
	TRIM(SUBSTRING_INDEX(type_line,'—',-1)) AS creature_type,
	IF(oracle_text LIKE '%changeling%',1,0) AS is_changeling,
	power AS power_char,
	toughness AS toughness_char,
	FLOOR(cmc) AS cmc,
	CAST(power AS int) AS power_score,
	CAST(toughness AS int) AS toughness_score,
	IF(CAST(toughness AS int) = 0,1,0) is_variable_toughness,
	10.25 AS creature_score
FROM $db.card
WHERE type_line LIKE '%creature%'
";
	//we need to make a score that reflects the cost of a creature, based on its toughness added to its power..
	//but we sometimes multiple by zero... to that is bad...
	$sql['calculate creature score'] = "
UPDATE  $db.mo_CreatureCard SET `creature_score` = (`power_score` + `toughness_score`) / (IF(`cmc` * 2 = 0, 1, `cmc` * 2))
";
	//things that have zeros are actually pretty good creatures... lets manually set them to zero..
	$sql['make things that are 0 into 1'] = "
UPDATE  $db.mo_CreatureCard SET `creature_score` = 1
WHERE creature_score = 0
";


	$sql['drop mo walker'] = "
DROP TABLE IF EXISTS $db.mo_NotCreatureCard
";
	
	$sql['create mo walker'] = "
CREATE TABLE $db.mo_NotCreatureCard 
SELECT DISTINCT
	card_name AS spell_name,
	artist,
	oracle_text AS spell_text,
	IF(type_line LIKE '%instant%',1,0) AS is_instant,
	IF(type_line LIKE '%sorcery%',1,0) AS is_sorcery,
	IF(type_line LIKE '%enchantment%',1,0) AS is_enchantment
FROM $db.card
";

	$sql['drop mo'] = "
DROP TABLE IF EXISTS $db.mo_PlanesWalkerCard
";
	
	$sql['create mo'] = "
CREATE TABLE $db.mo_PlanesWalkerCard 
SELECT DISTINCT
	card_name AS planeswalker_card_name,
	TRIM(SUBSTRING_INDEX(card_name,',',1)) AS planewalker_name,
	oracle_text AS spell_text
FROM $db.card
WHERE type_line LIKE '%Planeswalker%'
";

	$sql['index the planeswalker card name'] = "
ALTER TABLE $db.`mo_PlanesWalkerCard` ADD PRIMARY KEY(`planeswalker_card_name`); 
";

	//manual trimming...
	$sql['trim serra'] = "UPDATE $db.`mo_PlanesWalkerCard` SET `planewalker_name` = 'Serra' WHERE `mo_PlanesWalkerCard`.`planeswalker_card_name` = 'Serra the Benevolent';   ";
	$sql['trim sarkhan'] = "UPDATE $db.`mo_PlanesWalkerCard` SET `planewalker_name` = 'Sarkhan' WHERE `mo_PlanesWalkerCard`.`planeswalker_card_name` = 'Sarkhan the Masterless';   ";
	$sql['trim gideon'] = " UPDATE $db.`mo_PlanesWalkerCard` SET `planewalker_name` = 'Gideon' WHERE `mo_PlanesWalkerCard`.`planeswalker_card_name` = 'Gideon Blackblade';   ";
	$sql['trim '] = "  ";


	$sql['drop curly'] = "
DROP TABLE IF EXISTS $db.curly_card
";

	$sql['create curly'] = "
CREATE TABLE $db.curly_card AS 
SELECT 
	card_name, 
	`flavor_text`, 
	`mana_cost`, 
	`cmc`, 
	`oracle_text`, 
	`type_line`, 
	`image_uri_normal`,  
	`is_color_green`, `is_color_red`, `is_color_blue`, `is_color_black`, `is_color_white`, `is_colorless`, 
	`color_count`,
	`scryfall_web_uri`
FROM $db.card 
";

	$is_echo_sql = true; //need to see what is going on as we develop...

	$this->run_sql_loop($sql,$is_echo_sql);

    }

	


}
