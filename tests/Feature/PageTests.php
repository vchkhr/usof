<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTests extends TestCase
{
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->get('/questions');
        $response->assertStatus(200);

        $response = $this->get('/question/1');
        $response->assertStatus(200);

        $response = $this->get('/tags');
        $response->assertStatus(200);

        $response = $this->get('/tag/python');
        $response->assertStatus(200);

        $response = $this->get('/profiles');
        $response->assertStatus(200);

        $response = $this->get('/profile/1');
        $response->assertStatus(200);

        $response = $this->get('/search?q=');
        $response->assertStatus(200);

        $response = $this->get('/search?q=a');
        $response->assertStatus(200);

        $response = $this->get('/search?q=tensor');
        $response->assertStatus(200);

        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
