<?php

namespace MiniFranske\Cravatar\AvatarProvider;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Backend\Avatar\Image;
use TYPO3\CMS\Backend\Backend\Avatar\AvatarProviderInterface;
use TYPO3\CMS\Backend\Routing\Exception\RouteNotFoundException;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class CravatarProvider
 */
class CravatarProvider implements AvatarProviderInterface
{

    /**
     * @var array
     */
    static protected $defaultConfiguration = [
        'fallback' => '',
        'fallbackImageUrl' => '',
        'forceProvider' => false,
        'useProxy' => false,
    ];

    /**
     * @var array
     */
    static protected $configuration;

    /**
     * Get Cravatar configuration
     *
     * @return array
     */
    protected static function getConfiguration(): array
    {
        if (self::$configuration === null) {
            // Extension Configuration
            try {
                self::$configuration = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('cravatar');
            } catch (\Exception $exception) {
                // do nothing
            }

            if (!is_array(self::$configuration) || empty(self::$configuration)) {
                self::$configuration = self::$defaultConfiguration;
            }
        }

        return self::$configuration;
    }

    /**
     * Get Image
     *
     * @param array $backendUser be_user record
     * @param int $size
     * @return Image|NULL
     * @throws RouteNotFoundException
     */
    public function getImage(array $backendUser, $size): ?Image
    {
        $image = null;
        $configuration = self::getConfiguration();
        if (empty($backendUser['email']) && empty($configuration['forceProvider'])) {
            return $image;
        }

        $fallback = $configuration['fallback'] === 'url' ? $configuration['fallbackImageUrl'] : $configuration['fallback'];
        if ($fallback === '') {
            $fallback = 'blank';
        }

        $size = min(2048, $size);
        $md5 = md5(strtolower($backendUser['email'] ?: $backendUser['username']));

        if (!empty($configuration['useProxy'])) {
            // change to proxy url
            $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
            $uri = (string)$uriBuilder->buildUriFromRoute(
                'cravatar',
                ['md5' => $md5, 'size' => $size, 'd' => $fallback],
                UriBuilder::ABSOLUTE_URL);
        } else {
            $uri = 'https://www.cravatar.cn/avatar/' . $md5 . '?s=' . $size . '&d=' . urlencode($fallback);
        }

        $image = GeneralUtility::makeInstance(
            Image::class,
            $uri,
            $size,
            $size
        );

        return $image;
    }
}
