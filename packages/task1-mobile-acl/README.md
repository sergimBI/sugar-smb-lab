# Task 1 — Mobile create/edit ACL

## Current decision: revert to Sugar default

The 2020 customization `custom/clients/mobile/api/CustomCurrentUserMobileApi.php` blocked
**create + edit on the mobile client** for nine modules (Leads, Accounts, Contacts, Opportunities and
five `cst_*` back-office modules), for **all users** regardless of Security Role — a UI-level ACL
suppression.

We are **reverting to Sugar's standard, role-based mobile behaviour** so the team can run full testing
on the mobile app and the mobile browser view. After testing we will either (a) stay on default, or
(b) ship a new, targeted restriction — see `reference/` for a ready starting point.

## What this package does

It is **scanner-safe**. SugarCloud's Module Loader Package Scanner blocks file deletion (`unlink` is
denylisted), so we cannot delete the custom file with a package — we **overwrite** it with a no-op
subclass that extends the stock mobile API and overrides nothing. Functionally identical to the file
not existing: mobile reverts to default role-based ACLs.

(If you ever want the file physically removed, that is a request to Sugar Support, who have backend
filesystem access. It makes no functional difference.)

## Layout

```
task1-mobile-acl/
  manifest.php                                             # Module Loader manifest (26.1 / ENT)
  Files/custom/clients/mobile/api/CustomCurrentUserMobileApi.php   # the no-op (revert) version shipped
  reference/
    CustomCurrentUserMobileApi.original-2020.php           # verbatim original (history / baseline)
    CustomCurrentUserMobileApi.candidate-cst-only.php      # evidence-based candidate for a future version
  build.sh                                                 # zips manifest.php + Files/ into an installable ZIP
```

`reference/` is documentation only — nothing there is installed by the package.

## Build

```bash
./build.sh
```

Produces `task1-mobile-acl-revert-<version>.zip` (git-ignored — it's a build artifact).

## Install & verify (each tier: local → online sandbox → production)

1. Admin → Module Loader → upload the ZIP → **Install**.
2. Run **Quick Repair & Rebuild**.
3. Verify the revert: log in on the mobile platform and check `/me` — the affected modules should no
   longer show forced `create=no`/`edit=no` (they return to role-based values). See the repo's
   verification scripts / setup guide for the exact API check.

Promote in order — local first, then the online sandbox, then production — testing at each step.

## Evolving to a future targeted version

1. Copy `reference/CustomCurrentUserMobileApi.candidate-cst-only.php` (or write a new policy) to
   `Files/custom/clients/mobile/api/CustomCurrentUserMobileApi.php`.
2. Bump `version` in `manifest.php`.
3. `./build.sh`, then install/verify through the tiers as above.

The git history of this folder is the audit trail of what shipped and when.
