<?php
namespace App\Table;

use App\Model\Post;
use App\PaginatedQuery;
use PDO;

class PostTable {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findPaginated()
    {
        $paginatedQuery = new PaginatedQuery(
            "SELECT * FROM post ORDER BY created_at DESC",
            "SELECT count(id) FROM post",
            $this->pdo
         );
        $posts = $paginatedQuery->getItems(Post::class);

        return [$posts, $paginatedQuery];
    }
}