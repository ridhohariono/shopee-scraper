@extends('layouts.app')
@push('link')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css"
    integrity="sha512-wcf2ifw+8xI4FktrSorGwO7lgRzGx1ld97ySj1pFADZzFdcXTIgQhHMTo7tQIADeYdRRnAjUnF00Q5WTNmL3+A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<main class="col-md-9 m-sm-auto col-lg-10 px-md-4 py-4">
    <h1 class="h2">Shopee Scraper</h1>
    <p>Input some keywords to scrape products from shopee
    </p>
    <div class="row">
        <div class="col-sm-6">
            <div class="alert alert-success message" role="alert">
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-sm-6">
            <div class="col">
                <input type="text" id="keywords" name="keywords" class="form-control"
                    placeholder="(Use comma for multiple keywords) ex: iphone, android, samsung">
                <span class="errors"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <button type="submit" id="btn-scrape" class="btn btn-primary">Scrape</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Product Scraped</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="product">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"
    integrity="sha512-lUZZrGg8oiRBygP81yUZ4XkAbmeJn7u7HW5nq7npQ+ZXTRvj3ErL6y1XXDq6fujbiJlu6gHsgNUZLKE6eSDm8w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.message').hide();
    $('#product').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('api/products') }}",
            type: "GET",
            beforeSend: function(request){
                request.setRequestHeader("Authorization", "Bearer" + TOKEN)
            }
        },
        columns: [
        { data: 'title', name: 'title' },
        { data: 'state', name: 'state' },
        { data: 'seller_name', name: 'seller_name' },
        { data: 'price', name: 'price', render:function(data, type, row){
            return formatRupiah(row.price, 'Rp.')
        } },
        { data: 'created_at', name: 'created_at' },
        {data: 'url', name: 'url', orderable: false, render: function(data, type, row){
            return `<a href="`+ row.url +`"class="btn btn-shopee btn-sm text-light" target="_blank">View</a>` 
        }},
        ],
        order: [[4, 'desc']]
    });

    function shop_url(url){
        return `<a href=""class="btn btn-shopee btn-sm text-light" target="_blank">View</a>`
    }

    $('#keywords').tokenfield({})
    $('#btn-scrape').on("click", function(e){
        e.preventDefault()
        let err_element = $(".errors")
        let keywords = $("#keywords").val().trim().split(',')
        if ($("#keywords").val().length == 0){
            err_element.addClass("text-danger")
            err_element.text("Please input keywords")
        }else{
            err_element.text("")
            this.setAttribute("disabled", "disabled")
            showLoading()
            $.ajax({
                url: "{{ url('api/products/scrape') }}",
                method: "POST",
                headers:{
                    Authorization: "Bearer "+ TOKEN
                },
                data: {
                    keywords: keywords
                },
                success: function(data){
                    $('#btn-scrape').removeAttr("disabled")
                    showLoading('stop')
                    $('#keywords').tokenfield('setTokens', [])
                    $('#keywords').val('')
                    $(".message").text(data.message)
                    $(".message").fadeTo(2000, 1000).slideUp(1000, function(){
                        $(".message").slideUp(1000);
                    });
                }
            })
        }
    })
</script>

@endpush