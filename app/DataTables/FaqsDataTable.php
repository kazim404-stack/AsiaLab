<?php

namespace App\DataTables;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Faq> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div class="d-flex justify-content-between ">
            <a href="' . route('admin.faqs.edit', $query->id) . '"  class="btn btn-primary btn-md edit-faq-btn" data-bs-toggle="modal" data-bs-target="#edit-faq" style="margin-right:4px;"><i class="fas fa-edit"></i></a>
            <a href="' . route('admin.faqs.destroy', $query->id) . '" class="btn btn-danger btn-md" id="confirmation" data-datatable_id="#faqs-table"><i class="fas fa-trash" ></i></a>
            </div>';
            })->addColumn('question',function($query){
                return $query->question? $query->getTranslation('question','en'): '';
            })->addColumn('answear',function($query){
                return $query->answear? $query->getTranslation('answear','en'): '';
            })->addColumn('status',function($query){
                return  $query->status == 1 ? '<span class="badge bg-success text-white">Active</span>': '<span class="badge bg-warning text-white">Inactive</span>';
            })
            ->rawColumns(['action','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Faq>
     */
    public function query(Faq $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('faqs-table')
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
            Column::make('question'),
            Column::make('answear'),
            Column::make('status'),
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
        return 'Faqs_' . date('YmdHis');
    }
}
