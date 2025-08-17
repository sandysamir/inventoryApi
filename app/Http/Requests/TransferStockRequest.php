<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'inventory_item_id' => ['required','integer','exists:inventory_items,id'],
            'from_warehouse_id' => ['required','integer','different:to_warehouse_id','exists:warehouses,id'],
            'to_warehouse_id'   => ['required','integer','exists:warehouses,id'],
            'quantity'          => ['required','integer','min:1'],
        ];
    }
}
