<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class InvoiceTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp()
    {
        $this->showCheckBox()
            ->showPerPage()
            ->showExportOption('download', ['excel', 'csv'])
            ->showSearchInput();
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
    public function datasource(): ?Builder
    {
        return Invoice::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): ?PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('customer_id')
            ->addColumn('type')
            ->addColumn('for_date_formatted', function (Invoice $model) {
                if ($model->type == 'monthly') {
                    return Carbon::parse($model->for_date)->format('M-Y');
                } else if ($model->type == 'yearly') {
                    return Carbon::parse($model->for_date)->format('Y');
                }

                return Carbon::parse($model->for_date)->format('d-M-Y');
            })
            ->addColumn('customer', function (Invoice $model) {
                return $model->customer->name;
            })
            ->addColumn('amount')
            ->addColumn('paid')
            ->addColumn('status')
            ->addColumn('created_at_formatted', function (Invoice $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y');
            })
            ->addColumn('updated_at_formatted', function (Invoice $model) {
                return Carbon::parse($model->updated_at)->format('d/m/Y H:i:s');
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */
    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id')
                ->makeInputRange(),

            Column::add()
                ->title(__('CUSTOMER'))
                ->field('customer')
                ->makeInputSelect(Customer::all(), 'name', 'customer_id'),

            Column::add()
                ->title(__('TYPE'))
                ->field('type')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('FOR DATE'))
                ->field('for_date_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('for_date'),

            Column::add()
                ->title(__('AMOUNT'))
                ->field('amount')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('PAID'))
                ->field('paid')
                ->sortable()
                ->searchable(),

            Column::add()
                ->title(__('STATUS'))
                ->field('status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::add()
                ->title(__('CREATED AT'))
                ->field('created_at_formatted')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker('created_at'),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */


    public function actions(): array
    {
        return [
            Button::add('edit-invoice')
                ->caption('Edit')
                ->class('bg-gray-300')
                ->openModal('edit-invoice', ['invoice' => 'id'])
                ->method('put')
                ->route('invoice.edit', ['invoice' => 'id'])
                ->can(true),

            //    Button::add('edit')
            //        ->caption(__('Edit'))
            //        ->class('bg-indigo-500 text-white')
            //        ->route('invoice.edit', ['invoice' => 'id']),

            Button::add('destroy')
                ->caption(__('Delete'))
                ->class('bg-red-500 text-white')
                ->route('invoice.destroy', ['invoice' => 'id'])
                ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods
    |
    */

    public function update(array $data ): bool
    {
       try {
           $updated = Invoice::query()->find($data['id'])->update([
                $data['field'] => $data['value']
           ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field' => __('Error updating custom field.'),
            ]
        ];

        return ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);
    }

    public function template(): ?string
    {
        return null;
    }
}
