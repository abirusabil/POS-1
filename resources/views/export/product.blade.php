<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Type</th>
        <th>SKU</th>
        <th>Name</th>
        <th>Short Description</th>
        <th>Stock</th>
        <th>Allow Customer</th>
        <th>Reguler Price</th>
        <th>Categories</th>
        <th>Tags</th>
        <th>Images</th>
    </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->type }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->short_description }}</td>
            <td>{{ $product->stock_quantity }}</td>
            <td>0</td>
            <td>{{ $product->regular_price }}</td>
            <td>
                @foreach($product->categories as $category)
                {{ $category->name }}, 
                @endforeach
            </td>
            <td>
                @foreach($product->tags as $tag)
                {{ $tag->name }}, 
                @endforeach
            </td>
            <td>
                <a href="{{ $product->images[0]->src }}">{{ $product->images[0]->src }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>