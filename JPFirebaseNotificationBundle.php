<?php
namespace JP\FirebaseNotification;

use JP\FirebaseNotification\DependencyInjection\JPFirebaseNotificationExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JPFirebaseNotificationBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * @version 0.0.1
     * @since 0.0.1
     */
    public function getContainerExtension()
    {
        // this allows us to have custom extension alias
        // default convention would put a lot of underscores
        if (null === $this->extension) {
            $this->extension = new JPFirebaseNotificationExtension();
        }

        return $this->extension;
    }
}