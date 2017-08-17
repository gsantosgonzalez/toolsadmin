<template>
	<div class="container">
        <div class="row main">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Listado de herramientas</h2>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-tool">
                            Registrar
                        </button>
                    </div>
                </div>
            </div>
            <div class="main-login main-center table-responsive" v-show="tools.length > 0">
                <table class="table table-striped">
                	<thead>
                        <tr>
                    		<th><a href="#" @click="getOrderedTools('name')">Nombre</a></th>
                    		<th>Descripción</th>
                            <th><a href="#" @click="getOrderedTools('area_id')">Area</a></th>
                            <th><a href="#" @click="getOrderedTools('type_id')">Tipo</a></th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                	</thead>
                	<tbody>
                		<tr v-for="tool in tools">
                			<td>{{ tool.name }}</td>
                			<td>{{ tool.description }}</td>
                            <td><a href="#" role="button" @click="getFilteredTools('area_id', tool.area_id)">{{ tool.area.area_name }}</a></td>
                            <td><a href="#" role="button" @click="getFilteredTools('type_id', tool.type_id)">{{ tool.type.type_name }}</a></td>
                            <td>{{ tool.responsible.responsible_name }}</td>
                            <td>
                                <button @click="editTool(tool)" class="btn btn-warning btn-xs" v-bind:value="tool.id" data-toggle="modal" data-target="#edit-tool"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                <button @click="deleteTool(tool)" class="btn btn-danger btn-xs" v-bind:value="tool.id"><span class="glyphicon glyphicon-remove"></span></button>
                            </td>
                		</tr>
                	</tbody>
                </table>
            </div>

            <!-- Create Tool Modal -->
            <div class="modal fade" id="create-tool" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="cierraModal('create-tool')" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
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
                                            <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="cols-sm-2 control-label">Descripción</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="description" id="description" placeholder="Ingresa la descripción"  v-model="newTool.description"/>
                                            <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
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
                                                <option v-for="area in areas" v-bind:value="area.id">{{ area.area_name }}</option>
                                            </select>
                                            <span v-if="formErrors['area_id']" class="error text-danger">{{ formErrors['area_id'] }}</span>
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
                                                <option v-for="type in types" v-bind:value="type.id">{{ type.type_name }}</option>
                                            </select>
                                            <span v-if="formErrors['type_id']" class="error text-danger">{{ formErrors['type_id'] }}</span>
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
                                                <option v-for="responsible in responsibles" v-bind:value="responsible.id">{{ responsible.responsible_name }}</option>
                                            </select>
                                            <span v-if="formErrors['responsible_id']" class="error text-danger">{{ formErrors['responsible_id'] }}</span>
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
            <!-- Create Tool Modal -->

            <!-- Edit Tool Modal -->
            <div class="modal fade" id="edit-tool" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="cierraModal('edit-tool')" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar Herramienta</h4>
                        </div>
                        <div class="modal-body">
                            <form class="" method="POST">
                                <div class="form-group">
                                    <label for="tool_name" class="cols-sm-2 control-label">Nombre de la herramienta</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="tool_name" id="tool_name" v-bind:placeholder="updatedTool.name" v-model="updatedTool.name"/>
                                            <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="cols-sm-2 control-label">Descripción</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="description" id="description" v-bind:placeholder="updatedTool.description"  v-model="updatedTool.description"/>
                                            <span v-if="formErrorsUpdate['description']" class="error text-danger">{{ formErrorsUpdate['description'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="area" class="cols-sm-2 control-label">Área</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>
                                            <select class="form-control" id="areaSelect" v-model="updatedTool.area_id">
                                                <option value="" disabled selected>Select your option</option>
                                                <option v-for="area in areas" v-bind:value="area.id" v-bind:class="[updatedTool.area_id == area.id ? 'selected' : '']">{{ area.area_name }}</option>
                                            </select>
                                            <span v-if="formErrorsUpdate['area_id']" class="error text-danger">{{ formErrorsUpdate['area_id'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type" class="cols-sm-2 control-label">Tipo</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                            <select class="form-control" id="typeSelect" v-model="updatedTool.type_id">
                                                <option value="" disabled selected>Select your option</option>
                                                <option v-for="type in types" v-bind:value="type.id" v-bind:class="[updatedTool.type_id == type.id ? 'selected' : '']">{{ type.type_name }}</option>
                                            </select>
                                            <span v-if="formErrorsUpdate['type_id']" class="error text-danger">{{ formErrorsUpdate['type_id'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="responsible" class="cols-sm-2 control-label">Responsable</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                            <select class="form-control" id="responsibleSelect" v-model="updatedTool.responsible_id">
                                                <option value="" disabled selected>Select your option</option>
                                                <option v-for="responsible in responsibles" v-bind:value="responsible.id" v-bind:class="[updatedTool.responsible_id == responsible.id ? 'selected' : '']">{{ responsible.responsible_name }}</option>
                                            </select>
                                            <span v-if="formErrorsUpdate['responsible_id']" class="error text-danger">{{ formErrorsUpdate['responsible_id'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <button type="button" id="button" class="btn btn-primary btn-lg btn-block" @click="updateTool(updatedTool.id)">Registrar</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Tool Modal -->

        </div> <!-- row-main -->
    </div> <!-- container -->
    
</template>
<script>
    export default {
        data() {
            return {
            	tools: [],
                types: [],
                areas: [],
                responsibles: [],
                order: '',
                filter: '',
                filterValue: '',
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
                formErrorsUpdate:{},
            }
        },
        ready: function(){
            this.getTools();
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
            getTools(){
                this.tools = [];
                this.order = '';
                this.filter = '';
                this.filterValue = '';
                axios.get('getTools').then(response => {
                    $.each(response.data, (index, value) => {
                        this.tools.push(value);
                    })
                });
            },
            getFilteredTools(filter, value){
                this.tools = [];
                this.filter = filter;
                this.filterValue = value;
                axios.get('getTools', {
                    params : {
                        filter: filter,
                        value: value
                    }
                }).then(response => {
                    $.each(response.data, (index, value) => {
                        this.tools.push(value);
                    })
                });
            },
            getOrderedTools(order){
                this.tools = [];
                this.order = order;
                if(this.filter != ''){
                    axios.get('getTools', {
                        params : {
                            order: order,
                            filter: this.filter,
                            value: this.filterValue
                        }
                    }).then(response => {
                        $.each(response.data, (index, value) => {
                            this.tools.push(value);
                        })
                    });
                }
                else {
                    axios.get('getTools', {
                        params : {
                            order: order
                        }
                    }).then(response => {
                        $.each(response.data, (index, value) => {
                            this.tools.push(value);
                        })
                    });
                }
            },
            registerTool() {
                var self = this;
                var input = this.newTool;
                axios
                .post('/tools', input)
                .then( function(response) {
                    if(response.data.status == 1) {
                        toastr.success( 'Se almacenó correctamente.', '¡Éxito!', { timeOut: 5000 } );
                        self.newTool = { 'name': '', 'description': '', 'area_id': '', 'type_id': '', 'responsible_id': '' };
                        self.getTools();
                        $('#create-tool').modal('hide');
                    }
                    else {
                        toastr.error( 'Debes rellenar todos los campos.', '¡Error!', { timeOut: 5000 } );
                        self.formErrors = response.data.errors;
                        setTimeout(function() { self.formErrors = {}; }, 3000);
                    }
                });
            },
            editTool(tool){
                this.updatedTool.id = tool.id;
                this.updatedTool.name = tool.name;
                this.updatedTool.description = tool.description;
                this.updatedTool.area_id = tool.area_id;
                this.updatedTool.type_id = tool.type_id;
                this.updatedTool.responsible_id = tool.responsible_id;
            },
            updateTool(id) {
                var self = this;
                var input = this.updatedTool;
                axios
                .post('/tools/update', {
                    id: id,
                    input: input,
                })
                .then( function(response) {
                    if(response.data.status == 1) {
                        toastr.success( 'Se actualizó correctamente.', '¡Éxito!', { timeOut: 5000 } );
                        self.updatedTool = { 'id': '', 'name': '', 'description': '', 'area_id': '', 'type_id': '', 'responsible_id': '' };
                        self.getTools();
                        $('#edit-tool').modal('hide');
                    }
                    else {
                        toastr.error( 'Debes rellenar todos los campos.', '¡Error!', { timeOut: 5000 } );
                        self.formErrorsUpdate = response.data.errors;
                        setTimeout(function() { self.formErrorsUpdate = {}; }, 3000);
                    }
                });
            },
            deleteTool(tool){
                let tool_id = $('button.btn-warning').val()
                console.log(tool_id)
            },
            cierraModal(modal){
                $('#'+modal).modal('hide');
                this.newTool = { 'name': '', 'description': '', 'area_id': '', 'type_id': '', 'responsible_id': '' };
                this.updatedTool = { 'id': '', 'name': '', 'description': '', 'area_id': '', 'type_id': '', 'responsible_id': '' };
                this.formErrors = {};
                this.formErrorsUpdate = {};
            }
        }
    }
</script>