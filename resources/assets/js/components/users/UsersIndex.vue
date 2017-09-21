<template>
	<div class="container">
		<div class="row main">
			<div class="row">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
                        <h2>Usuarios</h2>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register-user">
                            Registrar
                        </button>
                    </div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
