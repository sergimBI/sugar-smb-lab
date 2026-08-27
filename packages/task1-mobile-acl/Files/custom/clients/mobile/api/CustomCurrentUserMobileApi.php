<?php
/**
 * REFERENCE ONLY — NOT installed by any package.
 *
 * This is the verbatim original customization found in production
 * (custom/clients/mobile/api/CustomCurrentUserMobileApi.php), installed July 2020 via
 * the "Single package with customizations" package.
 *
 * Behaviour: overrides the mobile CurrentUser API and injects create=no / edit=no into
 * the ACL payload returned to the mobile client, for the nine modules below, for ALL
 * users regardless of their Security Role. It is UI-level suppression, not enforced on
 * the server. Because the keys are injected (not modifying an existing value), it also
 * affects administrators.
 *
 * Kept here as the historical baseline and starting point for a possible future,
 * targeted version.
 */
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once('clients/mobile/api/CurrentUserMobileApi.php');
class CustomCurrentUserMobileApi extends CurrentUserMobileApi
{
    public function registerApiRest()
    {
        return parent::registerApiRest();
    }
    public function retrieveCurrentUser(ServiceBase $api, array $args)
    {
        return parent::retrieveCurrentUser($api, $args);
    }
}
