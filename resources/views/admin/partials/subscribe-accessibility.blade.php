
 <div class="col-12 mt-3">

    @if (!isset($notEdit))
        <h4>دسترسی ها</h4>
        <p>افزودن دسترسی</p>
        <div class="row">
            <div class="col-4">
                <select class="form-select" id="subscribe">
                    @foreach (App\Models\Subscribe::get() as $subscribe)
                        <option value="{{ $subscribe->id }}">{{ $subscribe->title }}</option>
                    @endforeach
                </select>
            </div>
            @if(!isset($notRefreshTime))
                <div class="col-3">
                    <input type="number" id="subscribe_refresh_time" class="form-control" placeholder="رفرش تایم (دقیقه)">
                </div>
            @endif
            <div class="col-2">
                <button type="button" id="btn-add-subscribe" class="btn btn-info btn-sm  me-2">افزودن</button>
            </div>
        </div>
    @endif
    
    <h5 class="mt-4">لیست دسترسی‌ها</h5>
    <p>کاربران با اشتراک موجود در لیست زیر دسترسی دارند.اگر لیست دسترسی ها خالی باشد همه کاربران دسترسی دارند.</p>
    <table class="table table-striped mt-3" style="width:100%">
        <thead>
        <tr>
            <th>اشتراک</th>   
            @if(!isset($notRefreshTime))    
                 <th>رفرش تایم (دقیقه)</th>        
            @endif                   
            @if (!isset($notEdit)) <th>عملیات</th> @endif
        </tr>
        </thead>
        <tbody id="subscribe-content">

            @if (old('subscribes'))
                    @foreach (old('subscribes') as $subscribe )
                    <tr> 
                        <td data-id="{{ $subscribe['id'] }}">{{ $subscribe['title'] }}</td>
                        @if(!isset($notRefreshTime)) <td data-refresh>{{ $subscribe['refresh_time'] }}</td> @endif
                        @if (!isset($notEdit)) <td><a class="btn btn-xs btn-danger btn-delete-subscribe">حذف</a></td>@endif
                    </tr>
                @endforeach  
            @elseif (isset($data))
                 @foreach ($data->subscribes as $subscribe )
                    <tr> 
                        <td data-id="{{ $subscribe->subscribe_id }}">{{ $subscribe->subscribe->title }}</td>
                        @if(!isset($notRefreshTime)) <td data-refresh>{{ $subscribe->refresh_time }}</td> @endif
                        @if (!isset($notEdit)) <td><a class="btn btn-xs btn-danger btn-delete-subscribe">حذف</a></td>@endif
                    </tr>
                @endforeach  
            @endif
         
        </tbody>
    </table>
</div>         
@if (!isset($notEdit)) 
    @push("scripts")
        <script>
            const notRefreshTime='{{isset($notRefreshTime) }}'
            console.log(notRefreshTime)

            $("#btn-add-subscribe").on('click',function(){
                const subscribeId=$("#subscribe").val();

                if(!subscribeId || subscribeId.trim()==''){
                        alert("اشتراکی را انتخاب کنید");
                        return;
                    } 

                $("#subscribe-content").find("tr").each(function(){
                    const id=$(this).find('[data-id]').data('id');
                    if(id==subscribeId){
                        alert("اشتراک در لیست موجود می باشد.");
                        c;
                    }
                })
                const subscribe=$("#subscribe").find(":selected").text();
                let refreshTime;
                if(!notRefreshTime){
                    refreshTime=$("#subscribe_refresh_time").val();
                    if(!refreshTime || refreshTime.trim()==''){
                        alert("رفرش تایم نمی تواند خالی باشد");
                        return;
                    } 
                }
               

                $("#subscribe-content").append(`<tr><td data-id="${subscribeId}">${subscribe}</td> ${!notRefreshTime? `<td data-refresh>${refreshTime}</td>`:''} <td><a class="btn btn-xs btn-danger btn-delete-subscribe">حذف</a></td></tr>`)
            });
            
            $(document).on('click','.btn-delete-subscribe',function(){
                const e=confirm("آیا اشتراک مورد نظر حذف شد؟");
                if(e){
                    $(this).closest('tr').remove()
                }
            })
            $("form").on("submit",function(e){
                const $this=$(this);
                $("#subscribe-content").find("tr").each(function(){
                    const id=$(this).find('[data-id]').data('id');
                    $this.append(`<input type="hidden" name="subscribes[${id}][id]" value="${id}">`)
                    $this.append(`<input type="hidden" name="subscribes[${id}][title]" value="${$(this).find('[data-id]').text()}">`)
                    if(!notRefreshTime)
                         $this.append(`<input type="hidden" name="subscribes[${id}][refresh_time]" value="${$(this).find('[data-refresh]').text()}">`)
                });
            })
        </script>
    @endpush
@endif