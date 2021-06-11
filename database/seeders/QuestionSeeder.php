<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->insert([
            'title' => 'Tensorflow Compile Runs For A Long Time',
            'description' => 'So I am trying to compile TensorFlow from the source (using a clone from their git repo from 2019-01-31). I installed Bazel from their shell script (https://github.com/bazelbuild/bazel/releases/download/0.21.0/bazel-0.21.0-installer-linux-x86_64.sh).',
            'tags' => 'python,tensorflow,compilation,bazel',
            'user_id' => 1,
            'solved' => 1,
            'correct_answer_id' => 1,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('questions')->insert([
            'title' => 'Mayavi colorbar in TraitsUI creating blank window',
            'description' => 'I\'m trying to create a GUI in TraitsUI that includes two Mayavi figures. I have implemented these figures as per the multiple engines example in the Mayavi documentation.',
            'tags' => 'python,enthought,mayavi,traitsui',
            'user_id' => 1,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('questions')->insert([
            'title' => 'Is it possible to directly apply an affine transformation matrix to a Mayavi ImageActor object?',
            'description' => 'I\'m using Mayavi to render some imaging data that consists of multiple 2D planes within a 3D volume, the position, orientation, and scale of which are defined by 4x4 rigid body affine transformation matrices.',
            'tags' => 'python,transformation,mayavi',
            'user_id' => 1,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('questions')->insert([
            'title' => 'Documenting class attributes with type annotations',
            'description' => 'I want to autogenerate documentation to my code from docstrings.',
            'tags' => 'python,python-3.6,python-sphinx,autodoc,sphinx-napoleon',
            'user_id' => 2,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('questions')->insert([
            'title' => 'Optimizing subgraph of large graph - slower than optimizing subgraph by itself',
            'description' => 'I have a very large tensorflow graph, and two sets of variables: A and B.',
            'tags' => 'python,tensorflow',
            'user_id' => 2,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);

        DB::table('questions')->insert([
            'title' => 'Camera pose from solvePnP',
            'description' => 'I need to retrieve the position and attitude angles of a camera (using OpenCV / Python).',
            'tags' => 'python,opencv-solvepnp',
            'user_id' => 3,
            'created_at' => '2000-01-01 00:00:01',
            'updated_at' => '2000-01-01 00:00:01'
        ]);
    }
}
