# FirebaseNotificationBundle
A Bundle for Symfony2 projects to send notifications for mobile devices through Firebase Cloud Messaging API

## Setup

### Step 1: Download HypeMailchimp using composer

Add Firebase Notification in your composer.json:

```js
{
    "require": {
        "jp/firebase-notification-Bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "jp/firebase-notification-Bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new JP\FirebaseNotificationBundle(),
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
jp_firebase_notification:
    firebase_fcm:
        server_key: XXXXXX
```

## Usage

**Using service**

``` php
<?php
        $fcm = $this->get('firebase_fcm_client');
?>
```

##Example

###Create message and send message
``` php
<?php 
    $fcm = $this->get('hype_mailchimp');
    $fcm->createMessage('regular', array(
        'to' => 'XXXXXXXX',
        'title' => 'New message',
        'body' => 'Hello World!',
        'badge' => 1,
        'data' => array(
            'action' => "new_message"
        )
    ));
    $data = $fcm->sendMessage();
     var_dump($data);
?>
```
