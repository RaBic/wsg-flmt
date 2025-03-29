<?php

use App\Http\Middleware\ApiResponseHeaders;
use App\Http\Resources\CentreResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\StudyResource;
use App\Http\Resources\TeamResource;
use App\Models\Centre;
use App\Models\Page;
use App\Models\Post;
use App\Models\Study;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelSettings\Models\SettingsProperty;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', fn (Request $request) => $request->user());

Route::group(
    [
        'middleware' => ['auth:sanctum', ApiResponseHeaders::class],
    ],
    function () {
        Route::post('/pages', function (Request $request) {
            $pagesQuery = Page::query()
                ->with(['image', 'blocks']);

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        if ($key === 'published') {
                            $pagesQuery = $pagesQuery->published();
                        } else {
                            $pagesQuery = $pagesQuery->where($key, $value);
                        }
                    }
                }
            }

            $pagesQuery = $pagesQuery->orderBy('sort');

            if ($request->filled('limit')) {
                $pagesQuery = $pagesQuery->limit($request->integer('limit', 10));
            }

            $pages = $pagesQuery->get()->values();

            return PageResource::collection($pages);
        });
        Route::get('/page/{id}', fn ($id) => new PageResource(
            Page::where('id', $id)->with(['image', 'blocks'])->firstOrFail()
        ));

        Route::post('/posts', function (Request $request) {
            $postsQuery = Post::query()
                ->with(['image', 'blocks']);

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        if ($key === 'published') {
                            $postsQuery = $postsQuery->published();
                        } else {
                            $postsQuery = $postsQuery->where($key, $value);
                        }
                    }
                }
            }

            $postsQuery = $postsQuery->orderByDesc('published_at');

            if ($request->filled('limit')) {
                $postsQuery = $postsQuery->limit($request->integer('limit', 10));
            }

            $posts = $postsQuery->get()->values();

            return PostResource::collection($posts);
        });
        Route::get('/post/{id}', fn ($id) => new PostResource(
            Post::where('id', $id)->with(['image', 'blocks'])->firstOrFail()
        ));

        Route::post('/studies', function (Request $request) {
            $studiesQuery = Study::query()
                ->with([
                    'image',
                    'blocks' => fn ($query) => $query->with(['image']),
                ]);

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        if ($key === 'published') {
                            $studiesQuery = $studiesQuery->published();
                        } else {
                            $studiesQuery = $studiesQuery->where($key, $value);
                        }
                    }
                }
            }

            $studiesQuery = $studiesQuery->orderBy('sort');

            if ($request->filled('limit')) {
                $studiesQuery = $studiesQuery->limit($request->integer('limit', 10));
            }
            $studies = $studiesQuery->get()->values();

            return StudyResource::collection($studies);
        });
        Route::get('/study/{id}', fn ($id) => new StudyResource(
            Study::where('id', $id)->with(['image', 'blocks'])->firstOrFail()
        ));

        Route::post('/settings', function (Request $request) {
            $settings = SettingsProperty::all();

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        $settings = $settings->where($key, $value);
                    }
                }
            }

            $settings = $settings->values();

            return SettingsResource::collection($settings);
        });

        Route::post('/team-members', function (Request $request) {
            $teamMembersQuery = Team::query()
                ->with(['image']);

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        if ($key === 'published') {
                            $teamMembersQuery = $teamMembersQuery->published();
                        } else {
                            $teamMembersQuery = $teamMembersQuery->where($key, $value);
                        }
                    }
                }
            }

            $teamMembersQuery = $teamMembersQuery->orderBy('sort');

            if ($request->filled('limit')) {
                $teamMembersQuery = $teamMembersQuery->limit($request->integer('limit', 10));
            }

            $teamMembers = $teamMembersQuery->get()->values();

            return TeamResource::collection($teamMembers);
        });
        Route::get('/team/{id}', fn ($id) => new TeamResource(
            Team::where('id', $id)->with(['image'])->firstOrFail()
        ));

        Route::post('/centres', function (Request $request) {
            $centresQuery = Centre::query()
                ->with(['studies']);

            if ($request->filled('filter')) {
                $filter = $request->input('filter');
                if (is_iterable($filter)) {
                    foreach ($filter as $key => $value) {
                        $centresQuery = $centresQuery->where($key, $value);
                    }
                }
            }

            if ($request->has('limit')) {
                $centresQuery = $centresQuery->limit($request->integer('limit', 10));
            }

            $centres = $centresQuery->get()->values();

            return CentreResource::collection($centres);
        });
        Route::get('/centre/{id}', fn ($id) => new CentreResource(
            Centre::where('id', $id)->with(['studies'])->firstOrFail()
        ));
    }
);
