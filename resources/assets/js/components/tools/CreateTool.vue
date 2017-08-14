<template>
    <div class="container">
        <div class="row main">
            <div class="main-login main-center">
            <h3>Registro de Herramientas</h3>
                <form class="" method="post" action="#">
                    
                    <div class="form-group">
                        <label for="tool_name" class="cols-sm-2 control-label">Nombre de la herramienta</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="tool_name" id="tool_name"  placeholder="Nombre de la herramienta"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="cols-sm-2 control-label">Descripción</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="description" id="description"  placeholder="Ingresa la descripción"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="area" class="cols-sm-2 control-label">Área</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>
                                <select class="form-control" id="areaSelect">
                                    <option value="" disabled selected>Select your option</option>
                                    <option v-for="area in areas" :value="area.id">{{ area.area_name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="cols-sm-2 control-label">Tipo</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                <select class="form-control" id="typeSelect">
                                    <option value="" disabled selected>Select your option</option>
                                    <option v-for="type in types" v-bind:value="type.id">{{ type.type_name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="responsible" class="cols-sm-2 control-label">Responsable</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                <select class="form-control" id="responsibleSelect">
                                    <option value="" disabled selected>Select your option</option>
                                    <option v-for="responsible in responsibles" v-bind:value="responsible.id">{{ responsible.responsible_name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button type="button" id="button" class="btn btn-primary btn-lg btn-block" v-on:click="registerTool">Registrar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                types: [],
                areas: [],
                responsibles: []
            }
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
            registerTool() {
                axios.post('/tools', {
                    name: $('#tool_name').val(),
                    description: $('#description').val(),
                    type_id: $('#typeSelect').val(),
                    area_id: $('#areaSelect').val(),
                    responsible_id: $('#responsibleSelect').val()
                }).then(response => {
                    if(response.data.status == 0){
                        this.showError();
                        console.log(response.data);
                    }
                    else {
                        this.showSuccess();
                        console.log(response.data.tool);
                    }
                });
            },
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
            }
        }
    }
</script>