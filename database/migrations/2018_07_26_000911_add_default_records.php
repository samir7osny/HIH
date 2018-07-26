<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class AddDefaultRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $university = new \App\University;
        $university->name = 'Cairo University';
        $university->save();
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Engineering']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Medicine']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Computers and Information System']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Pharmacology']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Agriculture']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Science']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Economics and Political Science']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Mass Communication']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Archaeology']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Arts']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Commerce']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Specialized Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Nursing']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Law']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Physiotherapy']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Oral and Dental Medicine']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Veterinary Medicine']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Dar El-Ulum']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Kindergarten']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Statistical Studies and Research Institute']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'African Studies and Research Institutes']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'National Cancer Institute']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Regional and Urban Planning']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Institute of Educational Studies and Research']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'National Institute of Laser Enhanced Sciences']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Center of Open Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Cairo Center for Languages and Arabic Culture']);
        $university = new \App\University;
        $university->name = 'Ain Shams University';
        $university->save();
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Agriculture']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Arts']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Commerce']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Computer and Information Sciences']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Engineering']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Dentistry']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Languages']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Law']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Medicine']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Nursing']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Pharmacy']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Science']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Specific Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Women\'s College']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Institute of Environmental Studies and Research']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Institute of Postgraduate Childhood']);
        $university = new \App\University;
        $university->name = 'Helwan University';
        $university->save();
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Arts']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Applied Arts']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Artistic Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Music Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Sport Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Home Economics']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Tourism and Hospitality']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Fine Arts']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Commerce and Business Administration']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Computers and Information']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Community Service']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Engineering, Helwan']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Engineering, Matareya']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Law']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Pharmacy']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Science']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Education']);
        DB::table('college')->insert(['university_id'=>$university->id,'name'=>'Faculty of Social Work']);
        
        DB::table('committees_codes')->insert(['shortcut'=>'HR']);
        DB::table('committees_codes')->insert(['shortcut'=>'MK']);
        DB::table('committees_codes')->insert(['shortcut'=>'PR']);
        DB::table('committees_codes')->insert(['shortcut'=>'FR']);

        $member = new \App\Member;
        $member->save();

        $user = new \App\User;
        $user->username = 'admin';
        $user->type = '0';
        $user->id_of = $member->id;
        $user->first_name = 'Admin';
        $user->last_name = '1';
        $user->email = 'admin@admin.com';
        $user->phone_number = '01111111111';
        $user->photo_url = 'user.jpg';
        $user->college_id = \App\College::first()->id;
        $user->password = Hash::make('12345678');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
