<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'clients/mobile/api/CurrentUserMobileApi.php';

/**
 * Task 1 — mobile ACL reverted to Sugar default (Bove Montero, 2026-08).
 *
 * The original 2020 customization forced create=no / edit=no on the mobile client
 * for nine modules (Leads, Accounts, Contacts, Opportunities and five cst_* modules),
 * for ALL users regardless of Security Role.
 *
 * We are reverting to Sugar's standard, role-based mobile behaviour so the team can
 * run full testing on the mobile app and mobile browser view before deciding whether
 * a new, targeted restriction is needed (or whether default is fine).
 *
 * Why a no-op class instead of deleting the file: SugarCloud's Module Loader Package
 * Scanner blocks file deletion (unlink is denylisted), so a package cannot remove this
 * file — only overwrite it. This subclass extends the stock mobile CurrentUser API and
 * overrides nothing, so the endpoint behaves exactly as Sugar default.
 *
 * History / basis for a future version is preserved under
 * packages/task1-mobile-acl/reference/ :
 *   - CustomCurrentUserMobileApi.original-2020.php    (the original blanket block)
 *   - CustomCurrentUserMobileApi.candidate-cst-only.php (evidence-based refined proposal)
 */
class CustomCurrentUserMobileApi extends CurrentUserMobileApi
{
}
