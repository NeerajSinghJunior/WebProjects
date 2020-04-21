
<style>
        .active-item {

        }
        .closed-item {
            display: none;
        }
</style>
<div class="carousel-content">
    <div class="item active-item">Step 1</div>
    <div class="item closed-item">Step 2</div>
    <div class="item closed-item">Step 3</div>
    <div class="item closed-item">Step 4</div>
    <button class="next">Next</button>
    <button class="previous">Previous</button>
</div>
<script src="{{ asset('/adassets/js/lib/jquery/jquery.min.js') }}"></script>
{{-- @section('extra-scripts') --}}
<script>
    $('.next,.previous').click(function() {
        var content = $(this).parent('.carousel-content');
        var totalItem = content.find('.item').length;
        var activeItem = content.find('.item.active-item');
        if($(this).hasClass('next') && activeItem.next('.item').length) {
            activeItem.removeClass('active-item').addClass('closed-item');
            activeItem.next().addClass('active-item').removeClass('closed-item');
        }
        if($(this).hasClass('previous') && activeItem.prev('.item').length) {
            activeItem.removeClass('active-item').addClass('closed-item');
            activeItem.prev().addClass('active-item').removeClass('closed-item');
        }
    });
</script>
{{-- @endsection --}}