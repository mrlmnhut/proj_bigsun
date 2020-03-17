<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc53c06361dfa4f223f81ea4ac493255a{

	private static $loader;

	public static function loadClassLoader($class){
		if ('Composer\Autoload\ClassLoader' === $class){
			require __DIR__ . '/ClassLoader.php';
		}
	}

	public static function getLoader(){
		if (NULL !== self::$loader){
			return self::$loader;
		}

		spl_autoload_register(['ComposerAutoloaderInitc53c06361dfa4f223f81ea4ac493255a', 'loadClassLoader'],
			TRUE, TRUE);
		self::$loader = $loader = new \Composer\Autoload\ClassLoader();
		spl_autoload_unregister(['ComposerAutoloaderInitc53c06361dfa4f223f81ea4ac493255a', 'loadClassLoader']);

		$useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
		if ($useStaticLoader){
			require_once __DIR__ . '/autoload_static.php';

			call_user_func(\Composer\Autoload\ComposerStaticInitc53c06361dfa4f223f81ea4ac493255a::getInitializer($loader));
		}else{
			$map = require __DIR__ . '/autoload_namespaces.php';
			foreach ($map as $namespace => $path){
				$loader->set($namespace, $path);
			}

			$map = require __DIR__ . '/autoload_psr4.php';
			foreach ($map as $namespace => $path){
				$loader->setPsr4($namespace, $path);
			}

			$classMap = require __DIR__ . '/autoload_classmap.php';
			if ($classMap){
				$loader->addClassMap($classMap);
			}
		}

		$loader->register(TRUE);

		if ($useStaticLoader){
			$includeFiles = Composer\Autoload\ComposerStaticInitc53c06361dfa4f223f81ea4ac493255a::$files;
		}else{
			$includeFiles = require __DIR__ . '/autoload_files.php';
		}
		foreach ($includeFiles as $fileIdentifier => $file){
			composerRequirec53c06361dfa4f223f81ea4ac493255a($fileIdentifier, $file);
		}

		return $loader;
	}
}

function composerRequirec53c06361dfa4f223f81ea4ac493255a($fileIdentifier, $file){
	if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])){
		require $file;

		$GLOBALS['__composer_autoload_files'][$fileIdentifier] = TRUE;
	}
}