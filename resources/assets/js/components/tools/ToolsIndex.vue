<template>
	<div class="container">
        <div class="row main">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>{{ show_name }}</h2>
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
                            <th><a href="#" @click="getOrderedTools('toolType_id')">Tipo</a></th>
                            <!-- <th>Fecha de Adquisición</th>
                            <th>Costo</th> -->
                            <th>Acciones</th>
                        </tr>
                	</thead>
                	<tbody>
                		<tr v-for="tool in tools">
                			<td><a href="#" role="button" @click="showTool(tool)" data-toggle="modal" data-target="#show-tool">{{ tool.name }}</a></td>
                			<td>{{ tool.description }}</td>
                            <td><a href="#" role="button" @click="getFilteredTools('toolType_id', tool.toolType_id)">{{ tool.tool_types.name }}</a></td>
                            <!-- <td>{{ tool.tool_contracts[0].contract_date }}</td>
                            <td>{{ tool.tool_contracts[0].cost }}</td> -->
                            <td>
                                <button @click="editTool(tool)" class="btn btn-warning btn-xs" v-bind:value="tool.id" data-toggle="modal" data-target="#edit-tool"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;&nbsp;
                                <button @click="deleteTool(tool)" class="btn btn-danger btn-xs" v-bind:value="tool.id"><span class="glyphicon glyphicon-trash"></span></button>
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
                            <button type="button" class="close" @click="cierraModal('create-tool')" aria-label="Close"><span class="glyph-md">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Registrar Herramienta</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tool_name" class="control-label">Nombre</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="tool_name" id="tool_name" placeholder="Nombre de la herramienta" v-model="newTool.name"/>
                                    </div>
                                    <span v-if="formErrors['name']" class="error text-danger">{{ formErrors['name'] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="control-label">Descripción</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="description" id="description" placeholder="Ingresa la descripción"  v-model="newTool.description"/>
                                    </div>
                                    <span v-if="formErrors['description']" class="error text-danger">{{ formErrors['description'] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="toolType" class="control-label">Tipo</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                        <select class="form-control" id="typeSelect" v-model="newTool.toolType_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option v-for="toolType in toolTypes" v-bind:value="toolType.id">{{ toolType.name }}</option>
                                        </select>
                                    </div>
                                    <span v-if="formErrors['toolType_id']" class="error text-danger">{{ formErrors['toolType_id'] }}</span>
                                </div>
                            </div>                                

                            <div class="form-group">
                                <button type="button" id="button" class="btn btn-primary" @click="registerTool">Registrar</button>
                            </div>
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
                            <button type="button" class="close" @click="cierraModal('edit-tool')" aria-label="Close"><span class="glyph-md">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar Herramienta</h4>
                        </div>
                        <div class="modal-body">
                            <form class="" method="POST">
                                <div class="form-group">
                                    <label for="tool_name" class="control-label">Nombre</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="tool_name" id="tool_name" v-bind:placeholder="updatedTool.name" v-model="updatedTool.name"/>
                                        </div>
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate['name'] }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="control-label">Descripción</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="description" id="description" v-bind:placeholder="updatedTool.description"  v-model="updatedTool.description"/>
                                        </div>
                                        <span v-if="formErrorsUpdate['description']" class="error text-danger">{{ formErrorsUpdate['description'] }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type" class="control-label">Tipo</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                            <select class="form-control" id="typeSelect" v-model="updatedTool.toolType_id">
                                                <option value="" disabled selected>Select your option</option>
                                                <option v-for="toolType in toolTypes" v-bind:value="toolType.id" v-bind:class="[updatedTool.toolType_id == toolType.id ? 'selected' : '']">{{ toolType.name }}</option>
                                            </select>
                                        </div>
                                        <span v-if="formErrorsUpdate['toolType_id']" class="error text-danger">{{ formErrorsUpdate['toolType_id'] }}</span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <button type="button" id="button" class="btn btn-primary" @click="updateTool(updatedTool.id)">Actualizar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Tool Modal -->

            <!-- Show Tool Modal -->
            <div class="modal fade" id="show-tool" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="cierraModal('show-tool')" aria-label="Close"><span class="glyph-md">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{ showedTool.name }}</h4>
                        </div>
                        <div class="modal-body">
                            <p>{{ showedTool.description }}</p>
                            <p>Tipo: <b>{{ showedTool.tool_types.name }}</b></p>
                            <p v-for="contract_tools in showedTool.contract_tools">
                                Fecha de Contratación: <b>{{ contract_tools.contract_date }}</b>
                                Costo por licencia: <b>{{ contract_tools.license_cost }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Show Tool Modal -->

        </div> <!-- row-main -->
    </div> <!-- container -->

</template>
<script>
    export default {
        data() {
            return {
            	tools: [],
                toolTypes: [],
                areas: [],
                employees: [],
                frecuencies: [],
                show_name: this.$root.app_name,
                order: '',
                filter: '',
                filterValue: '',
                newTool: {
                    'name': '',
                    'description': '',
                    'toolType_id': '',
                },
                updatedTool: {
                    'name': '',
                    'description': '',
                    'toolType_id': '',
                    'id': ''
                },
                formErrors:{},
                formErrorsUpdate:{},
                showedTool: {
                    'name': '',
                    'description': '',
                    'toolType_id': '',
                    'tool_types': [],
                    'contractTools': [],
                },
            }
        },
        ready: function(){
            this.getTools();
        },
        mounted() {
        	axios.get('/tooltypes').then(response => {
                $.each(response.data, (index, value) => {
                    this.toolTypes.push(value);
                })
            });
            axios.get('/areas').then(response => {
                $.each(response.data, (index, value) => {
                    this.areas.push(value);
                })
            });
            axios.get('/employees').then(response => {
                $.each(response.data, (index, value) => {
                    this.employees.push(value);
                })
            });
            axios.get('/frecuencies').then(response => {
                $.each(response.data, (index, value) => {
                    this.frecuencies.push(value);
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
            showTool(tool){
                this.showedTool = tool;
            },
            registerTool() {
                var self = this;
                var input = this.newTool;
                axios
                .post('/tools', input)
                .then( function(response) {
                    if(response.data.status == 1) {
                        toastr.success( 'Se almacenó correctamente.', '¡Éxito!', { timeOut: 5000 } );
                        self.newTool = { 'name': '', 'description': '', 'toolType_id': '' };
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
                this.updatedTool.toolType_id = tool.toolType_id;
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
                        self.updatedTool = { 'id': '', 'name': '', 'description': '', 'toolType_id': '' };
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
                this.newTool = { 'name': '', 'description': '', 'toolType_id': '' };
                this.updatedTool = { 'id': '', 'name': '', 'description': '', 'toolType_id': '' };
                this.formErrors = {};
                this.formErrorsUpdate = {};
            }
        }
    }
</script>
