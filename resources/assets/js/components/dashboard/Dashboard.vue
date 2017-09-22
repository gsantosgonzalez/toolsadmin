<template>
	<div class="container">
	    <div class="row main">
	      	<div class="col-lg-4 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
							    <i class="glyphicon glyphicon-number glyph-lg"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div>Total</div>
								<div>Herramientas</div>
								<div class="huge">{{ total }}</div>
							</div>
						</div>
					</div>
					<a href="tools">
					  <div class="panel-footer">
					      <span class="pull-left">Lista</span>
					      <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
					      <div class="clearfix"></div>
					  </div>
					</a>
				</div>
	          </div> <!-- col-lg-4 col-md-6 -->
	          <div class="col-lg-4 col-md-6">
	              <div class="panel panel-success">
	                  <div class="panel-heading">
	                      <div class="row">
	                          <div class="col-xs-3">
	                              <i class="glyphicon glyphicon-usd glyph-lg"></i>
	                          </div>
	                          <div class="col-xs-9 text-right">
	                              <div>Mayor Precio</div>
	                              <div class="medium-font">{{ topPrice.name }}</div>
	                              <div class="huge">{{ topPrice.cost }}</div>
	                          </div>
	                      </div>
	                  </div>
	                  <a href="#">
	                      <div class="panel-footer">
	                          <span class="pull-left">Detalles</span>
	                          <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
	                          <div class="clearfix"></div>
	                      </div>
	                  </a>
	              </div>
	          </div> <!-- col-lg-4 col-md-6 -->
	          <div class="col-lg-4 col-md-6">
	              <div class="panel panel-success">
	                  <div class="panel-heading">
	                      <div class="row">
	                          <div class="col-xs-3">
	                              <i class="glyphicon glyphicon-usd glyph-lg"></i>
	                          </div>
	                          <div class="col-xs-9 text-right">
	                              <div>Menor Precio</div>
	                              <div class="medium-font">{{ lowPrice.name }}</div>
	                              <div class="huge">{{ lowPrice.cost }}</div>
	                          </div>
	                      </div>
	                  </div>
	                  <a href="#">
	                      <div class="panel-footer">
	                          <span class="pull-left">Detalles</span>
	                          <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
	                          <div class="clearfix"></div>
	                      </div>
	                  </a>
	              </div>
	          </div> <!-- col-lg-4 col-md-6 -->
	          <div class="col-lg-4 col-md-6">
	              <div class="panel panel-warning">
	                  <div class="panel-heading">
	                      <div class="row">
	                          <div class="col-xs-3">
	                              <i class="glyphicon glyphicon-time glyph-lg"></i>
	                          </div>
	                          <div class="col-xs-9 text-right">
	                              <div>Más Antigua</div>
	                              <div class="medium-font">{{ older.name }}</div>
	                              <div class="huge">{{ older.date }}</div>
	                          </div>
	                      </div>
	                  </div>
	                  <a href="#">
	                      <div class="panel-footer">
	                          <span class="pull-left">Detalles</span>
	                          <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
	                          <div class="clearfix"></div>
	                      </div>
	                  </a>
	              </div>
	          </div> <!-- col-lg-4 col-md-6 -->
	          <div class="col-lg-4 col-md-6">
	              <div class="panel panel-warning">
	                  <div class="panel-heading">
	                      <div class="row">
	                          <div class="col-xs-3">
	                              <i class="glyphicon glyphicon-time glyph-lg"></i>
	                          </div>
	                          <div class="col-xs-9 text-right">
	                              <div>Más Reciente</div>
	                              <div class="medium-font">{{ newer.name }}</div>
	                              <div class="huge">{{ newer.date }}</div>
	                          </div>
	                      </div>
	                  </div>
	                  <a href="#">
	                      <div class="panel-footer">
	                          <span class="pull-left">Detalles</span>
	                          <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
	                          <div class="clearfix"></div>
	                      </div>
	                  </a>
	              </div>
	          </div> <!-- col-lg-4 col-md-6 -->
	      </div> <!-- row main -->

		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="form-group">
	                  <label for="type" class="cols-sm-2 control-label">Filtrar por:</label>
	                  <div class="cols-sm-10">
	                      <div class="input-group">
	                          <span class="input-group-addon"><i class="glyphicon glyphicon-filter" aria-hidden="true"></i></span>
	                          <select class="form-control" id="typeSelect" v-model="filtro">
	                              <option value="" disabled selected>Selecciona</option>
	                              <option value="area_id">Area</option>
	                              <option value="toolType_id">Tool Type</option>
	                          </select>
	                      </div>
	                  </div>
	              </div>
			</div> <!-- col-lg-3 col-md-6 -->
			<div class="col-lg-3 col-md-6" v-show="filtro == 'toolType_id'">
				<div class="form-group">
	                  <label for="type" class="cols-sm-2 control-label">Tipo de herramienta:</label>
	                  <div class="cols-sm-10">
	                      <div class="input-group">
	                          <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
	                          <select class="form-control" id="typeSelect" v-model="value">
	                              <option value="" disabled selected>Selecciona</option>
	                              <option v-for="toolType in toolTypes" v-bind:value="toolType.id">{{ toolType.name }}</option>
	                          </select>
	                      </div>
	                  </div>
	              </div>
			</div> <!-- col-lg-3 col-md-6 -->
			<div class="col-lg-3 col-md-6" v-show="filtro == 'area_id'">
				<div class="form-group">
	                  <label for="type" class="cols-sm-2 control-label">Area:</label>
	                  <div class="cols-sm-10">
	                      <div class="input-group">
	                          <span class="input-group-addon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>
	                          <select class="form-control" id="typeSelect" v-model="value">
	                              <option value="" disabled selected>Selecciona</option>
	                              <option v-for="area in areas" v-bind:value="area.id">{{ area.name }}</option>
	                          </select>
	                      </div>
	                  </div>
	              </div>
			</div> <!-- col-lg-3 col-md-6 -->
		</div> <!-- Row -->

	</div>
</template>
<script>
export default {
	data() {
        return {
			total: '',
			topPrice: [],
			lowPrice: [],
			newer: [],
			older: [],
			filtro: '',
			value: '',
			toolType: '',
			toolTypes: [],
			area: '',
			areas: [],
			tools: []
        }
    },
    ready: function() {

    },
    mounted: function() {
  		this.getTops(this.filtro, this.value)
    },
    methods: {
      	getTops(filter, value){
	            this.total = '';
	            this.topPrice = '';
	            this.lowPrice = '';
	            this.newer = '';
	            this.older = '';
	            axios.get('dashboard/tops', {
	            	params : {
                        filter: filter,
                        value: value
                    }
	            }).then(response => {
	                this.total = response.data.total;
	                this.topPrice = response.data.topPrice[0];
	                this.lowPrice = response.data.lowPrice[0];
	                this.newer = response.data.newer[0];
	                this.older = response.data.older[0];
              });
          }
    },
    watch: {
      	filtro: function(val) {
      		if(val == 'toolType_id'){
      			this.areas = [];
      			axios.get('/tooltypes').then(response => {
	                $.each(response.data, (index, value) => {
	                    this.toolTypes.push(value);
	                })
	            });
      		}
      		else {
      			this.toolTypes = [];
      			axios.get('/areas').then(response => {
	            	$.each(response.data, (index, value) => {
	            		this.areas.push(value);
	            	})
	            });
      		}
      	},
      	value: function(val) {
      		this.getTops(this.filtro, val)
      	}
    }
}
</script>
