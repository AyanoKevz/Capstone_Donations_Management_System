<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;

class VerifyAcct extends Controller
{
    public function showInactiveAccounts(Request $request)
    {
        // Retrieve the filter type from the request, default to "all"
        $filter = $request->query('role_name', 'all');

        // Base query to fetch inactive accounts
        $query = UserAccount::with('roles')->where('is_verified', false);

        // Apply role filter if not "all"
        if ($filter !== 'all') {
            $query->whereHas('roles', function ($roleQuery) use ($filter) {
                $roleQuery->where('role_name', $filter);
            });
        }

        // Execute the query
        $inactiveAccounts = $query->get();

        return view('admin.verify_account', compact('inactiveAccounts', 'filter'));
    }
}
