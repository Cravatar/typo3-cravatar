<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['backend']['avatarProviders']['cravatarProvider'] = [
    'provider' => \MiniFranske\Cravatar\AvatarProvider\CravatarProvider::class,
    'after' => ['defaultAvatarProvider']
];
