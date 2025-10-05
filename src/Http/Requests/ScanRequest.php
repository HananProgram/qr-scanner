<?php
namespace Services\QrScanner\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScanRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array { return ['payload' => ['required','string','max:2048']]; }
}
