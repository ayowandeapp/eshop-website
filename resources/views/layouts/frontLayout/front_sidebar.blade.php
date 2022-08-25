<?php
$mainCategories = App\Http\Controllers\Controller::search();
use App\Product;
?>
<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        <div class="panel panel-default">
            <?php //echo $categories_menu; ?>
            @foreach($categories as $cat)
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $cat->id }}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $cat->name }}
                        </a>
                    </h4>
                </div>
                <div id="{{ $cat->id }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($cat->categories as $subcat)
                            @if($subcat->status =="1")
                            <?php
                            $productCount = Product::productCount($subcat->id);
                            ?>
                                <li><a href="{{ route('products.page', $subcat->url) }}">{{ $subcat->name }} ({{ $productCount }})</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div><!--/category-products-->
    <div class="price-range"><!--price-range-->
        <h2>Price Search</h2>
        <div class="well text-center">
                <form action="{{ route('productSearch') }}" method="post" name="search_product" id="search_product" class="form-horizontal" role="form">{{ csrf_field() }}
                    <div class="form-group">
                        <label for="category" class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="category" required>
                                <?php echo $mainCategories; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-3 control-label">From</label>
                        <div class="col-sm-7 search_box">
                            <input type="text" name="minPrice" placeholder="minPrice" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">To</label>
                        <div class="col-sm-7 search_box">
                            <input type="text" name="maxPrice" placeholder="maxPrice" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
        </div>
    </div><!--/price-range-->
    @if(!empty($url))
    <h2>Colors</h2>
    <form action="{{ url('/products/filter') }}" method="post">{{ csrf_field() }}
        <input name="url" value="{{ $url }}" type="hidden">
    <div class="panel-group" id="accordian"><!--category-products-->
        <div class="panel-group">
            @foreach($colorArrays as $color)
            @if(!empty($_GET['color']))
                <?php $colorArray = explode('-', $_GET['color']) ?>
                    @if(in_array($color,$colorArray ))
                    <?php $colorCheck = "checked" ?>
                    @else
                    <?php $colorCheck = "" ?>
                    @endif
            @else
            <?php $colorCheck = "" ?>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4> <input name="colorFilter[]" onchange="javascript:this.form.submit();" id="{{ $color }}" value="{{ $color }}" type="checkbox" {{ $colorCheck }}>&nbsp;&nbsp;<span class="products-colors">{{ $color }}</span></h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</form>
    @endif
</div>