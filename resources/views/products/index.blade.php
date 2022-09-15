@php
/** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Domain\Product\Product[] $products */
@endphp
<x-app-layout title="Products">
    <form action="/" method="GET">
        <div class="flex gap-3">
            <label>Город:
                <select multiple name="city[]">
                    @foreach ($cities as $city)
                        <option
                            @if (request()->get('city') && in_array($city->id, request()->get('city')))
                                selected
                            @endif
                            value="{{ $city->id }}">
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </label>
            <label>Категория товара:
                <select name="product_category">
                    <option value="">Не выбрано</option>
                    @foreach ($product_categories as $category)
                        <option
                            @if (request()->get('product_category') && $category->id == request()->get('product_category')))
                                selected
                            @endif
                            value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>
            <button class="flex items-center justify-center p-2 text-white bg-red-500 border">Фильтровать</button>
        </div>
    </form>
    <div class="grid grid-cols-3 gap-12 mt-5">
        @foreach($products as $product)
            <x-product
                :title="$product->name"
                :product="$product->id"
                :price="format_money($product->getItemPrice()->pricePerItemIncludingVat())"
                :actionUrl="action(\App\Http\Controllers\Cart\AddCartItemController::class, [$product])"
          />
        @endforeach
    </div>

    <div class="mx-auto mt-12">
        {{ $products->links() }}
    </div>
</x-app-layout>
