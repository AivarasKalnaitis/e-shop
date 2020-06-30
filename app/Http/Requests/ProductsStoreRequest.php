<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Class ProductsStoreRequest
 * @package App\Http\Requests
 */
class ProductsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'price' => 'required|min:0.01',
            'vat' => 'required|in:21,5,0',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image1' => 'nullable|image',
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->input('title');
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        $slug = $this->input('slug');

        if(!$slug)
        {
            $slug = $this->getTitle();
        }

        return Str::slug($slug);
    }

    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'price' => $this->getPrice(),
            'vat' => $this->getVAT(),
            'description' => $this->getDescription(),
            'quantity' => $this->getQuantity(),
        ];
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return (float)$this->input('price');
    }

    /**
     * @return string
     */
    public function getVAT(): string
    {
        return $this->input('vat', 21);
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->input('description');
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->input('quantity');
    }

    public function getImage1(): ?UploadedFile
    {
        return $this->file('image1');
    }
}
