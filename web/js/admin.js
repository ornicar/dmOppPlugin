(function($)
{
  $(function()
  {
    $('div.opp_interet_selector').each(function()
    {
      var
      $interets = $(this).find('ul.interets > li'),
      $categs   = $(this).find('.element_categs a');

      $(this)
      // add rounded corners to labels
      .find('div.radio_list').each(function()
      {
        $(this)
        .find('label:first').addClass('ui-corner-left').end()
        .find('label:last').addClass('ui-corner-right');
      }).end()
      // set active class to initially active labels
      .find('div.radio_list label').each(function()
      {
        $(this).toggleClass('active', $('#'+$(this).attr('for')).attr('checked'));
      }).end()
      // change active class when a label is clicked
      .delegate('div.radio_list input', 'change', function()
      {
        $(this).parent()
        .find('label').removeClass('active').end()
        .find('label[for='+$(this).attr('id')+']').addClass('active');
      });

      $categs
      .click(function()
      {
        $categs.removeClass('selected');
        $(this).addClass('selected');
        
        var categSlug = $(this).attr('data-slug');

        $interets.filter(':visible').not('.'+categSlug).hide();
        $interets.filter('.'+categSlug).show();
      })
      .filter(':first').trigger('click');
    });
  });
})(jQuery);