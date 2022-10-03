<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepository;
use App\Validators\PostValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'blog_name' => 'like',
        'description' => 'like',
        'published_at',
        'author.user_type',
        'author.full_name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
