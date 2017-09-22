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
                            <div class="form-group">
                                <label for="user_email" class="control-label">E-mail</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Correo del usuario" v-model="prospect.email"/>
                                    </div>
                                    <span v-if="formErrors['email']" class="error text-danger">{{ formErrors['email'] }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="typeUser" class="control-label">Tipo</label>
                                <div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-list" aria-hidden="true"></i></span>
                                        <select class="form-control" id="typeSelect" v-model="prospect.typeUser_id">
                                            <option value="" disabled selected>Select your option</option>
                                            <option v-for="typeUser in typeUsers" v-bind:value="typeUser.id">{{ typeUser.name }}</option>
                                        </select>
                                    </div>
                                    <span v-if="formErrors['typeUser.id']" class="error text-danger">{{ formErrors['typeUser.id'] }}</span>
                                </div>
                            </div>                                

                            <div class="form-group">
                                <button type="button" id="button" class="btn btn-primary">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Create User Modal -->
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
                prospect: { 'email': '', 'typeUser_id': ''},
                formErrors: {},
                typeUsers: [],
            }
        },
        mounted() {
            axios.post('getUsers').then( response => {
                $.each(response.data, (index, val) => {
                    this.users.push(val);
                })
            });
            axios.get('typeUsers').then( response => {
                $.each(response.data, (index, val) => {
                    this.typeUsers.push(val);
                });
            });
        },
        methods: {
            cierraModal(modal){
                $('#'+modal).modal('hide');
                this.prospect = { 'email': '', 'typeUser_id': ''},
                this.formErrors = {};
            }
        }
    }
</script>
