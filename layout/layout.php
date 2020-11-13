<?php

class Layout{

  private $isPage;
  private $directory;


  function __construct($page){
    $this->isPage = $page;

    $this->directory = ($this->isPage) ? "../" : "";
  }

  public function printHeader(){
    $header = <<<EOF

    <html lang="en"><head><style id="stndz-style">div[class*="item-container-obpd"], a[data-redirect*="paid.outbrain.com"], a[onmousedown*="paid.outbrain.com"] { display: none !important; } a div[class*="item-container-ad"] { height: 0px !important; overflow: hidden !important; position: absolute !important; } div[data-item-syndicated="true"] { display: none !important; } .grv_is_sponsored { display: none !important; } .zergnet-widget-related { display: none !important; } </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Transacciones</title>


    <!-- Bootstrap core CSS -->
<link href="{$this->directory}assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{$this->directory}assets\css\styles.css" rel="stylesheet" type="text/css">

  </head>
  <body cz-shortcut-listen="true">
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>

      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-center">
    <h3 class="text-center text-white">Lista de Transacciones By - Miguel Angel Peña Santos - 2018-6717</h3>
    
    </div>
  </div>
</header>

EOF;

echo $header;
}

public function printFooter(){
    $footer = <<<EOF

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="{$this->directory}assets\js\bootstrap.min.js"></script>
  
  </body></html>

EOF;

echo $footer;
}

}


?>