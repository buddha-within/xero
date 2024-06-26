<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Webfox\Xero\OauthCredentialManager;

class XeroController extends Controller
{
    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index(Request $request, OauthCredentialManager $xeroCredentials)
    {

        try {
            // Check if we've got any stored credentials
            if ($xeroCredentials->exists()) {
                /*
                 * We have stored credentials so we can resolve the AccountingApi,
                 * If we were sure we already had some stored credentials then we could just resolve this through the controller
                 * But since we use this route for the initial authentication we cannot be sure!
                 */
                $xero = resolve(\XeroAPI\XeroPHP\Api\AccountingApi::class);
                $organisationName = $xero->getOrganisations($xeroCredentials->getTenantId())->getOrganisations()[0]->getName();
                $user = $xeroCredentials->getUser();
                $username = "{$user['given_name']} {$user['family_name']} ({$user['username']})";

//                dd($xero->getReportBalanceSheet($xeroCredentials->getTenantId()));
            }
        } catch (\throwable $e) {
            // This can happen if the credentials have been revoked or there is an error with the organisation (e.g. it's expired)
            $error = $e->getMessage();
        }

        return view('dashboard', [
            'connected' => $xeroCredentials->exists(),
            'error' => $error ?? null,
            'organisationName' => $organisationName ?? null,
            'username' => $username ?? null,
        ]);
    }

}
