<script>
window.hash = "<? echo $hash;?>";
</script>
<section id="main" class="clearfix">
    	<div id="main-header" class="page-header">
            <h1 id="main-heading">
            	Gestió de POIs<span>Gestionar els POIS del mapa</span>
            </h1>
        </div>
        <div id="campsActions">
                    <button id="addPOI" class="btn btn-success"><i class="icol-layer-treansparent"></i> Afegir POI</button>
            </div>
        <div id="main-content">
        	<div id="dashboard-demo" class="tabbable analytics-tab paper-stack">
        	 <div id="camposDivTable" class="widget-content table-container">
              <table id="POISBackendTable" class="table table-striped table-bordered table-hover">
				  <thead>
					  <tr>
						<th>Nom</th>
						<th>Direcció</th>
					  	<th>E-mail</th>
					  	<th>Telefon</th>
					  </tr>
				  </thead>
				  <tbody></tbody>
				  <tr></tr>
			  </table>    
             </div>
            </div>
            </div>            
        </div>
</section>