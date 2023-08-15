<?php
namespace App\Table;

use App\Model\Category;
use App\Table\Exception\NotFoundException;

final class CategoryTable extends Table {

    protected $table = "category";
    protected $class = Category::class;
    
}