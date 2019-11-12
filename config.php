<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

function parse_heroku_postgres_url_string($url_string) {
	$parts = parse_url($url_string);
	return [
		'username'	=> $parts['user'],
		'password'	=> $parts['pass'],
		'hostname'	=> $parts['host'],
		'database'	=> substr($parts['path'], 1),
		'port'		=> $parts['port'],
	];
}

$parsed = parse_heroku_postgres_url_string(getenv('DATABASE_URL'));
var_dump($parsed['hostname']);

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('DATABASE_HOST');
$CFG->dbname    = getenv('DATABASE_NAME');
$CFG->dbuser    = getenv('DATABASE_USER');
$CFG->dbpass    = getenv('DATABASE_PASSWORD');
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => getenv('DATABASE_PORT'),
  'dbsocket' => '',
);

$CFG->wwwroot   = getenv('WWWROOT');
$CFG->dataroot  = getenv('DATAROOT');
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
