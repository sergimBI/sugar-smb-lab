<?php
/**
 * Task 1 — Mobile ACL experiment 2.
 *
 * This version deliberately delegates all ACL handling to Sugar's standard
 * CurrentUserMobileApi behaviour. It does not force create or edit restrictions.
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
