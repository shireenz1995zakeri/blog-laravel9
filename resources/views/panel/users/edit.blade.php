<x-panel-layout>
    <x-slot name="title">
        -ویرایش کاربر
    </x-slot>
<div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('users.index')}}" class="">کاربران</a></li>
            <li><a href="{{route('users.edit',$user->id)}}" class="is-active">ویرایش کاربران</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ایجاد کاربر</p>
                <form action="{{ route('users.update',$user->id)}}" class="padding-30" method="post">
                @csrf
                @method('put')
                    <input type="text" name="name" class="text" placeholder="نام و نام خانوادگی" value="{{$user->name}}">
                    @error('name')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                    <input type="email" name="email" class="text" placeholder="ایمیل" value="{{$user->email}}">
                    @error('email')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror

                    <input type="text" name="mobile" class="text" placeholder="شماره موبایل" value="{{$user->mobile}}">
                    @error('mobile')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror

                    <select name="role" id="" class="select">
                        <option value="user"   @if($user->role === 'user') selected @endif>کاربر عادی</option>
                        <option value="author" @if($user->role === 'author') selected @endif>نویسنده</option>
                        <option value="admin"  @if($user->role === 'admin') selected @endif>مدیر</option>
                    </select>
                    @error('role')
                    <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-webamooz_net">ویرایش کاربر</button>
                </form>

            </div>
        </div>
       
    </div>
</x-panel-layout>