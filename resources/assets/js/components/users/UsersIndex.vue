<template>
	<div class="container">
		<div class="row main">
			<div class="row">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
                        <h2>Usuarios</h2>
                    </div>
                    <div class="pull-right">
                        <a role="button" class="btn btn-primary" href="/register">
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
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        mounted() {
            axios.post('getUsers')
                .then( response => {
                    $.each(response.data, (index, val) => {
                        this.users.push(val);
                    })
                    console.log(this.users);
                });
        }
    }
</script>
