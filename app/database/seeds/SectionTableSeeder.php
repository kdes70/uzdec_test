<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Section::class, 15)->create()->each(function (Section $section) {
            $section->users()->saveMany(\App\User::inRandomOrder()->limit(rand(1, 3))->get());
        });

//        [
//            'logo'         => function(){
//                return 'https://picsum.photos/id/'.range(1, 200).'/300/300',
//            }
//        ]
    }
}
