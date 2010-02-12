(function($) {

$(function() {

  if(!google || !google.maps)
  {
    return;
  }

  var icon = new google.maps.MarkerImage(
    dm_configuration.relative_url_root+'/dmOppPlugin/images/target.png',
    new google.maps.Size(16, 16)
  );

  $('div.dm_opp_global_map').each(function()
  {
    var
    self = $(this),
    options = $.extend({
      zoom: 12,
      mapTypeId: google.maps.MapTypeId.HYBRID,
      center: [ 48.62, -2.47 ]
    }, $.parseJSON(self.find('textarea').val())),
    map;

    $(window).bind('resize', function()
    {
      self.height($(window).height() - 80);
    }).trigger('resize');

    center = new google.maps.LatLng(options.center[0], options.center[1]);

    map = new google.maps.Map(self.get(0), $.extend(options, { center: center }));

    $.each(options.photos, function()
    {
      var photo = this;
      
      photo.marker = new google.maps.Marker({
        position:   new google.maps.LatLng(photo.coords[0], photo.coords[1]),
        title:      photo.title,
        clickable:  true,
        map:        map/*,
        icon:       icon*/
      });

      photo.infowindow = new google.maps.InfoWindow({
        content: photo.html,
        maxWidth: 350
      });
      
      google.maps.event.addListener(photo.marker, 'click', function()
      {
        photo.infowindow.open(map, photo.marker);
      });

      if(photo.open)
      {
        photo.infowindow.open(map, photo.marker);
      }
    });
  });

});

})(jQuery);