<?php

$helper = $sf_context->get('layout_helper');

echo 
$helper->renderDoctype(),
$helper->renderHtmlTag(),

  "\n<head>\n",
    $helper->renderHead(),
  "\n</head>\n",
  
//  '<body class="dm" onload="window.print();">',
  
  $helper->renderBodyTag('.dm'),

    '<div class="container" id="dm_admin_content">',

      $sf_content,

    '</div>',
      
    $helper->renderJavascriptConfig(),
    $helper->renderJavascripts(),
        
  '</body>',
'</html>';