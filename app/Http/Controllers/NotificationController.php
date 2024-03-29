<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class NotificationController extends Controller
{
    public function getCheckedNotifications(Request $request)
    {
        $notificationId = $request->notificationId;

        $affected = DB::table('notifications')
            ->where('id', $notificationId)
            ->update(['read_at' => now()]);

        if ($affected > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Obavijest nije pronađena ili nije mogla biti označena kao pročitana.']);
        }
    }

    public function getAllCheckedNotifications(Request $request)
    {
        $notificationsAll = $request->notificationsAll;

        $affected = DB::table('notifications')
            ->whereIn('id', $notificationsAll)
            ->update(['read_at' => now()]);

        if ($affected > 0) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Obavijest nije pronađena ili nije mogla biti označena kao pročitana.']);
        }
    }
}
