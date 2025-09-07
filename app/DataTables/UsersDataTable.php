<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<a href="' . route('admin.user.userDelete', $query->id) . '" class="btn btn-danger btn-md" id="confirmation" data-dataTable_id="#users-table">
                <i class="fas fa-trash"></i></a>
                <a href="' . route('admin.user.userEdit', $query->id) . '" class="btn btn-primary btn-md"><i class="fas fa-pencil"></i></a>';
            })->addColumn('image', function ($query) {
                return '<img src="' . asset($query->image) . '" alt="user_image" width="50px">';
            })->addColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->format('Y-m-d');
            })->addColumn('status', function ($query) {
                if ($query->status == 1) {
                    return '<label class="form-check form-switch">
                              <input class="form-check-input change_status" data-url="' . route("admin.user.changeStatus") . '"  data-id="' . $query->id . '" name="active"  type="checkbox" checked="">

                            </label>';
                } else {
                    return '<label class="form-check form-switch">
                    <input class="form-check-input change_status" data-url="' . route("admin.user.changeStatus") . '" data-id="' . $query->id . '" name="in_active" type="checkbox">

                  </label>';
                }
            })
            ->rawColumns(['image', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'scrollX' => true,
                'scrollCollapse' => false,
                'autoWidth' => true,
                'dom' => 'Blfrtip',
            ])
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
            Column::make('name'),
            Column::make('email'),
            Column::make('image'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
