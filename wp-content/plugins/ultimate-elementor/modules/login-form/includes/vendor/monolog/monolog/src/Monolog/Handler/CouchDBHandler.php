<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Handler;

use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * CouchDB handler
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class CouchDBHandler extends AbstractProcessingHandler{

	private $options;

	public function __construct(array $options = [], $level = Logger::DEBUG, $bubble = TRUE){
		$this->options = array_merge([
			'host'     => 'localhost',
			'port'     => 5984,
			'dbname'   => 'logger',
			'username' => NULL,
			'password' => NULL,
		], $options);

		parent::__construct($level, $bubble);
	}

	/**
	 * {@inheritDoc}
	 */
	protected function write(array $record){
		$basicAuth = NULL;
		if ($this->options['username']){
			$basicAuth = sprintf('%s:%s@', $this->options['username'], $this->options['password']);
		}

		$url     = 'http://' . $basicAuth . $this->options['host'] . ':' . $this->options['port'] . '/' . $this->options['dbname'];
		$context = stream_context_create([
			'http' => [
				'method'        => 'POST',
				'content'       => $record['formatted'],
				'ignore_errors' => TRUE,
				'max_redirects' => 0,
				'header'        => 'Content-type: application/json',
			],
		]);

		if (FALSE === @file_get_contents($url, NULL, $context)){
			throw new \RuntimeException(sprintf('Could not connect to %s', $url));
		}
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getDefaultFormatter(){
		return new JsonFormatter(JsonFormatter::BATCH_MODE_JSON, FALSE);
	}
}
