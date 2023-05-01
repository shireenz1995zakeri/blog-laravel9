<x-panel-layout>
    <div class="breadcrumb">
        <ul>
            <li><a href="{{route('dashboard')}}">پیشخوان</a></li>
            <li><a href="{{route('profile')}}" class="is-active">اطلاعات کاربری</a></li>
        </ul>
    </div>
    <div class="main-content  ">
        <div class="user-info bg-white padding-30 font-size-13">
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile__info border cursor-pointer text-center">
                    <div class="avatar__img"><img src=" {{ auth()->user()->getProfileUrl() }}" class="avatar___img">
                        <input type="file" name="profile" accept="image/*" class="hidden avatar-img__input">
                        <div class="v-dialog__container" style="display: block;"></div>
                        <div class="box__camera default__avatar"></div>
                    </div>
                    <span class="profile__name">کاربر :{{auth()->user()->name}}</span>
                </div>
                <input class="text" placeholder="نام کاربری" type="text" value=" {{auth()->user()->name}} " name="name">
                @error('name')
                <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;"> {{$message}}</p>
                @enderror

                <input class="text text-left" type="email
            " placeholder="ایمیل" value="{{auth()->user()->email}}" name="email">
                @error('email')
                <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;"> {{$message}}</p>
                @enderror

                <input class="text" type="text" name="mobile" placeholder="شماره تلفن" value="{{ auth()->user()->mobile }}">
                @error('mobile')
                <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;"> {{$message}}</p>
                @enderror
             

                <input class="text text-left" placeholder="رمز عبور" type="password" name="password">
                @error('password')
                <p style="margin-bottom: 1rem;color:#D8000C;text-align: right;"> {{$message}}</p>
                @enderror

                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
                <br>
                <br>
                <button class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>

    </div>




</x-panel-layout>