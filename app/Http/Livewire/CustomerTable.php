<?php

namespace App\Http\Livewire;

use NumberFormatter;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class CustomerTable extends PowerGridComponent
{
    use ActionButton;

    public string $type;

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
            ->showRecordCount('full')
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
        return Customer::query();
        // return Customer::query()->where('type', $this->type);
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

        // return [
        //     'store' => [ // relationship on dishes model
        //         'name', // column enabled to search
        //     ],
        //     //...
        // ];
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
        $fmt = new NumberFormatter('en-US', NumberFormatter::CURRENCY);

        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('active')
            ->addColumn('billing_type', function (Customer $model) {
                return strtoupper($model->billing_type);
            })
            ->addColumn('balance', function (Customer $model) use ($fmt) {
                return $fmt->formatCurrency($model->balance, "BDT");
            })
            ->addColumn('created_at_formatted', function (Customer $model) {
                return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
            })
            ->addColumn('updated_at_formatted', function (Customer $model) {
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
        $types = [
            ["key" => "Monthly", "value" => "monthly"],
            ["key" => "Yearly", "value" => "yearly"]
        ];

        $canEdit = true; //User has edit permission
        $canCopy = true;

        return [
            Column::add()
                ->title(__('ID'))
                ->field('id')
                ->makeInputRange(),

            Column::add()
                ->title(__('Name'))
                ->field('name')
                ->searchable()
                ->sortable()
                ->makeInputText()
                ->editOnClick($canEdit),

            Column::add()
                ->title(__('Email'))
                ->field('email')
                ->searchable()
                ->sortable()
                ->makeInputText()
                ->clickToCopy($canCopy, 'Copy to clipboard'),


            Column::add()
                ->title(__('Active'))
                ->field('active')
                ->searchable()
                ->sortable()
                ->makeBooleanFilter('active', 'Active', 'Inactive')
                ->toggleable($canEdit, 'yes', 'no'),

            Column::add()
                ->title(__('Billing Type'))
                ->field('billing_type')
                ->searchable()
                ->sortable()
                ->makeInputSelect($types, 'key', 'value')
                ->bodyAttribute('text-center', 'color:red')
                ->headerAttribute('text-center', 'color:red'),


            Column::add()
                ->title(__('Balance'))
                ->field('balance')
                ->makeInputRange(),


            // Column::add()
            //     ->title(__('CREATED AT'))
            //     ->field('created_at_formatted')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker('created_at'),

            // Column::add()
            //     ->title(__('UPDATED AT'))
            //     ->field('updated_at_formatted')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker('updated_at')
            //     ->hidden(),

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
        $canClickButton = true;

        return [
            // Button::add('edit')
            //     ->caption(__('Edit'))
            //     ->class('bg-indigo-500 text-white')
            //     ->route('customer.edit', ['customer' => 'id']),

            Button::add('edit-customer')
                ->caption('Edit')
                ->class('bg-gray-300')
                ->openModal('edit-customer', ['customer' => 'id'])
                ->method('put')
                ->route('customer.edit', ['customer' => 'id'])
                ->can($canClickButton),


            Button::add('destroy')
                ->caption(__('Delete'))
                ->class('bg-red-500 text-white')
                ->route('customer.destroy', ['customer' => 'id'])
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


    public function update(array $data): bool
    {
        try {
            $updated = Customer::query()->find($data['id'])->update([
                $data['field'] => $data['value']
            ]);
        } catch (QueryException $exception) {
            $updated = false;
        }

        if ($updated) {
            $this->fillData();
        }

        return $updated;
    }

    public function updateMessages(string $status, string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field' => __('Custom Field updated successfully!'),
                'name' => __('Customer name has been updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                'balance' => __('Error updating the balance.'),
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
