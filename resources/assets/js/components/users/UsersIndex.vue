<template>
	<div class="container">
		<div class="row main">
			<div class="row">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
                        <h2>Usuarios</h2>
                    </div>
                    <div class="pull-right">
                        <a role="button" class="btn btn-primary" data-toggle="modal" data-target="#create-user">
                            Registrar
                        </a>
                    </div>
				</div>
			</div>
            <div class="main-login main-center table-responsive" v-show="users.length > 0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td><a href="#" role="button" @click="showUser(user)" data-toggle="modal" data-target="#show-user">{{ user.name }}</a></td>
                            <td>{{ user.email }}</td>
                            <td><a href="#" role="button" @click="getFilteredUsers('typeUser_id', user.typeUser_id)">{{ user.type_user.name.toUpperCase() }}</a></td>
                            <td>
                                <button @click="editUser(user)" class="btn btn-warning btn-xs" v-bind:value="user.id" data-toggle="modal" data-target="#edit-user"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;&nbsp;
                                <button @click="deleteUser(user)" class="btn btn-danger btn-xs" v-bind:value="user.id"><span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Create User Modal -->
            <div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="cierraModal('create-user')" aria-label="Close"><span class="glyph-md">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Invitar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="registerUser">
                                <div class="form-group">
                                    <label for="user_email" class="control-label">E-mail</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                            <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Correo del usuario" v-model="prospect.email" required/>
                                        </div>
                                        <span v-if="formErrors['email']" class="error text-danger">{{ formErrors.email[0] }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="typeUser" class="control-label">Tipo</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list" aria-hidden="true"></i></span>
                                            <select class="form-control" id="typeSelect" v-model="prospect.typeUser_id" required>
                                                <option value="" disabled selected>Elige el rol</option>
                                                <option v-for="typeUser in typeUsers" v-bind:value="typeUser.id">{{ typeUser.name }}</option>
                                            </select>
                                        </div>
                                        <span v-if="formErrors['typeUser_id']" class="error text-danger">{{ formErrors.typeUser_id[0] }}</span>
                                    </div>
                                </div>                                

                                <div class="form-group">
                                    <button type="button" id="button" class="btn btn-primary" @click="registerUser">Registrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Create User Modal -->
            <!-- Edit User Modal -->
            <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" @click="cierraModal('edit-user')" aria-label="Close"><span class="glyph-md">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form class="" method="POST">
                                <div class="form-group">
                                    <label for="user_name" class="control-label">Nombre</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="user_name" id="user_name" v-bind:placeholder="updatedUser.name" v-model="updatedUser.name"/>
                                        </div>
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">{{ formErrorsUpdate.name[0] }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="control-label">E-mail</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></span>
                                            <input type="email" class="form-control" name="email" id="email" v-bind:placeholder="updatedUser.email"  v-model="updatedUser.email"/>
                                        </div>
                                        <span v-if="formErrorsUpdate['email']" class="error text-danger">{{ formErrorsUpdate.email[0] }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="typeUser" class="control-label">Tipo</label>
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                                            <select class="form-control" id="typeUserSelect" v-model="updatedUser.typeUser_id">
                                                <option value="" disabled selected>Select your option</option>
                                                <option v-for="typeUser in typeUsers" v-bind:value="typeUser.id" v-bind:class="[updatedUser.typeUser_id == typeUser.id ? 'selected' : '']">{{ typeUser.name }}</option>
                                            </select>
                                        </div>
                                        <span v-if="formErrorsUpdate['typeUser_id']" class="error text-danger">{{ formErrorsUpdate.typeUser[0] }}</span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <button type="button" id="button" class="btn btn-primary" @click="updateUser(updatedUser.id)">Actualizar</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit User Modal -->
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                updatedUser: {
                    'id': '',
                    'name': '',
                    'email': '',
                    'typeUser_id': ''
                },
                prospect: { 'email': '', 'typeUser_id': ''},
                formErrors: [],
                formErrorsUpdate: [],
                typeUsers: [],
            }
        },
        mounted() {
            this.getUsers()
            axios.get('typeUsers').then( response => {
                $.each(response.data, (index, val) => {
                    this.typeUsers.push(val);
                });
            });
        },
        methods: {
            getUsers(){
                axios.post('getUsers').then( response => {
                    $.each(response.data, (index, val) => {
                        this.users.push(val);
                    })
                });
            },
            cierraModal(modal){
                $('#'+modal).modal('hide');
                this.prospect = { 'email': '', 'typeUser_id': ''}
                this.updatedUser = {'id': '', 'name': '', 'email': '', 'typeUser_id': ''}
                this.formErrors = [];
            },
            registerUser(){
                axios.post('send', {
                    email: this.prospect.email,
                    typeUser_id: this.prospect.typeUser_id
                }).then(response => {
                    //console.log(response);
                    if(response.data.status == 0) {
                        toastr.error( 'Parece que algo salió mal.', '¡Error!', { timeOut: 5000 } );
                        this.formErrors = response.data.errors;
                        setTimeout(function() { this.formErrors = []; }, 3000);
                    }
                    else {
                        toastr.success( 'La invitación se envió correctamente.', '¡Éxito!', { timeOut: 5000 } );
                        this.prospect = { 'email': '', 'typeUser_id': ''};
                        $('#create-user').modal('hide');
                    }
                });
            },
            editUser(user){
                this.updatedUser = user
            },
            updateUser(id) {
                var self = this;
                var input = this.updatedTool;
                axios
                .post('/users/update', {
                    id: id,
                    input: input,
                })
                .then( function(response) {
                    if(response.data.status == 1) {
                        toastr.success( 'Se actualizó correctamente.', '¡Éxito!', { timeOut: 5000 } );
                        self.updatedUser = { 'id': '', 'name': '', 'email': '', 'typeUser_id': '' };
                        self.getUsers();
                        $('#edit-user').modal('hide');
                    }
                    else {
                        toastr.error( 'Parece que algo salió mal.', '¡Error!', { timeOut: 5000 } );
                        self.formErrorsUpdate = response.data.errors;
                        setTimeout(function() { self.formErrorsUpdate = {}; }, 3000);
                    }
                });
            }
        }
    }
</script>
