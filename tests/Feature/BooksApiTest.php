<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_books(){
        $books = Book::factory(4)->create();

        /*
        $response = $this->getJson(route('books.index'));
        //dd($books->count());

        $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
        */

        $this->getJson(route('books.index'))
            ->assertJsonFragment([
                'title' => $books[0]->title
            ])->assertJsonFragment([
                'title' => $books[1]->title
            ]);
    }

    /** @test */
    function can_get_one_book(){
        $book = Book::factory()->create();

        /*
        $response = $this->getJson(route('books.show', $book));

        $response->assertJsonFragment([
            'title' => $book->title
        ]);
        */

        $this->getJson(route('books.show', $book))
            ->assertJsonFragment([
                'title' => $book->title
            ]);
    }

    /** @test */
    function can_create_books(){

        $this->postJson(route('books.store'),[
            
        ])->assertJsonValidationErrorFor('title');

        $title = 'My new book';
        $this->postJson(route('books.store'),[
            'title' => $title
        ])->assertJsonFragment([
            'title' => $title
        ]);

        $this->assertDatabaseHas('books', [
            'title' => $title
        ]);
    }

    /** @test */
    function can_update_book(){
        
        $book = Book::factory()->create();

        $this->patchJson(route('books.update', $book),[
            
        ])->assertJsonValidationErrorFor('title');

        $title_edited = 'Edited Title';

        $this->patchJson(route('books.update', $book), [
            'title' => $title_edited
        ])->assertJsonFragment([
            'title' => $title_edited
        ]);

        $this->assertDatabaseHas('books', [
            'title' => $title_edited
        ]);
    }

    /** @test */
    function can_delete_book(){
        
        $book = Book::factory()->create();
        $this->deleteJson(route('books.destroy', $book))
            ->assertNoContent();

        $this->assertDatabaseCount('books', 0);

    }


}
