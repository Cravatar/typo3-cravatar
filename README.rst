=================================================================
EXT:cravatar AvatarProvider for Cravatar support in TYPO3 backend
=================================================================

Since TYPO3 7.4 there is avatar support in the back-end of TYPO3 CMS. An "avatar" is an image that represents you
online, a little picture that appears next to your name on various places in the back-end of the CMS.


**What is Cravatar?**

A Cravatar is a China Recognized Avatar. You upload it and create your profile just once, and then when you participate in any Cravatar-enabled site, your Cravatar image will automatically follow you there.
Cravatar is a free service for site owners, developers, and users. For more info visit: https://cravatar.cn.


**QuickStart:**

Install extension and that's it. Cravatar support is enabled for BE users with an email address set and no avatar image.

By default Cravatar is only used when a user hasn't an avatar image linked to his account an email address set.
But optional the email address check can be disabled so also BE users without email address set can get a
generated image provided by Cravatar.


**How to use:**

1. Download and install cravatar in the extension manager
   Or use composer ``composer require minifranske/cravatar`` and install extension in the extension manager

2. *Optional (by default the Cravatar service is now enabled and will be used for BE users without avatar image and with email address set):*

   Set a fallback behaviour through extensions configuration (see extension manager)


**Features:**

- Supports all fallback options provided by cravatar.cn see https://www.cravatar.cn/site/implement/images/

  - **mm:** (mystery-man) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
  - **identicon:** a geometric pattern based on an email hash
  - **monsterid:** a generated 'monster' with different colors, faces, etc
  - **wavatar:** generated faces with differing features and backgrounds
  - **retro:** awesome generated, 8-bit arcade-style pixelated faces
  - **blank:** a transparent PNG image

- Can also be used to show generated Cravatar image for BE users without email address

- Proxy for Cravatar images: Instead of generating images which point to Cravatars-servers, use a proxy.
This improves privacy a bit, because your users will not request the images directly from Cravatar. **Note**: Cravatar will still receive the hashed email addresses.
This feature is disabled by default and can be enabled in extension configuration with `privacy.useProxy`.


**Requirements:**
    For TYPO3 >=7.5,=<9.5 use version ^1 ``composer require minifranske/cravatar:^1``

    TYPO3 >=10 use version ^2 ``composer require minifranske/cravatar``
