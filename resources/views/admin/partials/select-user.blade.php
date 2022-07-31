@section("css")
    <link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet">
@endsection
@if(!isset($noLable) || $noLable==false)
<label for="user_id" class="form-label"><span class="text-danger">*</span>کاربر</label>
@endif
<select type='text' class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id[]"  @if(isset($required) && $required)required @endif multiple></select>

@push('scripts')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

    <script>
        $('#user_id').select2({
            ajax: {
                url: baseUrl+"users/search",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
                },
                processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    pagination: {
                    more: (params.page * 30) < data.total_count
                    }
                };
                },
                cache: true
            },
            placeholder: 'انتخاب کاربر',
            
            minimumInputLength: 3,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection,
            language: {
                inputTooShort: function(args) {
                // args.minimum is the minimum required length
                // args.input is the user-typed text
                return `حداقل  ${args.minimum} کاراکتر از شماره موبایل یا نام کاربر را وارد کنید`;
                },
                inputTooLong: function(args) {
                // args.maximum is the maximum allowed length
                // args.input is the user-typed text
                return "You typed too much";
                },
                errorLoading: function() {
                return "خطای دریافت اطلاعات";
                },
                loadingMore: function() {
                return "نمایش بیشتر";
                },
                noResults: function() {
                return "کابری یافت نشد";
                },
                searching: function() {
                return "در حال دریافت اطلاعات ...";
                },
                maximumSelected: function(args) {
                // args.maximum is the maximum number of items the user may select
                return `مجاز به انتخاب حداکثر ${args.maximum} کاربر می باشید`;
                }
            }
        });

        function formatRepo (repo) {
            console.log(repo)
            if (repo.loading) {
                return "در حال دریافت اطلاعات ...";
            }

            var $container = $(
                "<div class='select2-result-repository clearfix'>" +           
                "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +               
                    "</div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-repository__title").text(repo.first_name+" "+repo.last_name);
            $container.find(".select2-result-repository__description").text(repo.mobile);    

            return $container;
        }

        function formatRepoSelection (repo) {
             return repo.first_name+" "+repo.last_name +" ("+repo.id+")";
        }
     </script>
@endpush