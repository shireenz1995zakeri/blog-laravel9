<x-panel-layout>
    <x-slot name="title">
-مدیریت دسته بندی ها
    </x-slot>
    <x-slot name="styles">
        <link rel="stylesheet" href="{{asset('blog/css/style.css')}}">
    </x-slot>
<div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard')}}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index')}}" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="bg-white table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                        <tr role="row" class="">
                          

                            <td><a href="">{{$category->id}}</a></td>
                            <td><a href="">{{ $category->name}}</a></td>
                            <td>{{ $category->slug}}</td>
                            
                            <td>{{ $category->getParentName() }}</td>
                            <td>
                            <a href="" class=" mlg-15" style="color:red" title="حذف" onclick="destroyCategory(event,'{{ $category->id}}')">حذف</a>
                                <a href="{{ route('categories.edit',$category->id) }}" style="color:green" title="ویرایش">ویرایش</a>
                                <form action="{{ route('categories.destroy',$category->id)}}" id="destroy-category-{{ $category->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach

                     

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
            <div class="col-4 bg-white">
                  <p class="box__title">ایجاد دسته بندی جدید</p>
                  <form action="{{ route('categories.store')}}" method="post" class="padding-30">
                    @csrf
                      <input type="text"
                      name="name" placeholder="نام دسته بندی" class="text">
                      @error('name')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                      <input type="text"
                      name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
                      @error('slug')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                      <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                      <select name="category_id" id="category_id" class="select">
                          <option value="">ندارد</option>
                          @foreach($parentCategories as $category)
                          <option value="{{ $category->id}}">{{ $category->name}}</option>
                          @endforeach
                         
                      </select>
                    @error('category_id')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                      <button class="btn btn-webamooz_net">اضافه کردن</button>
                  </form>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
     <script>
        function destroyCategory(event,id){
        
                event.preventDefault();
                Swal.fire({
                title: 'آیا مطمعن هستید می خواهید این دسته بندی را حدف کنید؟',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221,51,51)',
                cancelButtonColor: 'rgb(48,133,214)',
                confirmButtonText: 'بله, حذف کنید!',
                 cancelButtonText:'کنسل'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`destroy-category-${id}`).submit();
                }
            })
                

            }
     </script>
    </x-slot>
</x-panel-layout>