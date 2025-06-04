<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\FeatureTestCase;

class UserTest extends FeatureTestCase
{
    /** @test */
    public function a_visitor_may_register(): void
    {
        // Arrange
        $user = [
            'name' => 'Billie Bellbotmz',
            'email' => 'billie_bee@botmz.com',
            'password' => '$6Trar10OisySS',
            'password_confirmation' => '$6Trar10OisySS',
        ];

        // Act
        $response = $this->post('/register', $user);
        
        // Assert
        $response->assertStatus(302);
    }
}
