<?php
/**
 * REFERENCE ONLY — NOT installed by any package.
 *
 * Evidence-based candidate for a FUTURE targeted version, parked here for when the
 * team has finished testing the mobile app / mobile browser view.
 *
 * Rationale (from the Task 1 investigation): the original blocked nine modules for
 * create AND edit. Evidence showed the stock sales modules are safe to allow on mobile
 * (their "required" fields are mostly conditional/defaulted; provisional create with
 * only a name succeeds). This candidate therefore restricts ONLY the five structured
 * back-office cst_* modules (create + edit), and leaves Leads/Contacts/Accounts/
 * Opportunities to standard role-based ACLs. It only ever injects 'no', never 'yes',
 * so Security Roles still apply.
 *
 * If the team decides a restriction is warranted after testing, start from this file:
 * copy it to the package's Files/... path, bump the manifest version, rebuild and promote.
 */
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'clients/mobile/api/CurrentUserMobileApi.php';

class CustomCurrentUserMobileApi extends CurrentUserMobileApi
{
    public function registerApiRest()
    {
        return parent::registerApiRest();
    }

    public function retrieveCurrentUser(ServiceBase $api, array $args)
    {
        $result = parent::retrieveCurrentUser($api, $args);

        // Structured back-office modules: no create and no edit on mobile.
        $block_all = array(
            'cst_matriz',
            'cst_referrals',
            'cst_contratos',
            'cst_subservicios',
            'cst_subtareas',
        );

        foreach ($block_all as $acl_module) {
            $result['current_user']['acl'][$acl_module]['create'] = 'no';
            $result['current_user']['acl'][$acl_module]['edit'] = 'no';
        }

        // Leads, Contacts, Accounts, Opportunities: intentionally unrestricted.

        return $result;
    }
}
