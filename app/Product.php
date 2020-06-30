<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Product
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property float $price
 * @property string $vat
 * @property string|null $description
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereQuantity($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereTitle($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereVat($value)
 * @mixin Eloquent
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 */
class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
      'title',
      'slug',
      'price',
      'vat',
      'description',
      'quantity',
    ];

    public function getFirstImageUrl(): string
    {
        if($imageFirst = $this->getMedia('product_images')->first())
        {
            return $imageFirst->getUrl();
        }

        return url('images/no-image.jpg');
    }

    /**
     * @return array
     */
    public function getAllImagesUrls(): array
    {
        $images = [];

        $imagesCollection = $this->getMedia('product_images');

        foreach ($imagesCollection as $media)
        {
            $images[] = $media->getUrl();
        }

        if(empty($images))
        {
            $images[] = url('images/no-image.jpg');
        }

        return  $images;
    }
}
