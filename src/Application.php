<?php


namespace As247\Fact;

use As247\Fact\Events\Dispatcher;
use As247\Fact\Database\Capsule\Manager;
use As247\Fact\Database\WpConnection;
use As247\Fact\Support\Facades\Facade;

class Application
{
	/**
	 * @var Application
	 */
	protected static $instance;
	protected $manager;
	protected function __construct(){
		$this->manager=new Manager();
	}
	protected function setupWp($useWpConnection=true){
		if($useWpConnection) {
			$this->manager->addConnection([], 'wp');
			$this->manager->getDatabaseManager()->extend('wp', function () {
				return WpConnection::instance();
			});
			$this->manager->getDatabaseManager()->setDefaultConnection('wp');
		}else{
			global $wpdb;
			$dbuser     = defined( 'DB_USER' ) ? DB_USER : '';
			$dbpassword = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : '';
			$dbname     = defined( 'DB_NAME' ) ? DB_NAME : '';
			$dbhost     = defined( 'DB_HOST' ) ? DB_HOST : '';
			$charset=$wpdb->charset;
			$collate=$wpdb->collate;
			$this->setupConnection([
				'driver'    => 'mysql',
				'host'      => $dbhost,
				'database'  => $dbname,
				'username'  => $dbuser,
				'password'  => $dbpassword,
				'charset'   => $charset,
				'collation' => $collate,
				'prefix'    => $wpdb->base_prefix,
			]);
		}
	}
	protected function setupConnection($connection=[]){
		$this->manager->addConnection($connection);
	}
	protected function setupEloquent(){
		$app=$this->manager->getContainer();
		$app->instance('db',$this->manager->getDatabaseManager());
		Facade::setFacadeApplication($app);
		$this->manager->setEventDispatcher(new Dispatcher($app));
		$this->manager->bootEloquent();
	}
	public static function bootWp($useWpConnection=true){
		if(!static::$instance){
			static::$instance=new static();
			static::$instance->setupWp($useWpConnection);
			static::$instance->setupEloquent();
		}
		return static::$instance;
	}
	public static function boot($connection=[]){
		if(!static::$instance){
			static::$instance=new static();
			static::$instance->setupConnection($connection);
			static::$instance->setupEloquent();
		}
		return static::$instance;
	}
}
