<x-panel-layout>
    <x-slot name="title">
        -ویرایش مقاله جدید
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{asset('blog/css/style.css')}}">
    </x-slot>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard')}}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index')}}"> مقالات</a></li>
            <li><a href="{{ route('posts.edit',$post->id)}}" class="is-active">ویرایش مقاله جدید</a></li>
        </ul>
    </div>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش مقاله جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('posts.update',$post->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="text" class="text" name="title" placeholder="عنوان مقاله" value="{{ $post->title}}">
                    @error('title')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                    دسته بندی مقالات
                    <ul class="tags">
                        @foreach($post->categories as $category)
                        <li class="addedTag">{{$category->name}}<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                            <input type="hidden" value="{{$category->name}}" name="categories[]">
                        </li>
                        @endforeach
                      
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field">
                        </li>
                    </ul>
                    <p style="font-size: x-small; padding: 0 8px 25px 0;color: lightgray;">                    لطفا فقط اسم مقالات را وارد کنید.
</p>
                    @error('categories')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror


                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="banner" accept="image/*" />
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    @error('banner')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror


                    <textarea placeholder="متن مقاله" class="text " name="content">{!! $post->content !!}</textarea>
                    @error('content')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror

                    <button class="btn btn-webamooz_net">ویرایش مقاله</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script src="{{asset('blog/panel/js/tagsInput.js')}}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <!-- <script src="{{ asset('blog/panel/js/ckeditor4.js') }} "></script> -->
        <script>
            CKEDITOR.replace('content', {
                language: 'fa',
                filebrowserUploadUrl: '{{ route("editor-upload",["_token" => csrf_token()]) }}',
                filebrowserUploadMethod: 'form'
            })
        </script>
        <script src="{{ asset('blog/panel/js/tagsInput.js') }}"></script>
    </x-slot>
</x-panel-layout>