<?php

namespace App\Services;

use App\Kernel\Auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Movie;
use App\Models\Review;

class MovieService
{
    public function __construct(
        private DatabaseInterface $db,
    ) {}

    public function store(string $name, string $description, UploadedFileInterface $image, int $category): int|false
    {
        $filePath = $image->move('movies');

        return $this->db->insert('movies', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
            'category_id' => $category,
        ]);
    }

    public function all()
    {
        $movies = $this->db->get('movies');
        $movies = array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['category_id'],
                $movie['created_at']
            );
        }, $movies);

        return $movies;
    }

    public function destroy(int $id)
    {
        $this->db->delete('movies', [
            'id' => $id,
        ]);
    }

    public function find(int $id)
    {
        $movie = $this->db->first('movies', ['id' => $id]);
        if (! $movie) {
            return null;
        }

        return new Movie(
            $movie['id'],
            $movie['name'],
            $movie['description'],
            $movie['preview'],
            $movie['category_id'],
            $movie['created_at'],
            $this->getReviews($id)
        );
    }

    public function update(int $id, string $name, string $description, ?UploadedFileInterface $image, int $categoryId)
    {
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $categoryId,

        ];
        if ($image && ! $image->hasErrors()) {
            $data['preview'] = $image->move('movies');
        }
        $this->db->update('movies', $data, [
            'id' => $id,
        ]);
    }

    public function new()
    {
        $movie = $this->db->get('movies', [],
            ['id' => 'DESC'], 10);

        return array_map(function ($movie) {
            return new Movie(
                $movie['id'],
                $movie['name'],
                $movie['description'],
                $movie['preview'],
                $movie['category_id'],
                $movie['created_at'],
                $this->getReviews($movie['id']),
            );
        }, $movie);
    }

    private function getReviews(int $id)
    {
        $reviews = $this->db->get('reviews', [
            'movie_id' => $id,
        ], ['id' => 'DESC']);

        return array_map(function ($review) {
            $user = $this->db->first('users', [
                'id' => $review['user_id'],
            ]);

            $user = new User(
                $user['id'],
                $user['name'],
                $user['email'],
                $user['password'],
            );

            return new Review(
                $review['id'],
                $review['rating'],
                $review['review'],
                $review['created_at'],
                $user
            );
        }, $reviews);

    }
}
