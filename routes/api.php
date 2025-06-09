<?php

use App\Http\Middleware\ValidateApiToken;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostCardResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

Route::middleware(ValidateApiToken::class)->group(function () {
    Route::get("/posts", function (Request $request) {
        $paginatePerPage = $request->per_page ?? 5;
        $posts = QueryBuilder::for(Post::class)
            ->with("author", "category")
            ->published()
            ->allowedFilters(['title', 'status'])
            ->allowedSorts(['published_at', 'score'])
            ->paginate($paginatePerPage)
            ->appends(request()->query());
        return responseModel(200, "Get posts successfully", PostCardResource::collection($posts));
    });

    Route::get("/posts/{post}", function (Post $post) {
        $data = $post->load("author", "category", "tags");
        $posts = $post->relatedArticles();
        return responseModel(200, "Get post successfully", ["post" => new PostResource($data), "related_posts" => PostCardResource::collection($posts)]);
    });

    Route::get('categories', function (Request $request) {
        $countPerPage = $request->input('per_page', 5);
        $getPosts = filter_var($request->input('with_posts'), FILTER_VALIDATE_BOOLEAN);

        $query = Category::query();

        if ($getPosts) {
            $query->with('posts');
        }

        $categories = $query->paginate($countPerPage);

        return responseModel(200, 'Get categories successfully', CategoryResource::collection($categories));
    });

    Route::get('categories/{category}', function (Category $category) {

        $query = $category->load("posts");

        return responseModel(200, 'Get categories successfully', new CategoryResource($query));
    });
});
