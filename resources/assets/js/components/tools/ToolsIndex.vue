<template>
	<div class="container">
        <div class="row main">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Listado de herramientas</h2>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-item">
                            Registrar
                        </button>
                    </div>
                </div>
            </div>
            <div class="main-login main-center table-responsive" v-show="tools.length > 0">
                <table class="table table-striped">
                	<thead class="thead-inverse">
                        <tr>
                    		<th>Nombre</th>
                    		<th>Descripción</th>
                            <th>Area</th>
                            <th>Tipo</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                	</thead>
                	<tbody>
                		<tr v-for="tool in tools">
                			<td>{{ tool.name }}</td>
                			<td>{{ tool.description }}</td>
                            <td>{{ tool.area.area_name }}</td>
                            <td>{{ tool.type.type_name }}</td>
                            <td>{{ tool.responsible.responsible_name }}</td>
                            <td>
                                <button @click="editTool" class="btn btn-warning btn-xs" v-bind:value="tool.id" data-toggle="modal" data-target="#create-item"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                <button @click="deleteTool" class="btn btn-danger btn-xs" v-bind:value="tool.id"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                		</tr>
                	</tbody>
                </table>
            </div>
            <!-- Create Item Modal -->
            <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
                            <h4 class="modal-title" id="myModalLabel">Registrar Herramienta</h4>
                        </div>
                        <div class="modal-body">
                            <form class="" method="POST">
                            
                            <div class="form-group">
                                <label for="tool_name" class="cols-sm-2 control-label">Nombre de la herramienta</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="tool_name" id="tool_name" placeholder="Nombre de la herramienta" v-model="newTool.name"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="cols-sm-2 control-label">Descripción</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Ingresa la descripción"  v-model="newTool.description"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="area" class="cols-sm-2 control-label">Área</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>
                                        <select class="form-control" id="areaSelect" v-model="newTool.area_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option v-for="area in areas" v-bind:value="area.id">@{{ area.area_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="cols-sm-2 control-label">Tipo</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                        <select class="form-control" id="typeSelect" v-model="newTool.type_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option v-for="type in types" v-bind:value="type.id">@{{ type.type_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="responsible" class="cols-sm-2 control-label">Responsable</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                        <select class="form-control" id="responsibleSelect" v-model="newTool.responsible_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option v-for="responsible in responsibles" v-bind:value="responsible.id">@{{ responsible.responsible_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="button" id="button" class="btn btn-primary btn-lg btn-block" @click="registerTool">Registrar</button>
                            </div>
                            
                        </form>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Edit Item Modal -->
            <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                  </div>
                  <div class="modal-body">
                        
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
    
</template>
<script>
    export default {
        data() {
            return {
            	tools: [],
                types: [],
                areas: [],
                responsibles: [],
                newTool: {
                    'name': '',
                    'description': '',
                    'area_id': '',
                    'type_id': '',
                    'responsible_id': ''
                },
                updatedTool: {
                    'name': '',
                    'description': '',
                    'area_id': '',
                    'type_id': '',
                    'responsible_id': '',
                    'id': ''
                },
                formErrors:{},
                formErrorsUpdate:{},            }
        },
        mounted() {
        	axios.get('/types').then(response => {
                $.each(response.data, (index, value) => {
                    this.types.push(value);
                })
            });
            axios.get('/areas').then(response => {
                $.each(response.data, (index, value) => {
                    this.areas.push(value);
                })
            });
            axios.get('/responsibles').then(response => {
                $.each(response.data, (index, value) => {
                    this.responsibles.push(value);
                })
            });
            axios.get('getTools').then(response => {
                $.each(response.data, (index, value) => {
                    this.tools.push(value);
                })
            });
        },
        methods: {
            showError(){
                $('<div class="alert alert-danger" role="alert">\
                    <strong>Sorry!</strong> Ocurrió un error, revisa que todos los campos hayan sido rellenados correctamente\
                </div>').insertBefore('form');
                setTimeout(function() { $('.alert').remove(); }, 3000);
            },
            showSuccess(){
                $('<div class="alert alert-success" role="alert">\
                    <strong>¡Éxito!</strong> Se ha almacenado correctamente\
                </div>').insertBefore('form');
                setTimeout(function() { $('.alert').remove(); }, 3000);
            },
            registerTool() {
                var input = this.newTool;
                axios.post('/tools', input).then(response => {
                    if(response.data.status == 0){
                        this.showError();
                        console.log(response.data)
                        console.log(response.data);
                    }
                    else {
                        this.showSuccess();
                        this.newTool = { 'name': '', 'description': '', 'area_id': '', 'type_id': '', 'responsible_id': '' };
                        console.log(response.data.tool);
                    }
                });
            },
            editTool(){
                let tool_id = $('button.btn-warning').val()
                console.log(tool_id)
            },
            deleteTool(e){
                let tool_id = $('button.btn-warning').val()
                console.log(tool_id)
            }
        }
    }
</script>