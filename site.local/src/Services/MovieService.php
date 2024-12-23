<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Movie;

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
            );
        }, $movie);
    }
}
