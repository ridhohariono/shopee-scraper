@extends('layouts.app')
@section('content')
<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
        </ol>
    </nav>
    <h1 class="h2">Dashboard</h1>
    <p>This is the homepage of a simple admin interface which is part of a tutorial written on Themesberg
    </p>
    <div class="row my-4">
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card">
                <h5 class="card-header">Data Scraped</h5>
                <div class="card-body">
                    <h5 class="card-title">345k</h5>
                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                    <p class="card-text text-success">18.2% increase since last month</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Keyword</h5>
                <div class="card-body">
                    <h5 class="card-title">$2.4k</h5>
                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                    <p class="card-text text-success">4.6% increase since last month</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Queue</h5>
                <div class="card-body">
                    <h5 class="card-title">43</h5>
                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                    <p class="card-text text-danger">2.6% decrease since last month</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
            <div class="card">
                <h5 class="card-header">Scrape Failed</h5>
                <div class="card-body">
                    <h5 class="card-title">64k</h5>
                    <p class="card-text">Feb 1 - Apr 1, United States</p>
                    <p class="card-text text-success">2.5% increase since last month</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Product Scraped</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Iphone</th>
                                    <td>Jakarta Barat</td>
                                    <td>Wudachi212</td>
                                    <td>€61.11</td>
                                    <td>Aug 31 2020</td>
                                    <td><a href="https://www.shopee/iasjd/iphonklasd?asdj231"
                                            class="btn btn-shopee btn-sm text-light" target="_blank">View</a></td>
                                <tr>
                                    <th scope="row">Xiomi</th>
                                    <td>Sumatera Utara</td>
                                    <td>Phone Center</td>
                                    <td>$153.11</td>
                                    <td>Aug 28 2020</td>
                                    <td><a href="https://www.shopee/iasjd/iphonklasd?asdj231"
                                            class="btn btn-shopee btn-sm text-light" target="_blank">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="btn btn-block btn-light">View all</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="pt-5 d-flex justify-content-between">
        <span>Copyright © 2019-2020 <a href="https://themesberg.com">Themesberg</a></span>
        <ul class="nav m-0">
            <li class="nav-item">
                <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="#">Terms and conditions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="#">Contact</a>
            </li>
        </ul>
    </footer>
</main>
@endsection