@extends('admin.layouts.app')
@section('site_tile',auth()->user()->site_title)
@section('content')
<style>
        .dataTables_filter {
            float: right;
            width: 25%;
            display: inline-block;
            white-space: nowrap;
        }
        .dt-buttons{
            border: 1px solid #f1f1f1;
            padding: 1em;
            border-radius: 3px;
        }
        .modal-header{
            display: inline-block;
            text-align: left;
        }
        .modal-header .close{
            padding:0;
        }
</style>
<div class="page-wrapper">
    <!-- Bread crumb -->
    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-primary">ICO Power Packs</h3>
        </div>
    </div>
    <!-- End Bread crumb -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row page-inner">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="addon-box">
                            <div class="addon-banner-a">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>ICO Marketing</b></p>
                                <p>An ICO marketing campaign that is proven to boost your coin's reach to potential investors across social media platforms.</p>
                                <a class="btn btn-primary"  href="https://www.messenger.com/t/194868894428597">Know More</a>
                            </div>
                        </div><!--addon-box-->
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="addon-box">
                            <div class="addon-banner-b">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>ICO LISTING</b></p>
                                <p>Listing your ICO on ICO listing sites can help garner more coin sales on the day of ICO. Get your ICO listed on a wide network of ICO listing sites. </p>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-md-12">
                        <div class="addon-box">
                            <div class="addon-banner-b">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>ICO LISTING</b></p>
                                <p>Listing your ICO on ICO listing sites can help garner more coin sales on the day of ICO. Get your ICO listed on a wide network of ICO listing sites. </p>
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <div class="addon-box">
                            <div class="addon-banner-c">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>Whitepaper Writing</b></p>
                                <p>An Expert written Whitepaper that backs your ICO's business model and explains the Initial Coin Offering process in detail.</p>
                                <a href="#" class="btn btn-primary">Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="addon-box">
                            <div class="addon-banner-c">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>Whitepaper Writing</b></p>
                                <p>An Expert written Whitepaper that backs your ICO's business model and explains the Initial Coin Offering process in detail.</p>
                                <a href="#" class="btn btn-primary">Know More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="addon-box">
                            <div class="addon-banner-c">
                            </div>
                            <div class="addon-content">
                                <p class="flow-text"><b>Whitepaper Writing</b></p>
                                <p>An Expert written Whitepaper that backs your ICO's business model and explains the Initial Coin Offering process in detail.</p>
                            </div>
                        </div>
                    </div>
                </div><!--row-->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addon" tabindex="-1" role="dialog" aria-labelledby="myModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModal">Modal title</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-7 col-xs-12">
                        <div class="addon-left-box">
                            <p class="lead">Description</p>
                            <p>Hassle-free design, marketing, and security — all in one place.</p>
                            <p>DESIGN SERVICES</p>
                            <p>Hassle-free design, marketing, and security — all in one place.</p>
                            <ul>
                                <li>Hassle-free design, marketing, and security — all in one place.</li>
                                <li>Hassle-free design, marketing, and security — all in one place.</li>
                                <li>Hassle-free design, marketing, and security — all in one place.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div class="addon-right-box">
                            <p>Version:<span class="pull-right">6.1.1</span></p>
                            <p>Last updated:<span class="pull-right">1 week ag</span></p>
                            <p>Active installations:<span class="pull-right">4+ million</span></p>
                            <p>Requires WordPress Version:<span class="pull-right">4.7</span></p>
                            <p>Tested up to:<span class="pull-right">4.9.6</span></p>
                            <p>Languages:<span class="pull-right">see all</span></p>
                           
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End PAge Content -->
    </div>

    <!-- End Container fluid  -->
    <!-- footer -->    
    {{-- @include('layouts.partials.footer') --}}
    <!-- End footer -->
</div>
@endsection


@section('extra-scripts')
<script>

    App.start("{{ Auth::guard('admin')->user()->ether}}");

</script>
<script>
       $(document).ready(function(){
           
            $('.close').click(function(){
                $('.modal').hide();
                $('.modal-backdrop.show').hide();
            });
            
       });
    </script>
@endsection