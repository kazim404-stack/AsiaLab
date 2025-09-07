<?php

namespace App\DataTables;

use App\Models\AboutU;
use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AboutUsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<AboutU> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div class="d-flex justify-content-between ">
            <a href="' . route('admin.about.edit', $query->id) . '"  class="btn btn-primary btn-md edit-about-btn" data-bs-toggle="modal" data-bs-target="#edit-about" style="margin-right:4px;"><i class="fas fa-edit"></i></a>
            <a href="' . route('admin.about.destroy', $query->id) . '" class="btn btn-danger btn-md" id="confirmation" data-datatable_id="#aboutus-table"><i class="fas fa-trash" ></i></a>
                 <button class="btn btn-secondary dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . route('admin.about.images.index', $query->id) . '"><i class="fas fa-image"></i> Image</a></li>
        </ul>
            </div>';
            })->addColumn('site_name', function ($query) {
                return $query->generalSetting ? $query->generalSetting->site_name : '';
            })->addColumn('title', function ($query) {
                return '<img  src="' . asset($query->image) . '" alt="logo-image" width="150"/>';
            })->addColumn('description', function ($query) {
                return $query->getTranslation('description', 'en');
            })->addColumn('title', function ($query) {
                return $query->getTranslation('title', 'en');
            })
            ->rawColumns(['action', 'image', 'title', 'description'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<AboutUs>
     */
    public function query(AboutUs $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('aboutus-table')
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
            Column::make('title'),
            Column::make('description'),
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
        return 'AboutUs_' . date('YmdHis');
    }
}
