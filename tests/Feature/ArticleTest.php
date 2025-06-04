<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Tests\FeatureTestCase;
use App\Enums\ArticleSource;
use Illuminate\Support\Facades\Auth;

class ArticleTest extends FeatureTestCase
{
    /** @test */
    public function index_page_has_zero_articles(): void
    {
        // Arrange
        $this->createRoles();

        $this->createGuestUser();

        // Act
        $response = $this->get('/articles');

        // Assert
        $response->assertStatus(200);
        $response->assertSee(__('No articles found'));
    }

    /** @test */
    public function index_page_has_article(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createGuestUser();

        $this->createArticle();

        $art = $this->getArticle();

        // Act
        $response = $this->get('/articles');

        // Assert
        $response->assertStatus(200);
        $response->assertDontSee(__('No articles found'));
        $response->assertSee($art->title);
        $response->assertViewHas('articles', function($collection) use ($art) {
            return $collection->first()->get()->contains($art);
        });
    }

    /** @test */
    public function index_page_articles_collection_is_paginated(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createAuthorUser();

        $this->createArticles();

        $arts = $this->getArticles();

        // Act
        $response = $this->get('/articles');

        // Assert
        $response->assertStatus(200);
        $response->assertDontSee(__('No articles found'));
        $response->assertSee($arts->first()->title);
        $response->assertDontSee($arts->last()->title);
        $response->assertViewHas('articles', function($collection) use ($arts) {
            return !$collection->contains($arts->last());
        });
    }

    /** @test */
    public function author_can_visit_create_article_page(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createAuthorUser();

        // Act
        $response = $this->get('/articles/create');

        // Assert
        $response->assertStatus(200);
    }

    /** @test */
    public function author_can_save_article_to_db(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createAuthorUser();

        $article = [
            'title' => 'Article title',
            'body' => 'This is the body of the article.',
            'slug' => 'article_title',
            'source' => ArticleSource::App->value,
            'user_id' => $this->currentUser->id
        ];

        // Act
        $response = $this->post('/articles/store', $article);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', $article);
    }

    /** @test */
    public function admin_can_visit_create_article_page(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createAdminUser();

        // Act
        $response = $this->get('/articles/create');

        // Assert
        $response->assertStatus(200);
    }

    /** @test */
    public function admin_can_save_article_to_db(): void
    {
        // Arrange
        $this->createRoles();
        
        $this->createAdminUser();

        $article = [
            'title' => 'Article title II',
            'body' => 'This is the body of the article written by admin user.',
            'slug' => 'article_title_ii',
            'source' => ArticleSource::App->value,
            'user_id' => $this->currentUser->id
        ];

        // Act
        $response = $this->post('/articles/store', $article);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', $article);
    }

    /** @test */
    public function author_can_visit_edit_article_page_and_see_correct_data(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        // Act
        $response = $this->get('/articles/'. $this->currentArticle->slug .'/edit');

        // Assert
        $response->assertStatus(200);
        $response->assertSee($this->currentArticle->title);
        $response->assertSee($this->currentArticle->body);
        $response->assertViewHas('article', $this->currentArticle);
    }

    /** @test */
    public function admin_can_visit_edit_article_page_and_see_correct_data(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAdminUser();
        $this->createArticle();

        // Act
        $response = $this->get('/articles/'. $this->currentArticle->slug .'/edit');

        // Assert
        $response->assertStatus(200);
        $response->assertSee($this->currentArticle->title);
        $response->assertSee($this->currentArticle->body);
        $response->assertViewHas('article', $this->currentArticle);
    }

    /** @test */
    public function create_validation_errors_redirect_back_to_create_page(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        // Act
        $response = $this->post('/articles/store', [
            'title' => '',
            'body' => 'OMG some tosser forgot the title! What will happen next!? Not to mention they also forgot a bunch of other stuff!'
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
        $response->assertSessionHasErrors(['user_id']);
        $response->assertSessionHasErrors(['slug']);
    }

    /** @test */
    public function update_validation_errors_redirect_back_to_edit_page(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        // Act
        $response = $this->put('/articles/'. $this->currentArticle->id .'/update', [
            'title' => '',
            'body' => 'OMG some tosser deleted the title! What will happen next!?'
        ]);

        // Assert
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function admin_can_delete_any_article(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();
        $user = User::factory()->admin()->create();

        // Act
        $response = $this->actingAs($user)->delete('/articles/'. $this->currentArticle->id .'/delete');
        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('articles');
        $this->assertDatabaseMissing('articles', $this->currentArticle->toArray());
        $this->assertCount(0, Article::all());
        $this->assertDatabaseCount('articles', 1);
    }

    /** @test */
    public function author_can_delete_own_article(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        // Act
        $response = $this->delete('/articles/'. $this->currentArticle->id .'/delete');
        // Assert
        $response->assertStatus(302);
        $response->assertRedirect('articles');
        $this->assertDatabaseMissing('articles', $this->currentArticle->toArray());
        $this->assertCount(0, Article::all());
        $this->assertDatabaseCount('articles', 1);
    }

    /** @test */
    public function author_cannot_delete_others_article(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAdminUser();
        $this->createArticle();
        $user = User::factory()->author()->create();

        // Act
        $response = $this->actingAs($user)->delete('/articles/'. $this->currentArticle->id .'/delete');

        // Assert
        $response->assertStatus(401);
        $this->assertDatabaseHas('articles', [
            'title' => $this->currentArticle->title,
            'body' => $this->currentArticle->body,
        ]);
        $this->assertCount(1, Article::all());
    }

    /** @test */
    public function all_visitors_can_view_any_article(): void
    {
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        Auth::logout();

        $art = $this->currentArticle;

        // Act
        $response = $this->get('/articles/show/'.$art->slug);

        // Assert
        $response->assertStatus(200);
        $response->assertSee($art->title);
        $response->assertViewHas('article');
    }
}
