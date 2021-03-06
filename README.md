# FirebaseNotificationBundle
A Bundle for Symfony4 projects to send notifications for mobile devices through Firebase Cloud Messaging API

## Setup

### Step 1: Download FirebaseNotificationBundle using composer

Add Firebase Notification in your composer.json:

```js
{
    "require": {
        "jp/firebase-notification-Bundle": "^2.0.0"
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
        new JP\FirebaseNotificationBundle\JPFirebaseNotificationBundle()
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
    $fcm = $this->get('firebase_fcm_client');
    $fcm->createMessage(array(
        'to' => 'XXXXXXXX',
        'title' => 'New message',
        'body' => 'Hello World!',
        'badge' => 1,
        'data' => array(
            'action' => "new_message"
        )
    ));
    $data = $fcm->sendMessage();
?>
```

###Create topic message and send message
``` php
<?php 
    $fcm = $this->get('firebase_fcm_client');
    $fcm->createMessage(array(
        'topic' => '/topics/TOPIC_NAME',
        'title' => 'New message',
        'body' => 'Hello World!',
        'badge' => 1,
        'data' => array(
            'action' => "new_message"
        )
    ));
    $data = $fcm->sendMessage();
?>
```
