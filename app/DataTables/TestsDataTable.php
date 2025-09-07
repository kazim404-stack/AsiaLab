<?php

namespace App\DataTables;

use App\Models\Test;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Test> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div class="d-flex justify-content-between ">
            <a href="' . route('admin.tests.edit', $query->id) . '"  class="btn btn-primary btn-md edit-test-btn" data-bs-toggle="modal" data-bs-target="#edit-test" style="margin-right:4px;"><i class="fas fa-edit"></i></a>
            <a href="' . route('admin.tests.destroy', $query->id) . '" class="btn btn-danger btn-md" id="confirmation" data-datatable_id="#tests-table"><i class="fas fa-trash" ></i></a>
                          <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . route('admin.tests.images.index', $query->id) . '"><i class="fas fa-image"></i> Image</a></li>
        </ul>
    </div>
            </div>';
            })->addColumn("name", function ($query) {
                return $query->name ? $query->getTranslation('name', 'en') : '';
                // })->addColumn("description", function ($query) {
                //     return $query->description ? $query->getTranslation('description', 'en') : '';
            })->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw(
                    "LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"en\"'))) LIKE ?",
                    ["%" . strtolower($keyword) . "%"]
                );
            })->filterColumn('category', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                    $q->whereRaw(
                        "LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"en\"'))) LIKE ?",
                        ["%" . strtolower($keyword) . "%"]
                    );
                });
            })
            ->addColumn("category", function ($query) {
                return $query->category ? $query->category->getTranslation('name', 'en') : '';
            })->rawColumns(['description', 'action']);
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Test>
     */
    public function query(Test $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id','desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tests-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('category'),
            Column::make('name'),

            Column::make('unite'),
            Column::make('refrence'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tests_' . date('YmdHis');
    }
}
