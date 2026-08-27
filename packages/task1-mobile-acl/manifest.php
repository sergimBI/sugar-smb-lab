<?php
/**
 * Module Loader manifest — Task 1: revert mobile create/edit ACL to Sugar default. Local test, not for production use.
 *
 * Overwrites custom/clients/mobile/api/CustomCurrentUserMobileApi.php with a no-op
 * subclass, so the mobile CurrentUser API behaves as Sugar default (standard
 * role-based ACLs; no injected create/edit restrictions).
 *
 * Scanner-safe: uses only installdefs['copy']. SugarCloud's Package Scanner blocks
 * file deletion (unlink), so we neutralize by overwrite rather than delete.
 */

$manifest = array(
    'name'        => 'Task 1 - Mobile ACL experiment 2',
    'description' => 'Reverts the 2020 mobile create/edit ACL customization to Sugar default by neutralizing CustomCurrentUserMobileApi (no-op subclass). Mobile then honours standard role-based ACLs. Pending full mobile testing before any new targeted restriction.',
    'version'     => '1.0.1',
    'author'      => 'Bove Montero y Asociados',
    'published_date' => '2026-08-19',
    'type'        => 'module',
    'key'         => 'bmt1mobileacl',
    'is_uninstallable' => true,
    'acceptable_sugar_versions' => array(
        'regex_matches' => array('26.1.*'),
    ),
    'acceptable_sugar_flavors' => array('ENT'),
);

$installdefs = array(
    'id'   => 'bm_task1_mobile_acl_revert',
    'copy' => array(
        array(
            'from' => '<basepath>/Files/custom/clients/mobile/api/CustomCurrentUserMobileApi.php',
            'to'   => 'custom/clients/mobile/api/CustomCurrentUserMobileApi.php',
        ),
    ),
);
