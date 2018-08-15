<?php


namespace Library;
use Illuminate\Support\Facades\DB;

class AccessControl
{
    public function Admin($user_id)
    {
        $adminCheck = DB::select('select count(*) as cnt from admins where user_id = ?', [$user_id]);

        return $adminCheck[0]->cnt;
    }
}