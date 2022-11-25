<?php

namespace Database\Seeders;

use App\Models\UserRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRelationship::truncate();
        $arr_user = [1,2];
        $arr_check = [0];
        $list_friend_id = [];
        foreach ($arr_user as $key => $value )
        {
            $user_id = $value;
            $friend_id = $arr_user[rand(0,count($arr_user) - 1)];
            $str_check = $user_id . $friend_id;

            if (in_array($str_check, $arr_check) || $user_id == $friend_id) {

            } else {
                $list_friend_id[$key] = $friend_id;
                $arr_check[] = $str_check;
                UserRelationship::create([
                    'user_id' => $value,
                    'list_friend_id' => json_encode($list_friend_id)
                ]);
            }

        }
    }
}
