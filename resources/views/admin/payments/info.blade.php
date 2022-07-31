@extends('admin.layouts.app')
@section('content')
            <div class="mb-4">
                {{-- <a href="{{route('payments.edit',$payment->id)}}" class="btn btn-info btn-sm">ویرایش</a> --}}
                <button class="btn btn-danger btn-sm me-2 delete-btn" type="button">حذف</button>
            </div>
                <div class="mt-3">
                    <span class='fw-bold'>شناسه پرداخت : </span>
                    <span>{{$payment->gu_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>کاربر : </span>
                    <span>{{$payment->user->full_name??''}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>شناسه پیگیری : </span>
                    <span>{{$payment->ref_id}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>مبلغ : </span>
                    <span>{{number_format($payment->amount)}} تومان</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>وضعیت : </span>
                    <span>{{App\Constants\PaymentStates::aliases($payment->state)}}</span>
                </div>
                <div class="mt-3">
                    <span class='fw-bold'>نوع : </span>
                    <span>{{App\Constants\PaymentTypes::aliases($payment->type)}}</span>
                </div>
@endsection
@push('scripts')
    <script>
            $(document).on('click','.delete-btn',function (){
                var r = confirm("آیا پرداحت مورد نظر حذف شود؟")
                if (r === true) {
                    $.ajax(baseUrl+'payments/{{$payment->id}}',{
                        method:'delete',
                        success:function (res){
                             window.history.back();
                        },
                        error:function (er){
                            alert("Error deleting")
                        }
                    })
                }
            })
    </script>
@endpush