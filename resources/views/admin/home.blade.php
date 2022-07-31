@extends('admin.layouts.app')
@section('css')
@endsection
@section('content')
    <div class="single_element">
        <div class="quick_activity">
            <div class="row">
                <div class="col-12">
                    <div class="quick_activity_wrap">
                        <a href="{{ route('users.index') }}" class="single_quick_activity">
                            <h4>کاربران </h4>
                            <h3><span class="counter">{{ App\Models\User::count() }}</span> </h3>
                            <p>تعداد کاربران ثبت نام شده</p>
                        </a>
                        <a href="{{ route('userQuestions.index') }}" class="single_quick_activity">
                            <h4>پرسش‌های کاربران</h4>
                            <h3> <span
                                    class="counter">{{ App\Models\UserQuestion::whereNull('answerd_at')->count() }}</span>
                            </h3>
                            <p>تعداد پرسش‌های در انتظار پاسخ</p>
                        </a>
                        <a href="{{ route('payments.index') }}" class="single_quick_activity">
                            <h4>پرداختی ماه جاری</h4>
                            <h3><span class="counter">{{ number_format($sumInMonth) }}</span> تومان</h3>
                            <p>جمع کل پرداختی‌ها در ماه جاری</p>
                        </a>
                        <a href="{{ route('payments.index') }}" class="single_quick_activity">
                            <h4>کل پرداختی</h4>
                            <h3><span
                                    class="counter">{{ number_format($sumAll) }}</span>
                                تومان </h3>
                            <p>جمع کل پرداختی‌ها در سایت</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/chartjs/chart.js') }}"></script>
    <script>
        const chatData = {!! $chartData !!};

        console.log(chatData)
        const labels = [];
        const datas = [];

        chatData.map(function(item) {
            labels.push(item.year + "/" + item.month);
            datas.push(item.sum);
        })

        const data = {
            labels: labels,
            datasets: [{
                label: 'جمع کل پرداختی شش ماه قبل به تفکیک ماه',
                data: datas,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endpush
