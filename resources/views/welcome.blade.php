<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vihongo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    @extends('layouts.app')

    @section('content')

    <!-- Thẻ thông báo sẽ bị ẩn mặc định và chỉ hiện khi người dùng chưa đăng nhập -->
    <div class="notic" id="login-notice" style="display:none;">
        <p style="font-size: 25px; margin: 20px; text-align: center; width: 270px;">
            授業を見るにはログインする必要があります
        </p>
        <a class="nav-link noti" href="{{ route('login') }}">{{ __('ログイン') }}</a>
    </div>
    <div class="alert alert-success" id="login-success-notice" style="display: none;">
        <p style="font-size: 25px;">{{ session('login_success') }}</p>
    </div>
    <!-- Thông báo đăng ký thành công -->
    <div class="alert alert-success" id="register-success-notice" style="display: none;">
        <p style="font-size: 25px;">{{ session('register_success') }}</p>
    </div>
    <div class="daily">
        <div class="tuvung">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($vocabulary as $index => $word)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" data-bs-interval="10000">
                            <h1>{{ $word->word }}</h1>
                            <h2>{{ $word->meaning }}</h2>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">前へ</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">次へ</span>
                </button>
            </div>
        </div>
    </div>

    <div class="Lessons">
        <h1>レッスン</h1>
        <div class="lessons-view">
            @foreach($lessons as $lesson)
            <a href="{{ url('video/'.$lesson->id) }}" class="lesson-cardx" data-auth="{{ Auth::check() ? 'true' : 'false' }}">
                <div class="lesson-card">
                    <h1>{{ $lesson->title }}</h1> <!-- Hiển thị tiêu đề bài học -->
                    <h2>{{ $lesson->description }}</h2> <!-- Hiển thị mô tả bài học -->
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Hiển thị phân trang -->
    <div class="pagination-links">
        {{ $lessons->links() }}
    </div>

    @endsection

</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lặp qua tất cả các thẻ bài học
        document.querySelectorAll('.lesson-cardx').forEach(function (link) {
            link.addEventListener('click', function (e) {
                const isLoggedIn = link.getAttribute('data-auth') === 'true'; // Kiểm tra người dùng đã đăng nhập hay chưa
                if (!isLoggedIn) {
                    e.preventDefault(); // Ngăn chặn chuyển hướng

                    // Hiển thị thẻ thông báo đăng nhập
                    const noticeDiv = document.getElementById('login-notice');
                    noticeDiv.style.display = 'flex';

                    // Cuộn lên đầu trang để thấy thông báo rõ hơn
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const loginSuccessNotice = document.getElementById('login-success-notice');

        if (loginSuccessNotice && loginSuccessNotice.textContent.trim() !== '') {
            loginSuccessNotice.style.display = 'block';

            // Ẩn thông báo sau 5 giây
            setTimeout(function () {
                loginSuccessNotice.style.display = 'none';
            }, 5000); // 5000ms = 5 giây
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
        const registerSuccessNotice = document.getElementById('register-success-notice');

        if (registerSuccessNotice && registerSuccessNotice.textContent.trim() !== '') {
            registerSuccessNotice.style.display = 'block';

            // Ẩn thông báo sau 5 giây
            setTimeout(function () {
                registerSuccessNotice.style.display = 'none';
            }, 5000); // 5000ms = 5 giây
        }
    });
</script>

</html>
