<?php

namespace App\DataTables;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
{

    use DataTableTrait;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('categories', function ($post) {
                return $this->getCategories($post);
            })
            ->editColumn('created_at', function ($post) {
                return $this->getDate($post);
            })
            ->editColumn('comments_count', function ($post) {
                return $this->badge($post->comments_count, 'secondary');
            })
            ->editColumn('action', function ($post) {
                $buttons = $this->button(
                    'posts.display',
                    $post->slug,
                    'success',
                    __('Show'),
                    'eye',
                    '',
                    '_blank'
                );
                if(Route::currentRouteName() === 'posts.indexnew') {
                    return $buttons;
                }
                $buttons .= $this->button(
                    'posts.edit',
                    $post->id,
                    'warning',
                    __('Edit'),
                    'edit'
                );
                if($post->user_id === auth()->id()) {
                    $buttons .= $this->button(
                        'posts.create',
                        $post->id,
                        'info',
                        __('Clone'),
                        'clone'
                    );
                }

                return $buttons . $this->button(
                        'posts.destroy',
                        $post->id,
                        'danger',
                        __('Delete'),
                        'trash-alt',
                        __('Really delete this post?')
                    );
            })
            ->rawColumns(['categories', 'comments_count', 'action', 'created_at']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Post $post)
    {
        $query = isRole('redac') ? auth()->user()->posts() : $post->newQuery();
        if(Route::currentRouteNamed('posts.indexnew')) {
            $query->has('unreadNotifications');
        }
        return $query->select(
            'posts.id',
            'slug',
            'title',
            'active',
            'posts.created_at',
            'posts.updated_at',
            'user_id')
            ->with(
                'user:id,name',
                'categories:title')
            ->withCount('comments');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('posts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->lengthMenu();
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns()
    {


        $columns = [
            Column::make('title')->title(__('Title'))
        ];

        if(auth()->user()->role === 'admin') {
            array_push($columns,
                Column::make('user.name')->title(__('Author'))
            );
        }
        array_push($columns,
            Column::computed('categories')->title(__('Categories')),
            Column::computed('comments_count')->title(__('Comments'))->addClass('text-center align-middle'),
            Column::make('created_at')->title(__('Date')),
            Column::computed('action')->title(__('Action'))->addClass('align-middle text-center')
        );
        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Posts_' . date('YmdHis');
    }

    protected function getDate($post)
    {
        if(!$post->active) {
            return $this->badge('Not published', 'warning');
        }
        $updated = $post->updated_at > $post->created_at;
        $html = $this->badge($updated ? 'Last update' : 'Published', 'success');
        $html .= '<br>' . formatDate($updated ? $post->updated_at : $post->created_at) . __(' at ') . formatHour($updated ? $post->updated_at : $post->created_at);
        return $html;
    }
    protected function getCategories($post)
    {
        $html = '';
        foreach($post->categories as $category) {
            $html .= $category->title . '<br>';
        }
        return $html;
    }
}
