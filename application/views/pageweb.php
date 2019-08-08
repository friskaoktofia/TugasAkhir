<div class="wrapper wrapper-content" style="margin-top: -20px;">
    <div class="row wrapper border-bottom white-bg page-heading border-headernya">
        <div class="col-lg-12">
            <center><h2 class="text-navy" style="color:black"><b>Water Quality Mapping</b></h2>
        </div>
    </div>
    <br>
            <div class="topnav">
                <div class="col-lg-12">
                
                    <a href="<?php echo site_url('TugasAkhir/index')?>" class="btn btn-secondary btn-sm <?= $pages["index"]?>" role="button" aria-pressed="true">Turbidity</a>
                    <a href="<?php echo site_url('TugasAkhir/dummy')?>" class="btn btn-secondary btn-sm <?= $pages["dummy"]?>" role="button" aria-pressed="true">Dummy</a>
                    <a href="<?php echo site_url('TugasAkhir/suhu')?>" class="btn btn-secondary btn-sm <?= $pages["suhu"]?>" role="button" aria-pressed="true">Suhu</a>
                    <a href="<?php echo site_url('TugasAkhir/ph')?>" class="btn btn-secondary btn-sm <?= $pages["ph"]?>" role="button" aria-pressed="true">pH</a>
                    <a href="<?php echo site_url('TugasAkhir/tds')?>" class="btn btn-secondary btn-sm <?= $pages["tds"]?>" role="button" aria-pressed="true">TDS</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        </div>        