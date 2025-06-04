<?php

namespace Tests\Feature;

use Tests\FeatureTestCase;

class AuthTest extends FeatureTestCase
{
    /** @test */
    public function guest_cannot_access_articles_admin_area(): void
    {
        $response = $this->get('/articles/create');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    /** @test */
    public function successfull_login_as_author_redirects_to_articles_admin_area(): void
    {
        $this->createRoles();

        $this->createAuthorUser();

        $user = $this->getUser();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('articles.create');
    }

    /** @test */
    public function successfull_login_as_admin_redirects_to_articles_admin_area(): void
    {
        $this->createRoles();

        $this->createAdminUser();

        $user = $this->getUser();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('articles.create');
    }

    /** @test */
    public function guest_doesnt_see_add_article_button(): void
    {
        $this->createRoles();

        $this->createGuestUser();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertDontSee('Add new article');
    }

    /** @test */
    public function guest_doesnt_see_edit_article_button(): void
    {
        $this->createRoles();
        $this->createGuestUser();
        $this->createArticle();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertDontSee('You may edit this article');
    }

    /** @test */
    public function author_sees_add_article_button(): void
    {
        $this->createRoles();
        $this->createAuthorUser();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertSee('Add new article');
    }

    /** @test */
    public function author_sees_correct_edit_article_button(): void
    {
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertSee('You may edit this article');
    }

    /** @test */
    public function admin_sees_add_article_button(): void
    {
        $this->createRoles();
        $this->createAdminUser();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertSee('Add new article');
    }

    /** @test */
    public function admin_sees_correct_edit_article_button(): void
    {
        $this->createRoles();
        $this->createAdminUser();
        $this->createArticle();

        $response = $this->get('/articles');

        $response->assertStatus(200);
        $response->assertSee('You may edit this article');
    }
}
