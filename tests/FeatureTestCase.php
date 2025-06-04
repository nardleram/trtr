<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class FeatureTestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase;

    protected User $currentUser;
    protected Article $currentArticle;
    protected Comment $currentComment;
    protected Collection $currentArticles;

    protected function createRoles()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'author']);
        Role::create(['name' => 'guest']);
    }

    protected function createGuestUser(): self
    {
        $user = User::factory()->create();

        $this->currentUser = $user;

        return $this->actingAs($user);
    }

    protected function createUnverifiedUser(): self
    {
        $user = User::factory()->unverified()->create();

        $this->currentUser = $user;

        return $this->actingAs($user);
    }

    protected function createAuthorUser(): self
    {
        $user = User::factory()->author()->create();

        $this->currentUser = $user;

        return $this->actingAs($user);
    }

    protected function createAdminUser(): self
    {
        $user = User::factory()->admin()->create();
        
        $this->currentUser = $user;

        return $this->actingAs($user);
    }

    protected function createArticle(): void
    {
        $this->currentArticle = Article::factory()->create();    
    }

    protected function createArticles(): void
    {
        $this->currentArticles = Article::factory(11)->create();    
    }

    protected function getArticle(): Article
    {
        return $this->currentArticle;
    }

    protected function getArticles(): Collection
    {
        return $this->currentArticles;
    }

    protected function getUser(): User
    {
        return $this->currentUser;
    }
}
