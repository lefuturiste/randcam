<?php

use Psr\Container\ContainerInterface;

return [
	'settings.displayErrorDetails' => function (ContainerInterface $container) {
		return $container->get('app_debug');
	},
	'settings.debug' => function (ContainerInterface $container) {
		return $container->get('app_debug');
	},

	'notFoundHandler' => function (ContainerInterface $container) {
		return new \App\NotFoundHandler();
	},

	\Monolog\Logger::class => function (ContainerInterface $container) {
		$log = new Monolog\Logger($container->get('app_name'));

		$log->pushHandler(new Monolog\Handler\StreamHandler($container->get('log')['path'], $container->get('log')['level']));

		if ($container->get('log')['discord']) {
			$log->pushHandler(new \DiscordHandler\DiscordHandler(
				$container->get('log')['discord_webhooks'],
				$container->get('app_name'),
				$container->get('env_name'),
				$container->get('log')['level']
			));
		}

		return $log;
	},

	\MongoDB\Client::class => function (ContainerInterface $container) {
        return new \MongoDB\Client($container->get('mongodb_uri'));
    },

    \GuzzleHttp\Client::class => function (ContainerInterface $container) {
        return new \GuzzleHttp\Client(['connect_timeout' => $container->get('default_timeout')]);
    }
];
