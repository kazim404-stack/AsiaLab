<?php

namespace App\DataTables;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MachinesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Machine> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div class="d-flex justify-content-between align-items-center gap-2">
            <a href="' . route('admin.machines.edit', $query->id) . '"  class="btn btn-primary btn-md edit-machine-btn" data-bs-toggle="modal" data-bs-target="#edit-machine" style="margin-right:4px;"><i class="fas fa-edit"></i></a>
            <a href="' . route('admin.machines.destroy', $query->id) . '" class="btn btn-danger btn-md" id="confirmation" data-datatable_id="#machines-table"><i class="fas fa-trash" ></i></a>
                <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="' . route('admin.machines.images.index', $query->id) . '"><i class="fas fa-image"></i> Image</a></li>
        </ul>
    </div>
</div>';
            })->addColumn('method', function ($query) {
                return $query->method ? $query->method->name : '';
            })->addColumn('name', function ($query) {
                return $query->name ? $query->getTranslation('name', 'en') : '';
            })->addColumn('description', function ($query) {
                return $query->description ? $query->getTranslation('description', 'en') : '';
            })->filterColumn('name', function ($query, $keyword) {
                $query->whereRaw(
                    "LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"en\"'))) LIKE ?",
                    ["%" . strtolower($keyword) . "%"]
                );
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Machine>
     */
    public function query(Machine $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id','desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('machines-table')
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
            Column::make('model'),
            Column::make('name'),
            Column::make('method'),
            Column::make('description'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(180)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Machines_' . date('YmdHis');
    }
}
