<?php

namespace Tests\Feature;

use App\Models\Comment;
use Tests\FeatureTestCase;
use Illuminate\Support\Facades\Auth;

class CommentTest extends FeatureTestCase
{
    /** @test */
    public function regular_visitor_cannot_see_article_comment_button(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();
        Auth::logout();

        //Act
        $response = $this->get('/articles/'.$this->currentArticle->slug.'/show');

        //Assert
        $response->assertStatus(200);
        $response->assertDontSee('Reply to article');
    }

    /** @test */
    public function guest_sees_article_comment_button(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        Auth::logout();
        $this->createGuestUser();

        //Act
        $response = $this->get('/articles/'.$this->currentArticle->slug.'/show');

        //Assert
        $response->assertStatus(200);
        $response->assertSee('Reply to article');
    }

    /** @test */
    public function tricksy_visitor_cannot_post_article_comment_at_all(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        Auth::logout();

        $comment = [
            'body' => 'You stink. Your article stinks. And I am a tricksy visitor!',
            'user_id' => 22,
            'article_id' => 11,
            'parent_id' => 22,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0
        ];

        // Act
        $response = $this->post('/comments/store', $comment);

        // Arrange
        $response->assertStatus(302);
    }

    /** @test */
    public function unverified_user_cannot_post_article_comment(): void
    {
        // Arrange
        $this->createRoles();
        $this->createUnverifiedUser();
        $this->createArticle();

        $comment = [
            'body' => 'You smell lovely. Your article smells lovely too. And I am a guest user.',
            'user_id' => $this->currentUser->id,
            'article_id' => $this->currentArticle->id,
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0,
        ];

        // Act
        $response = $this->post('/comments/store', $comment);

        // Arrange
        $response->assertStatus(302);
        $this->assertDatabaseMissing('comments', $comment);
    }

    /** @test */
    public function guest_can_post_article_comment(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        Auth::logout();
        $this->createGuestUser();

        $comment = [
            'body' => 'You smell lovely. Your article smells lovely too. And I am a guest user.',
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0,
        ];

        // Act
        $response = $this->post('/comments/store', $comment);

        // Arrange
        $response->assertStatus(200);
        $response->assertViewHas('article');
        $response->assertSee($comment['body']);
        $response->assertDontSee('No comments');
        $this->assertDatabaseHas('comments', $comment);
    }

    /** @test */
    public function author_can_post_article_comment(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAuthorUser();
        $this->createArticle();

        $comment = [
            'body' => 'You smell divine. Your article smells divine, too. And I am an author around here.',
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0,
        ];

        // Act
        $response = $this->post('/comments/store', $comment);

        // Arrange
        $response->assertStatus(200);
        $response->assertViewHas('article');
        $response->assertSee($comment['body']);
        $response->assertDontSee('No comments');
        $this->assertDatabaseHas('comments', $comment);
    }

    /** @test */
    public function admin_can_post_article_comment(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAdminUser();
        $this->createArticle();

        $comment = [
            'body' => 'You smell rank. Your article smells pissy. I am site admin. Behold. Quake. Enjoy.',
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0,
        ];

        // Act
        $response = $this->post('/comments/store', $comment);

        // Arrange
        $response->assertStatus(200);
        $response->assertViewHas('article');
        $response->assertSee($comment['body']);
        $response->assertDontSee('No comments');
        $this->assertDatabaseHas('comments', $comment);
        
    }

    /** @test */
    public function comment_indentation_increases_successively(): void
    {
        // Arrange
        $this->createRoles();
        $this->createAdminUser();
        $this->createArticle();

        $comment1 = Comment::factory()->create([
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => 0,
        ]);

        $comment2 = Comment::factory()->create([
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => $comment1->indent_level + 1,
        ]);

        Comment::factory()->create([
            'user_id' => $this->currentUser->id,
            'commentable_id' => $this->currentArticle->id,
            'commentable_type' => 'App\\Models\\Article',
            'parent_id' => $this->currentArticle->id,
            'parent_type' => 'App\\Models\\Article',
            'indent_level' => $comment2->indent_level + 1,
        ]);

        // Act
        $response = $this->get('/articles/'. $this->currentArticle->slug .'/show');

        // Arrange
        $response->assertStatus(200);
        $response->assertSee('Indent level: 0');
        $response->assertSee('Indent level: 1');
        $response->assertSee('Indent level: 2');
    }
}
