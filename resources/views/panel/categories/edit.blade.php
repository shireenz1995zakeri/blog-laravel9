

<x-panel-layout>
    <x-slot name="title">
        -ویرایش دسته بندی ها
    </x-slot>
<div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('categories.index')}}" class="">دسته بندی ها</a></li>
            <li><a href="{{route('categories.edit',$category->id)}}" class="is-active">ویرایش دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ایجاد دسته بندی ها</p>
                <form action="{{ route('categories.update',$category->id)}}" class="padding-30" method="post">
                @csrf
                @method('put')
                 
                    <input type="text" name="name" class="text" placeholder="نام  " value="{{$category->name}}">
                    @error('name')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                    
                

                  

                    <select name="category_id" id="category_id" class="select">
                          <option value="">ندارد</option>
                          @foreach($parentCategories as $parentCategory)
                          <option value="{{ $parentCategory->id}}" @if( $parentCategory->id === $category->category_id) selected @endif> {{ $parentCategory->name}} </option>
                          @endforeach
                         
                    </select>
                    @error('category_id')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-webamooz_net">ویرایش دسته بندی ها</button>
                </form>

            </div>
        </div>
       
    </div>
</x-panel-layout>
