<?php

return [
	'cravatar' => [
		'path' => '/cravatar',
		'target' => \MiniFranske\Cravatar\Controller\ProxyController::class . '::proxyAction',
	],
];