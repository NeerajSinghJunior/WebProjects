@extends('layouts.app') @section('htmlheader_title') Notifications @endsection @section('contentheader_title')

<section class="content ">
    <div class="row">
        <p class="addon-caption">ICO Power Packs</p>
        <div class="col-md-6 col-sm-12">
            <div class="addon-box">
                <div class="addon-banner-a">
                </div>
                <div class="addon-content">
                    <p class="flow-text"><b>ICO Marketing</b></p>
                    <p>An ICO marketing campaign that is proven to boost your coin's reach to potential investors across social media platforms.</p>
                    <a class="btn btn-primary" data-toggle="modal" href="#addon">Know More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="addon-box">
                <div class="addon-banner-b">
                </div>
                <div class="addon-content">
                    <p class="flow-text"><b>ICO LISTING</b></p>
                    <p>Listing your ICO on ICO listing sites can help garner more coin sales on the day of ICO. Get your ICO listed on a wide network of ICO listing sites. </p>
                </div>
            </div>
        </div>
    </div><!--row-->
    <div class="row">
        <div class="col-md-6 col-sm-12">
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
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="addon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
@endsection