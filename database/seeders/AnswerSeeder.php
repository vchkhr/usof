<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        DB::table('answers')->insert([
            'description' => 'Unfortunately, some programs can take a long time to compile. A couple of hours of compilation is not strange for tensorflow on your setup.',
            'question_id' => 1,
            'user_id' => 4,
            'created_at' => '2021-06-02 12:13:01',
            'updated_at' => '2021-06-02 12:13:01'
        ]);

        DB::table('answers')->insert([
            'description' => 'Basically you can do this: pip install tensorflow',
            'question_id' => 1,
            'user_id' => 5,
            'created_at' => '2021-06-03 11:52:01',
            'updated_at' => '2021-06-03 11:52:01'
        ]);

        DB::table('answers')->insert([
            'description' => 'If you require a specific older version, like 1.15, you can do this: pip install tensorflow==1.15',
            'question_id' => 1,
            'user_id' => 3,
            'created_at' => '2021-06-04 13:52:01',
            'updated_at' => '2021-06-04 13:52:01'
        ]);
        
        DB::table('answers')->insert([
            'description' => 'You may add sth. that closes/quits the windows you invoke.',
            'question_id' => 2,
            'user_id' => 4,
            'created_at' => '2021-06-05 15:57:01',
            'updated_at' => '2021-06-05 15:57:01'
        ]);
        
        DB::table('answers')->insert([
            'description' => 'ImageActor, which ultimately is a wrapper for tvtk.ImageActor, has a user_matrix property, which lets you assign a 4D transformation matrix.',
            'question_id' => 3,
            'user_id' => 4,
            'created_at' => '2021-06-06 16:57:01',
            'updated_at' => '2021-06-06 16:57:01'
        ]);
        
        DB::table('answers')->insert([
            'description' => 'There is an inbuilt library for document generation from doc_strings. All you need is to execute.',
            'question_id' => 4,
            'user_id' => 5,
            'created_at' => '2021-06-07 08:15:01',
            'updated_at' => '2021-06-07 08:15:01'
        ]);
        
        DB::table('answers')->insert([
            'description' => 'I am guessing that this is a generative adversarial network given by the relation between the losses and the parameters. It seems that the first group of parameters are the generative model and the second group make up the detector model. If my guesses are correct, then that would mean that the second model is using the output of the first model as its input. Admittedly, I am much more informed about PyTorch than TF. There is a comment which I believe is saying that the first model could be included in the second graph. I also think this is true. I would implement something similar to the following.',
            'question_id' => 5,
            'user_id' => 5,
            'created_at' => '2021-06-08 10:19:01',
            'updated_at' => '2021-06-08 10:19:01'
        ]);
        
        DB::table('answers')->insert([
            'description' => 'I think your transformation is missing a rotation. If I interpret your question correctly, you are asking what the inverse of (rotation by R followed by translation T).',
            'question_id' => 6,
            'user_id' => 1,
            'created_at' => '2021-06-09 13:05:01',
            'updated_at' => '2021-06-09 13:05:01'
        ]);
    }
}
