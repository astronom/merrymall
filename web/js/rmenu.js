$(function()
{
// Animate right menu
  $('.inf-tl').click(function ()
    {
        if ($(this).hasClass('inf-exp'))
        {
            $(this).addClass('inf-coll').removeClass('inf-exp').next('.inf-ct').slideUp();
            return false;
        }
        else
        {
            $('#rmenu > .inf-it > .inf-exp').addClass('inf-coll').removeClass('inf-exp').next('.inf-ct').slideUp();
            $(this).removeClass('inf-coll').addClass('inf-exp').next('.inf-ct').slideDown();
            return false;
        }
    });

    $('#rmenu').bind('floor_selected#rmenu', function(event, floor_new, floor_max)
    {
      $('ul.fs > li > a').removeClass('floor-selected');
      $('ul.fs > li > a').eq(floor_max - floor_new).addClass('floor-selected');
    });
});